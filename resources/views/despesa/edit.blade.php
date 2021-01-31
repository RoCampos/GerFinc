<form action='{{route('despesas.update', ['despesa'=>$despesa->id])}}' method="POST" id="despesa-form-edit">
	@csrf
	@method('PUT')
	<div class="form-group">
		<label for="despesa-edit-descricao">
			Descrição
		</label>
		<input type="text" name="despesa-edit-descricao" id="despesa-edit-descricao" class="form-control">
	</div>

	<div class="form-row align-items-center">
		<div class="form-group col-md-6">
			<label for="despesa-edit-data" class="form-control-label">
				Data de Compensação
			</label>
			<input type="date" name="despesa-edit-data" id="despesa-edit-data" class="form-control" data-provide="datapicker">
		</div>

		<div class="form-group col-md-6">
			<label for="despesa-edit-valor">Valor Total (R$)</label>
			<input type="text" name="despesa-edit-valor" id="despesa-edit-valor" class="form-control">
		</div>

					
	</div>
	<div class="form-group">
		<div class="form-check">
			<input type="checkbox" class="form-check-input" name="despesa-edit-fixa" id="despesa-edit-fixa"/>

			<label for="despesa-edit-fixa" class="form-check-label">Despesa Fixa</label>
		</div>
	</div>
</form>


