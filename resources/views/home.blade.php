@extends('layout.index')

@section('css-link')
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

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
                    <a href="#nav-resumo" class="nav-item nav-link" id="nav-resumo-tab" data-toggle="tab" role="tab" aria-controls="nav-resumo" aria-selected="true">Resumo</a>

                    <a href="#nav-detalhado" class="nav-item nav-link" id="nav-detalhado-tab" data-toggle="tab" role="tab" aria-controls="nav-detalhado" aria-selected="true">Detalhado</a>
                </div>     
            </nav>

            {{-- painel informaões gerais --}}
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-resumo" role="tabpanel" aria-labelledby="nav-resumo-tab">
                    <div class="row mb-3 mt-1">
                          <div class="col-md-12">
                              <div class="card border-left-primary shadow h-100 py-2">
                                  <div class="card-body">
                                        <div class="row">
                                            <div class="offset-md-2 col-md-8">
                                                @include('home.summary')
                                            </div>
                                        </div>
                                  </div>
                              </div>
                          </div>

                    </div>
                </div>
                <div class="tab-pane fade show" id="nav-detalhado" role="tabpanel" aria-labelledby="nav-detalhado-tab">
                    <div class="row mb-3 mt-1">
                        <div class="col">
                            <div class="card border-left-primary shadow h-100 py-2">
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

@section('script')
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('table.table').DataTable();
        
    })
</script>

@endsection
