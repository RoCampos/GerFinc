<form id="parc-form" method="POST">
	@csrf
	@method('PUT')
	<div class="form-row row">
		<div class="form-group col-md-6">
			<label class="form-control-label">Valor</label>
			<input type="text" name="parc-edit-valor" id="parc-edit-valor" class="form-control">
		</div>
		<div class="form-group col-md-6">
			<label class="form-control-label">Data</label>
			<input type="date" id="parc-edit-data" name="parc-edit-data" class="form-control" data-provide="datapicker">
		</div>
	</div>
</form>