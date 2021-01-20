<form action='#' method="POST">
	@csrf
	<div class="form-group">
		<label for="edit-descricao">
			Descrição
		</label>
		<input type="text" name="edit-descricao" id="edit-descricao" class="form-control">
	</div>

	<div class="form-row align-items-center">
		<div class="form-group col-md-4">
			<label for="edit-data" class="form-control-label">
				Data de Compensação
			</label>
			<input type="date" name="edit-data" id="edit-data" class="form-control" data-provide="datapicker">
		</div>

		<div class="form-group col-md-5">
			<label for="edit-valor">Valor Total (R$)</label>
			<input type="text" name="edit-valor" id="edit-valor" class="form-control">
		</div>

		<div class="col-md-3">
			<div class="form-check">
				<input type="checkbox" class="form-check-input" name="edit-fixa" id="edit-fixa"/>

				<label for="edit-fixa" class="form-check-label">Despesa Fixa</label>
			</div>
		</div>			
	</div>

	<div class="form-row">
		<div class="form-group col-md-4">
			<div class="form-check">
				<input type="checkbox" class="form-check-input" name="edit-parcelado" id="edit-parcelado"/>

				<label for="edit-parcelado" class="form-check-label">Parcelas</label>
			</div>
			<div class="form-group">
				<input type="text" min="0" step="any" name="edit-parcelas" id="edit-parcelas" class="form-control">	
			</div>
			
		</div>

		<div class="form-group col-md-8">
			<div class="form-check">
				<input type="checkbox" class="form-check-input" name="edit-repetir" id="edit-repetir"/>
				<label for="edit-repetir" class="form-check-label">Repetir</label>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					{{-- <label>Data Inicial</label> --}}
					<input type="date" name="edit-data2" id="edit-data2" class="form-control" data-provide="datapicker">
				</div>
				<div class="form-group col-md-6">
					{{-- <label>Data Final</label> --}}
					<input type="date" name="edit-data3" id="edit-data3" class="form-control" data-provide="datapicker">
				</div>
			</div>
		</div>
	</div>
</form>


