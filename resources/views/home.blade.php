@extends('layout.index')
@section('conteudo')
        <div class="row mb-3">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">GerFinc - Finanças Inteligentes</h1>                  
            </div>        
        </div>

        <div class="row">
        <div class="col">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a href="#nav-resumo" class="nav-item nav-link" id="nav-resumo-tab" data-toggle="tab" role="tab" aria-controls="nav-resumo" aria-selected="true">Resumo - ANO</a>

                    <a href="#nav-detalhado" class="nav-item nav-link" id="nav-detalhado-tab" data-toggle="tab" role="tab" aria-controls="nav-detalhado" aria-selected="true">Detalhado</a>
                </div>     
            </nav>

            {{-- painel informaões gerais --}}
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-resumo" role="tabpanel" aria-labelledby="nav-resumo-tab">
                    <div class="row mb-3">
                          
                    </div>
                </div>
                <div class="tab-pane fade show" id="nav-detalhado" role="tabpanel" aria-labelledby="nav-detalhado-tab">
                    <div class="row mb-3">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    @include('home.table', ['categorias'=>$categorias])
                                </div>    
                            </div>
                        </div>
                    </div>  
                </div>
            </div>

        </div>
        </div>
@endsection