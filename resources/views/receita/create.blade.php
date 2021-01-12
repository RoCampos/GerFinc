@extends('layout.index')


@section('conteudo')
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Cadastrar Receita</h1>
			<a href="{{route('receitas.index')}}" class="btn btn-primary btn-circle">
				<i data-feather="home"></i>
			</a>
        </div>

        <div class="card">
        	<div class="card-body">
        		<div class="row">

					<div class="offset-md-2 col-md-8">

					<form action="{{route('receitas.store')}}" method="POST">
						@csrf
						<div class="form-group">
							<label class="form-label">
								Descrição
							</label>
							<input type="text" name="descricao" placeholder="Descrição da Receita" class="form-control">					
						</div>
						
							<div class="form-check">
								<input class="form-check-input" type="checkbox" id="invalidCheck3" name="fixa">
		      					<label class="form-check-label" for="invalidCheck3">Renda Fixa</label>	
							</div>
						
						<div class="form-group">
							<label class="form-label">
								Valor
							</label>
							<input type="text" name="valor" placeholder="Insira o valor" class="form-control">
						</div>

						<div class="form-group">	
							<label class="form-label">Data</label>	
							<input type="date" name="data" class="form-control">
						</div>

						<button type="submit" class="btn btn-primary btn-user">
							Enviar
						</button>
					</form>

					</div>


				</div>


        	</div>
        </div>
@endsection

