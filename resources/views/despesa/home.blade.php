@extends('layout.index')

@section('css-link')
<!-- Custom styles for this page -->
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('conteudo')

        <div class="row">
            
            <div class="col">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Despesas</h1>
                </div>              
            </div>
            <div class="col-auto">
                <form class="form-inline" id="form-select" method="GET" action="{{route('despesas.index')}}">
                    <div class="form-group">
                        <div class="input-group mr-2">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="ano-select">
                                    Ano
                                </label>
                            </div>
                            <select class="custom-select" id="ano-select" name="ano-select">
                                @foreach($anos as $a) 
                                <option value="{{$a}}" @if($a == intval($ano)) selected="selected" @endif>
                                    {{$a}}
                                </option>
                                @endforeach
                            </select>
                        </div>  
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="mes-select">
                                    Mês
                                </label>
                            </div>
                            <select class="custom-select" id="mes-select" name="mes-select">
                                @for ($i = 1; $i < 13; $i++)
                                    <option value=@if($i<10) {{'0'.$i}} @else {{$i}} @endif @if($i == intval($mes)) selected="selected" @endif>
                                        @if($i<10) 0{{$i}} @else {{$i}} @endif
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </form>
            </div>

            <a class="btn btn-primary btn-circle" data-target="#despesa-create-modal" data-toggle="modal" rel="tooltip" title="Adicionar nova Despesa">
                    <i data-feather="plus-circle">
                    </i>
            </a>
        </div>

        {{-- painel --}}
        <div class="row">
            
            <div class="col-md-12">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                         <a href="#nav-despesa" class="nav-item nav-link" id="nav-despesa-tab" data-toggle="tab" role="tab" aria-controls="nav-despesa" aria-selected="true">Despesas</a>

                         <a href="#nav-grafico" class="nav-item nav-link" id="nav-grafico-tab" data-toggle="tab" role="tab" aria-controls="nav-grafico" aria-selected="true">Gráficos</a>
                    </div>     
                </nav>

                {{-- painel informaões gerais --}}
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-despesa" role="tabpanel" aria-labelledby="nav-despesa-tab">
                                {{-- resumos --}}
                                <div class="row mb-3">
                                    <div class="col-md-6 primary-left">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-glutters align-items-center">
                                                    <div class="col">
                                                        <div class="text-primary font-weight-bold">
                                                            {{$ano}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="m-0 mb-1">
                                                
                                                <div class="row no-gutters align-items-center mb-3">
                                                    <div class="col mr-1">
                                                        <div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">
                                                            Despesa Anual
                                                        </div>
                                                        <div class="text-dark">
                                                            {{Formatter::realmonetary($despesa_total['total'])}}
                                                        </div>
                                                    </div>

                                                    <div class="col mr-2">
                                                        
                                                        <div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">
                                                            Valor Pago
                                                        </div>
                                                        <div class="text-dark">
                                                            {{Formatter::realmonetary($despesa_paga['total'])}}
                                                        </div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">
                                                            Dívida atual
                                                        </div>
                                                        <div class="text-right text-dark"> 
                                                            {{Formatter::realmonetary(
                                                                $despesa_total['total'] - $despesa_paga['total']
                                                            )}}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row no-glutters align-items-center">
                                                    <div class="col">
                                                        <div class="text-primary font-weight-bold">
                                                            {{$mes}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="m-0 mb-1">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-1">
                                                        <div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">
                                                            Despesa Mensal
                                                        </div>
                                                        <div class="text-dark">
                                                            {{Formatter::realmonetary($despesa_total['meses'][$mes])}}
                                                        </div>
                                                    </div>

                                                    <div class="col mr-2">
                                                        
                                                        <div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">
                                                            Valor Pago
                                                        </div>
                                                        <div class="text-dark">
                                                            {{Formatter::realmonetary($despesa_paga['meses'][$mes])}}
                                                        </div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">
                                                            Dívida
                                                        </div>
                                                        <div class="text-right text-dark"> 
                                                            {{Formatter::realmonetary(
                                                                $despesa_total['meses'][$mes] - $despesa_paga['meses'][$mes]
                                                            )}}
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card border-left-primary shadow h-100 py-2">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col">
                                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                            Resumo
                                                        </div>

                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                

                                {{-- todas as receitas --}}
                                <div class="row">
                                    <div class="col-md-12 primary-left">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped" id="tabela">

                                                        <thead>
                                                            <tr>
                                                                <th>Descrição</th>
                                                                <th>Fixa</th>
                                                                <th>Data</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tfoot>
                                                            <tr>
                                                                <th>Descrição</th>
                                                                <th>Fixa</th>
                                                                <th>Data</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </tfoot>
                                                        <tbody>
                                                            @for($i = 0; $i < count($despesas); $i++)
                                                                <tr>
                                                                    <td>
                                                                        <a href="{{route('despesas.show', ['despesa'=>$despesas[$i]->id])}}">
                                                                            {{$despesas[$i]->descricao}}    
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        @if($despesas[$i]->fixa) 
                                                                            Sim
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        {{Formatter::dataformat($despesas[$i]->data)}}
                                                                    </td>
                                                                    <td>
                                                                        @if($despesas[$i]->pago())
                                                                            Pago
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endfor
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  {{-- fim da tabela --}}
                                </div> {{-- fim da linha --}}
                    </div>

                    <div class="tab-pane fade show" id="nav-grafico" role="tabpanel" aria-labelledby="nav-grafico-tab">
                        <div class="col">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Receita Anual</h6>
                                </div>
                                @include('despesa.chart');
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

		{{-- modal cadastro --}}
		<div class="modal fade" id="despesa-create-modal" tabindex="-1" role="dialog" aria-labelledby="despesa-create-modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark" id="parcela-modal">
                        	Adicionar despesa
                        </h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('despesa.create')

                    </div>  
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <a id="a-despesa-submit" href="" id="parc-submit" class="btn btn-primary">
                            Salvar
                        </a>
                    </div>  
                </div>
            </div>
        </div> 

@endsection


@section('script')
	<!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}">
    	
    </script>
    
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}">
    	
    </script>

    <!-- Page level custom scripts -->
    <script>
    	$(document).ready(function() {
  			$('#tabela').DataTable();
  			var link = document.querySelector("#a-despesa-submit");
  			link.onclick = function() {
  				var form = document.querySelector("#despesa-form-create");
  				form.submit();
  				return false;
  			}

  			function onchangeselect(e) {
  				form = document.querySelector("#form-select");
  				form.submit();
  				return false;
  			}

  			var anoselect = document.querySelector("#ano-select");
  			var messelect = document.querySelector("#mes-select");
  			anoselect.onchange = onchangeselect;
  			messelect.onchange = onchangeselect;

		});

    </script>


@endsection