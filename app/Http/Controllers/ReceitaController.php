<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receita;
use Carbon\Carbon;
use Formatter;  


use App\Context\Receita\ReceitaBuilder;

class ReceitaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $listagem = Receita::all();
        $renda = Receita::where('descricao', '200')->get(['valor']);
        $array = array();
        foreach ($renda as $r) {
            array_push($array, $r["valor"]);
        }
       
        return view('receita.home', ['receitas'=>$listagem, 'renda' => $array]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('receita.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rb = new ReceitaBuilder;
        $strategy = $rb->builder($request->all());
        $strategy->make($request->all());

        return redirect()->route('receitas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $receita = Receita::find($id);

        if ($receita) {
            return view('receita.show', ['receita'=>$receita]);    
        }

        return redirect()->route('receitas.index');
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $receita = Receita::find($id);
        return view ('receita.edit', ['receita'=>$receita]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //return $request->all();
        
        $data = $request->all();
        $receita = Receita::find($id);

        $receita->descricao = $data['descricao'];
        $receita->valor = $data['valor'];
        if ($request->post('fixa')) {
            $receita->fixa = true;
        }
        $receita->data = Carbon::create($data['data']);

        $receita->save();

        return redirect()->route('receitas.show', ['receita'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $receita = Receita::find($id);
        $receita->delete();

        return redirect()->route('receitas.index');
    }

}
