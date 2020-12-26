<!DOCTYPE html>
<html>
<head>
	<title>
		Receita - @if($receita) {{$receita->descricao}} @endif
	</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

	<script src="https://unpkg.com/feather-icons"></script>
	<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body>


	<div class="container">
	
		<div class="row">
			<h1>
				Receita - 
				@if($receita) {{$receita->descricao}} @endif
			</h1>	
		</div>
		<hr>

		<a href="{{route('receitas.index')}}" class="btn btn-primary">
			<i data-feather="home"></i>
		</a>
		<a href="{{route('receitas.edit',['receita'=>$receita->id])}}" class="btn btn-primary">
			<i data-feather="edit"></i>
		</a>
		<a href="" onclick="document.getElementById('form_destroy').submit(); return false;" class="btn btn-primary">
			<i data-feather="trash-2"></i>
		</a>
		<form id="form_destroy" action="{{route('receitas.destroy', ['receita'=>$receita->id])}}" method="POST">
			@csrf
			@method('DELETE')
		</form>
		
		<hr>

		<div class="row">
			@if($receita) 
				<p>Descrição: {{$receita->descricao}}</p>
				<p>Valor: {{$receita->valor}}</p>
				<p>Data: {{$receita->data}} </p>
			@else
				<p>Não encontrado</p>
			@endif
		</div>

	</div>

	<script>
  		feather.replace()
	</script>


	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

</body>
</html>