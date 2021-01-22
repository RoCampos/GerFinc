<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use App\Models\Parcela;
use Illuminate\Http\Request;


use Carbon\Carbon;
use Money\Money;
use Money\Currency;
use Auth;

use App\Context\Despesa\PagamentoDespesaContext;
use App\Context\Despesa\PagamentoDespesaBuilder;
use App\Context\Monetary\Formatter;

class DespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {       

        $ano = $request->get('ano-select');
        $mes = $request->get('mes-select');

        if (!isset($ano) && !isset($mes)) {
            $ano = date(Carbon::now()->format('Y'));
            $mes = date(Carbon::now()->format('m'));
        }

        $anos = Despesa::all('data')
            ->map(function($valor) {
                return Carbon::create($valor->data)
                    ->format('Y');
                })
            ->unique()
            ->sortDesc();

        $despesas = Despesa::whereYear('data','=', $ano)
            ->whereMonth('data','=', $mes)
            ->where('user_id', Auth::user()->id)
            ->get();

        return view('despesa.home', [
            'despesas' => $despesas,
            'ano' => $ano,
            'mes' => $mes,
            'anos' => $anos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('despesa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $request->all();
        $strategy = PagamentodespesaBuilder::builder($data);

        if ($strategy) {
            $despesa = new PagamentoDespesaContext($strategy);
            $despesa->make($data);
            return redirect()->route('despesas.index');
        } else {
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function show(Despesa $despesa)
    {
        $valor = $despesa->parcelas->sum('valor');
        $total = Formatter::realmonetary($valor);

        return view('despesa.show', [
            'despesa'=>$despesa,
            'total' => $total
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function edit(Despesa $despesa)
    {
        
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Despesa $despesa)
    {
        
        $data = $request->all();
        $despesa->fixa = isset($data['despesa-edit-fixa']) ? true : false;
        $despesa->descricao = $data['despesa-edit-descricao'];
        $valor = Formatter::stringToMoney($data['despesa-edit-valor']);
        $despesa->data = Formatter::dataFromView($data['despesa-edit-data']);
        $despesa->save();

        $parcelas = $despesa->parcelas;
        $data = Carbon::create($despesa->data->format('m/d/Y'));

        $valor = new Money($valor, new Currency('BRL'));
        $valor = $valor->divide($parcelas->count())->getAmount();
        foreach($parcelas as $parc) {
            $parc->data_pagamento = $data;
            $data->addMonth(1);
            $parc->valor = $valor;
            $parc->save();
        }

        return redirect()->route('despesas.show', ['despesa'=>$despesa->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Despesa $despesa)
    {
        $parcelas = $despesa->parcelas()->delete();
        $despesa->destroy($parcelas);
        $despesa->delete();
        return redirect()->route('despesas.index');

    }
}
