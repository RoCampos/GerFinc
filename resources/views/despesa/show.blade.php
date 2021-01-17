@extends('layout.index')

@section('css-link')

<!-- Custom styles for this page -->
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('conteudo')

		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<div class="p-2 flex-grow">
				<h1 class="h3 mb-0 text-gray-800">
					Despesa - 
					@if($despesa) {{$despesa->descricao}} @endif
				</h1>	
			</div>
			<div class="p-2">
				<a href="{{route('despesas.index')}}" class="btn btn-primary btn-circle">
					<i data-feather="home"></i>
				</a>
				<a href="{{route('despesas.edit',['despesa'=>$despesa->id])}}" class="btn btn-primary btn-circle">
					<i data-feather="edit"></i>
				</a>
				<a href="" onclick="document.getElementById('form_destroy').submit(); return false;" class="btn btn-primary btn-circle">
					<i data-feather="trash-2"></i>
				</a>
				<form id="form_destroy" action="{{route('despesas.destroy', ['despesa'=>$despesa->id])}}" method="POST">
					@csrf
					@method('DELETE')
				</form>
			</div>
        </div>

        <div class="row">
        	
        	<div class="col-md-8 primary-left">
        		<div class="card border-left-primary shadow h-100 py-2">
        			<div class="card-body">
        				<div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                	{{$despesa->descricao}}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                	{{$total}}
                                </div>
                            </div>
                            <div class="col-auto mr-2">
                            	<div class="text-gray-900 font-weight-bold">
	                                @if($despesa->fixa)
	                                	Despesa Fixa
	                                @else 
	                                	Parcelas
	                                @endif
                                </div>
                                <div class="text-gray-900 text-center">
	                                @if($despesa->fixa)

	                                @else 
	                                	{{$despesa->parcelas->where('pago',1)->count()}} | 
	                                	{{$despesa->parcelas->count()}}
	                                @endif
                                </div>
                            </div>
                            <div class="col-auto mr-3">
                            	<div class="text-gray-900 font-weight-bold">
	                                @if($despesa->fixa)
	                                	
	                                @else 
	                                	Saldo Devedor
	                                @endif
                                </div>
                                <div class="text-gray-800 text-center">
	                                @if($despesa->fixa)

	                                @else 
	                                	{{-- need a facade --}}
	                                	{{Formatter::realmonetary($despesa->saldo_devedor())}}
	                                @endif
                                </div>
                            </div>

                            <div class="col-auto">
                                <i class="fas fa-info-circle fa-2x text-gray-300"></i>
                            </div>

                        </div>

                        <div class="row no-glutter align-items-center mt-3">
                        	<div class="col mr-2">
                        		<div class="text-gray-900 font-weight-bold">
	                                Data da Compra
                                </div>
                                <div class="text-gray-800">
	                                {{Formatter::dataformat($despesa->data)}}
                                </div>
                        	</div>

                        	<div class="col-auto mr-3">
                        		<div class="text-gray-900 font-weight-bold">
	                                Status
                                </div>
                                
                                	@if($despesa->pago()) 
                                	<div class="text-primary">
                                		Quitado
                                	</div>
                                	@else
                                	<div class="text-danger">
                                		Não quitado
                                	</div>
                                	@endif

                                
                        	</div>

                        	<div class="col-auto"></div>

                        </div>
        			</div>
        		</div>
        	</div>

        	<div class="col-md-4 primary-left">
        		<div class="card border-left-primary shadow h-100 py-2">
        			<div class="card-body">
        				<div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                	Categoria
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                	{{$despesa->categorias}}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tag fa-2x text-gray-300"></i>
                            </div>
                        </div>
        			</div>
        		</div>
        	</div>

        </div>

        @if($despesa->fixa == 0 && $despesa->count() > 1)
        <div class="row">
        	<div class="col h-100">
        		<div class="card shadow mb-4 mt-2">
        			<a href="#painelparcelas" class="d-block card-header py-3" data-toggle="collapse"
        			    role="button" aria-expanded="true" aria-controls="painelparcelas">
        			    <h6 class="m-0 font-weight-bold text-primary">
        			    	Parcelas
        				</h6>
        			</a>

        			<div class="collapse show" id="painelparcelas">
        			    <div class="card-body">
        			        
        			    	<div class="table-responsive">
	    						<table class="table table-striped" id="tabela">
	    							<thead>
	    								<tr>
	    									<th>Data</th>
	    									<th>Valor</th>
	    									<th>Situação</th>
	    									<th>Pagar</th>
	    								</tr>
	    							</thead>
	    							<tbody>
	    								@php
	    									$counter = $despesa
	    										->parcelas->count();
	    									$parcelas = $despesa
	    										->parcelas;
	    								@endphp
	    								@if($counter>1)
	    								@for ($i = 0; $i < $counter; $i++)
	    								<tr>
	    									<td>
	    										{{Formatter::dataformat($parcelas[$i]->data_pagamento)}}
	    									</td>
	    									<td>
	    										{{Formatter::realmonetary($parcelas[$i]->valor)}}
	    									</td>
	    									<td>
	    										{{$parcelas[$i]->status()}}
	    									</td>
	    									<td>
	    										@if(!$parcelas[$i]->pago)
	    										<a href="#">
	    											<i class="fas fa-check"></i>
	    										</a>
	    										@else
	    											<i class="fas fa-double-check"></i>
	    										@endif
	    									</td>
	    								</tr>
	    								@endfor
	    								@endif
	    							</tbody>	

	    						</table>
	    					</div>

        			    </div>
        			</div>
        		</div>
        	</div>
        </div>
        @endif

@endsection

@section('script')
<!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script>
    	$(document).ready(function() {
  			$('#tabela').DataTable();
		});
    </script>
@endsection