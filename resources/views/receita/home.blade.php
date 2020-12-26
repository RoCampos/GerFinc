<!DOCTYPE html>
<html>
<head>
	<title>
		Home - Receitas
	</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

	<script src="https://unpkg.com/feather-icons"></script>
	<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

	
</head>
<body>


	<div class="container">
		
		<h1>
			Receitas 
			<a href="{{route('receitas.create')}}" class="btn btn-primary">
				<i data-feather="plus-circle"></i>
			</a>
		</h1>

		<hr>

		<div class="row">

			@if(count($receitas))

				<table>
					<tr>
						<th>Descrição</th>
						<th>Valor</th>
						<th>Renda Fixa</th>
						<th>Compensaçãos</th>
					</tr>
					@for($i = 0; $i < count($receitas); $i++)
					<tr>
						<td><a href="{{route( 'receitas.show',['receita'=> $receitas[$i]->id] )}}">
							{{$receitas[$i]->descricao}}
							</a>
						</td>
						<td>{{$receitas[$i]->valor}}</td>
						<td>{{$receitas[$i]->fixa}}</td>
						<td>{{$receitas[$i]->data}}</td>
					 </tr>
				@endfor

				</table>

			@else
				<p>Sem informações no banco de dados</p>
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