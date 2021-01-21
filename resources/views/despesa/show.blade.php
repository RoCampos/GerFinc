@extends('layout.index')

@section('css-link')

<!-- Custom styles for this page -->
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endsection

@section('conteudo')

		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<div class="p-2 flex-grow">
				<h1 id="descricao" class="h3 mb-0 text-gray-800">
					Despesa - 
					@if($despesa) {{$despesa->descricao}} @endif
				</h1>	
			</div>
			<div class="p-2">
				<a href="{{route('despesas.index')}}" class="btn btn-primary btn-circle">
					<i data-feather="home"></i>
				</a>
				<a href="" class="btn btn-primary btn-circle" data-toggle="modal" data-target="#editmodal">
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
                                <div id="descricao" class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                	{{$despesa->descricao}}
                                </div>
                                <div id="valor" class="h5 mb-0 font-weight-bold text-gray-800">
                                	{{$total}}
                                </div>
                            </div>
                            <div class="col-auto mr-2">
                            	<div id="fixa" class="text-gray-900 font-weight-bold">
	                                @if($despesa->fixa)
	                                	Despesa Fixa
	                                @else 
	                                	Parcelas
	                                @endif
                                </div>
                                <div id="numparcela" class="text-gray-900 text-right">
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
                                <div class="text-gray-800 text-right">
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
                                <div id="datacompra" class="text-gray-800">
	                                {{Formatter::dataformat($despesa->data)}}
                                </div>
                        	</div>

                        	<div class="col-auto mr-3">
                        		<div class="text-gray-900 font-weight-bold text-right">
	                                Status
                                </div>
                                
                                @if($despesa->pago()) 
                                <div class="text-primary text-right">
                                    Quitado
                                </div>
                                @else
                                <div class="text-danger text-right">
                                    Não quitado
                                </div>
                                @endif
                        	</div>

                        	<div class="col-auto mr-2">
                                
                            </div>

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
                            </div>
                            <div class="col-auto">
                                <a data-toggle="modal" data-target="#categotiaModal">
                                    <i class="fas fa-tag fa-2x text-gray-300"></i>        
                                </a>
                            </div>
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="mb-0 text-gray-800">
                                    @foreach ($despesa->categorias as $tags)
                                        {{$tags->etiqueta}}
                                    @endforeach
                                </div>
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
	    									<th>Ações</th>
	    								</tr>
	    							</thead>
	    							<tbody>
	    								@php
	    									$counter = $despesa
	    										->parcelas->count();
	    									$parcelas = $despesa
	    										->parcelas;
	    								@endphp
	    								@if($counter>0)
	    								@for ($i = 0; $i < $counter; $i++)
	    								<tr id="{{'parc-row-'.$parcelas[$i]->id}}">
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
                                                <form id="{{"form".$i}}" action="{{route('parcelas.store')}}" method="POST">
                                                    @csrf
                                                    <input id='parcela' type="hidden" name="parcela" value="{{$parcelas[$i]->id}}">
                                                    <input type="hidden" name="despesa" value="{{$despesa->id}}">
                                                </form>
	    										@if(!$parcelas[$i]->pago)
                                                <a href="#" 
                                                onclick="document.getElementById({{'"'.'form'.$i.'"'}}).submit(); return false;" class="btn btn-link">
	    											<i class="fas fa-check"></i>
	    										</a>
	    										@else
                                                    <i class="fas fa-check-double text-success btn btn-link"></i>    
	    										@endif
                                                <a id="{{'a-parc'.$parcelas[$i]->id}}" href="" class="btn btn-link">
                                                    <i class="fas fa-edit" ></i>
                                                </a>
                                                <a href="" class="btn btn-link">
                                                    <i class="fas fa-trash"></i>
                                                </a>
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

        <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editmodal"aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark" id="editmodal">Adicionar Categorias</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('despesa.edit')
                    </div>  
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <a href="" id="despesa-edit-submit" class="btn btn-primary">
                            Salvar
                        </a>
                    </div>  
                </div>
            </div>
        </div>

        <div class="modal fade" id="parcela-modal" tabindex="-1" role="dialog" aria-labelledby="parcela-modal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark" id="parcela-modal">Editar valor da parcela e Data de Pagamento</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('parcela.edit')

                    </div>  
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <a href="" id="parc-submit" class="btn btn-primary">
                            Salvar
                        </a>
                    </div>  
                </div>
            </div>
        </div>        

        {{--  --}}
        <div class="modal fade" id="categotiaModal" tabindex="-1" role="dialog" aria-labelledby="categotiaModal"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark" id="exampleModalLabel">Adicionar Categorias</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row no-glutters align-items-center mb-2">
                            <div class="col">
                                <div class="text-ts font-weight-bold text-dark">
                                    Vinculado
                                </div>
                                <div class="d-inline-flex">
                                @foreach($despesa->categorias as $cat)
                                <a href="" onclick="document.getElementById('{{'delform'.$cat->id}}').submit(); return false;">
                                    [-{{$cat->etiqueta}}]
                                </a>
                                <form id='{{'delform'.$cat->id}}' method="POST" action="{{route('categorias.detach', ['categoria'=>$cat->id, 'despesa'=>$despesa->id])}}">
                                    @csrf
                                </form>
                                @endforeach
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row no-glutters align-items-center mb-2">
                            <div class="col">
                                <div class="text-ts font-weight-bold text-dark">
                                    Vincular
                                </div>                                
                                <div class="d-inline-flex">
                                @foreach(App\Models\Categoria::diff_categorias($despesa->categorias) as $cat)
                                <a href="#" onclick="document.getElementById('{{'catform'.$cat->id}}').submit(); return false;">
                                    [+{{$cat->etiqueta}}]
                                </a>
                                <form id="{{'catform'.$cat->id}}" method="POST" action="{{route('categorias.attach', ['categoria'=>$cat->id, 'despesa'=>$despesa->id])}}">
                                    @csrf
                                </form>
                                @endforeach
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row no-gutters align-items-center mb-2">
                            <div class="col">
                                <div class="text-ts font-weight-bold text-dark">
                                    Cadastrar nova categoria
                                </div>
                                <form action="{{route('categorias.store')}}" method="POST" id="tag">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" placeholder="Nova Categoria" name="tag" class="form-control">
                                        <input type="hidden" name="despesa" value="{{$despesa->id}}">    
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary">
                                            Cadastrar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Sair</button>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('script')
