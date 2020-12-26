<!DOCTYPE html>
<html>
<head>
	<title>
		Criar Receita
	</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	
	<script src="https://unpkg.com/feather-icons"></script>
	<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
</head>
<body>


	<div class="container">
	
		<div class="row">
			<h1>
				Receita
			</h1>	
		</div>
		
		<hr>

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

				<button type="submit" class="btn btn-primary">
					Enviar
				</button>
			</form>

			</div>


		</div>


	</div>

	<script>
  		feather.replace()
	</script>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

</body>
</html>