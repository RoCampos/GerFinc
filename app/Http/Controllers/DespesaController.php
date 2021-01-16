<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use App\Models\Parcela;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

use App\Context\Despesa\PagamentoDespesaContext;
use App\Context\Despesa\PagamentoDespesaBuilder;

class DespesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $despesas = Despesa::where('user_id', Auth::user()->id)
            ->get();

        return view('despesa.home', ['despesas' => $despesas]);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function edit(Despesa $despesa)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Despesa $despesa)
    {
        //
    }
}
