@extends('layout.index')

@section('conteudo')


	<div class="row">
		<div class="col">
		    <div class="d-sm-flex align-items-center justify-content-between mb-4">
		        <h1 class="h3 mb-0 text-gray-800">Configurações</h1>
		    </div>              
		</div>
	</div>

	{{-- painel --}}
	<div class="row">
	    
	    <div class="col-md-12">
	        <nav>
	            <div class="nav nav-tabs" id="nav-tab" role="tablist">
	                 <a href="#nav-categorias" class="nav-item nav-link" id="nav-categorias-tab" data-toggle="tab" role="tab" aria-controls="nav-categorias" aria-selected="true">Categorias</a>

	             {{--     <a href="#nav-grafico" class="nav-item nav-link" id="nav-grafico-tab" data-toggle="tab" role="tab" aria-controls="nav-grafico" aria-selected="true">Gráficos</a> --}}
	            </div>     
	        </nav>

	        {{-- painel informaões gerais --}}
	        <div class="tab-content" id="nav-tabContent">
	            <div class="tab-pane fade show active mt-3" id="nav-categoria" role="tabpanel" aria-labelledby="nav-categoria-tab">

	            	<div class="row mb-3">
		            	<div class="col-md-6">
			            	<div class="card border-left-primary shadow h-100 py-2">
			            	     <div class="card-body">
			            	     	<div class="row no-gutters align-items-center">
			            	     		<div class="col">
			            	     			@include('categoria.create')	
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
			            	     			@include('categoria.attach', ['categorias'=>$categorias])
			            	     		</div>			
			            	     	</div>
			            	     </div>
			            	</div>
		            	</div>
	            	</div>

	            	<div class="row m-3">
	            		<div class="col-md-12">
	            			<div class="card border-left-primary shadow h-100 py-2">
		            			<div class="card-body">
			            	     	<div class="row no-gutters align-items-center">
			            	     		<div class="col">
			            	     			@include('categoria.list', ['categorias'=>$categorias])
			            	     		</div>			
			            	     	</div>
			            	    </div>
		            	 	</div>

	            		</div>		
	            	</div>

	            </div>
	        </div>
	    </div>
	</div>

@endsection