<!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script>

    <!-- Page level custom scripts -->
    <script>

        function formatValorReal(val) {
            var valor = val.replace(',','.');
            valor = val.replace('.','');
            valor = valor.replace('R$','');
            valor = valor.replace(/&nbsp/g,''); //removing nombreak space
            valor = parseFloat(valor);
            var res = valor.toLocaleString('pt-BR',{
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            });
            return res;
        }

        function onclickFormat() {
            if ($(this).val() == "") return;
            var val = formatValorReal($(this).val());
            $(this).val(val);
            return false;
        }

        function trim_url($resource) {
            var url = window.location.href;
            var length = window.location.href.length;
            return url.substring(0,(length-2) - $resource.length-1 );
        }

    	$(document).ready(function() {
  			$('#tabela').DataTable();
            
            //intialization of modal's
            // $('#parcela-modal').modal({ show: false});            

            //configuring links to update Pacela
            var links = document.querySelectorAll("[id^='a-parc']");
            for (var i = 0; i < links.length; i++) {
                links[i].onclick = function(e){
                    var modal = document.querySelector("#parcela-modal");
                    var id = this.getAttribute('id').substr(6);
                    var row = document.querySelector("#parc-row-"+id);                    
                    var data_parc = row.children[0].innerText;
                    var valor_parc = row.children[1].innerText;
                    
                    //value
                    var valor = document.querySelector("#parc-edit-valor");

                    //keep correct vlue
                    valor.focusout = onclickFormat;

                    $(valor).val(valor_parc);
                    //fixing the value of date
                    var data = document.querySelector("#parc-edit-data");
                    var dt = data_parc.split('/');
                    $(data).datepicker({});
                    //update value
                    $(data).val(dt[1]+'/'+dt[0]+'/'+dt[2]);

                    //configuring submition
                    var url = trim_url('despesas');
                    form = document.querySelector("#parc-form");
                    form.setAttribute('action', url+'parcelas/'+id);
                    var link = document.querySelector("#parc-submit");
                    link.onclick = function(e) {
                        form.submit();
                        return false;
                    }

                    $("#parcela-modal").modal('show');
                    return false;
                };
            }

            var modal = document.querySelector("#editmodal");
            
            $(modal).on('shown.bs.modal', function(e){
                
                //configuring data
                var editdata = document.querySelector("#despesa-edit-data");
                $(editdata).datepicker({});
                var data = document.querySelector('#datacompra').innerText.split('/');
                editdata.setAttribute('value', ([data[1], data[0], data[2]].join('/')));

                var editvalor = document.querySelector("#despesa-edit-valor");
                var valor = document.querySelector("#valor");
                editvalor.setAttribute('value', formatValorReal(valor.innerText));
                editvalor.focusout = onclickFormat;
                
                var editdesc = document.querySelector("#despesa-edit-descricao");
                var valor = document.querySelector("#descricao");
                editdesc.setAttribute('value', valor.innerText.split(' ')[2]);
                
                var editfixa = document.querySelector("#despesa-edit-fixa");
                var checked = document.querySelector("#fixa").innerText;
                editfixa.checked = checked === 'Parcelas' ? false : true; 

                var link = document.querySelector("#despesa-edit-submit");
                link.onclick = function (e){
                    var form = document.querySelector("#despesa-form-edit");
                    form.submit();
                    return false;
                }



                return false;
            });


		});
    </script>
    
@endsection