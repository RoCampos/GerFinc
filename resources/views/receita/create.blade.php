<form action="{{route('receitas.store')}}" method="POST">
	@csrf
	<div class="form-row align-items-center justify-content-between">
		<div class="form-group col-md-8">
			<label class="form-label">
				Descrição
			</label>
			<input type="text" name="descricao" placeholder="Descrição da Receita" class="form-control">	
		</div>
		<div class="form-group col-md-4">
			<label class="form-label">
				Valor
			</label>
			<input type="text" id="valor" name="valor" placeholder="Insira o valor" class="form-control">	
		</div>
		
	</div>
	
	<div class="form-row align-items-center">
		<div class="form-group col-md-4">
			<div class="form-check">
				<input class="form-check-input" type="checkbox" id="fixa" name="fixa">
  				<label class="form-check-label" for="fixa">Fixo</label>	
			</div>
			<div class="form-check">
				<input class="form-check-input" type="checkbox" id="recebido" name="recebido">
  				<label class="form-check-label" for="recebido">Recebido</label>	
			</div>
		</div>
		<div class="form-group col-md-4">
			<label class="form-label">Data Inicial</label>	
			<input type="date" name="dtinicial" id="dtinicial" class="form-control" data-provide="datapicker">
		</div>
		<div class="form-group col-md-4">
			<label class="form-label">Data Final</label>	
			<input type="date" name="dtfinal" id="dtfinal" class="form-control" data-provide="datapicker">
		</div>
	</div>

	<div class="text-right">
		<button type="submit" class="btn btn-primary btn-user">
			Enviar
		</button>		
	</div>
</form>