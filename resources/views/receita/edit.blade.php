<form method="POST" id="editform">
	@csrf
	@method('PUT')
	<div class="form-row align-items-center justify-content-between">
		<div class="form-group col-12">
			<label class="form-label">
				Descrição
			</label>
			<input type="text" id="editescricao" name="editdescricao" placeholder="Descrição da Receita" class="form-control">	
		</div>
	</div>

	<div class="form-row align-items-center justify-content-between">
		<div class="form-group col-md-6">
			<label class="form-label">
				Valor
			</label>
			<input type="text" id="editvalor" name="editvalor" placeholder="Insira o valor" class="form-control">	
		</div>
		<div class="form-group col-md-6">
			<label class="form-label">Data</label>	
			<input type="date" name="editdata" id="editdata" class="form-control" data-provide="datapicker">
		</div>
	</div>
</form>