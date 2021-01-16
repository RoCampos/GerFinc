@extends('layout.index')

@section('conteudo')
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<div class="p-2 flex-grow">
				<h1 class="h3 mb-0 text-gray-800">
					Receita - 
					@if($receita) {{$receita->descricao}} @endif
				</h1>	
			</div>
			<div class="p-2">
				<a href="{{route('receitas.index')}}" class="btn btn-primary btn-circle">
					<i data-feather="home"></i>
				</a>
				<a href="{{route('receitas.edit',['receita'=>$receita->id])}}" class="btn btn-primary btn-circle">
					<i data-feather="edit"></i>
				</a>
				<a href="" onclick="document.getElementById('form_destroy').submit(); return false;" class="btn btn-primary btn-circle">
					<i data-feather="trash-2"></i>
				</a>
				<form id="form_destroy" action="{{route('receitas.destroy', ['receita'=>$receita->id])}}" method="POST">
					@csrf
					@method('DELETE')
				</form>
			</div>
        </div>

        <div class="card">
        	<div class="card-body">
        		<div class="row">
        			<div class="col">
        				@if($receita) 
        					<p>Descrição: {{$receita->descricao}}</p>
        					<p>Valor: {{$receita->valor}}</p>
        					<p>Data: {{$receita->data}} </p>
        				@else
        					<p>Não encontrado</p>
        				@endif	
        			</div>        			
        		</div>
        	</div>
        </div>

@endsection

