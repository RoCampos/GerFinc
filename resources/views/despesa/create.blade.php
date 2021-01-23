@section('css-link3')
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endsection

<form id="despesa-form-create" action="{{route('despesas.store')}}" method="POST">
	@csrf
	<div class="form-group">
		<label for="descricao">
			Descrição
		</label>
		<input type="text" name="descricao" id="descricao" class="form-control" value="{{old('descricao')}}">
	</div>

	<div class="form-row align-items-center">
		<div class="form-group col-md-4">
			<label for="data" class="form-control-label">
				Data de Compensação
			</label>
			<input type="date" name="data" id="data" class="form-control" data-provide="datapicker" value="{{old('data')}}">
		</div>

		<div class="form-group col-md-5">
			<label for="valor">Valor Total (R$)</label>
			<input type="text" name="valor" id="valor" class="form-control" value="{{old('valor')}}">
		</div>

		<div class="col-md-3">
			<div class="form-check">
				<input type="checkbox" class="form-check-input" name="fixa" id="fixa" onchange="despesa_fixa(this);" />

				<label for="fixa" class="form-check-label">Despesa Fixa</label>
			</div>
		</div>
	</div>

	<div class="form-row">
		<div class="form-group col-md-4">
			<div class="form-check">
				<input type="checkbox" class="form-check-input" name="parcelado" id="parcelado" onchange="eh_parcelado(this)" />

				<label for="parcelado" class="form-check-label">Parcelas</label>
			</div>
			<div class="form-group">
				<input type="text" min="0" step="any" name="parcelas" id="parcelas" class="form-control">	
			</div>
			
		</div>

		<div class="form-group col-md-8">
			<div class="form-check">
				<input type="checkbox" class="form-check-input" name="repetir" id="repetir"/>
				<label for="repetir" class="form-check-label">Repetir</label>
			</div>
			<div class="form-row">
				<div class="form-group col-md-6">
					{{-- <label>Data Inicial</label> --}}
					<input type="date" name="data2" id="data2" class="form-control" data-provide="datapicker">
				</div>
				<div class="form-group col-md-6">
					{{-- <label>Data Final</label> --}}
					<input type="date" name="data3" id="data3" class="form-control" data-provide="datapicker">
				</div>
			</div>

		</div>
	</div>
	
</form>

@section('script3')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
		
	</script>

	<script type="text/javascript">
		function despesa_fixa(source) {
			parc = document.getElementById('parcelado');
			text = document.getElementById('parcelas');

			dt2 = document.getElementById('data2');
			dt3 = document.getElementById('data3');
			ck = document.getElementById('repetir');

			if (source.checked) {
				parc.disabled = true;
				text.disabled = true;
				dt2.disabled = false;
				dt3.disabled = false;
				ck.disabled = false;
			} else {
				parc.disabled = false;
				text.disabled = false;
				dt2.disabled = true;
				dt3.disabled = true;
				ck.disabled = true;
			}
		}

		function eh_parcelado (source) {
			fixa = document.getElementById('fixa');
			dt2 = document.getElementById('data2');
			dt3 = document.getElementById('data3');
			ck = document.getElementById('repetir');

			if (source.checked) {
				fixa.disabled = true;
				dt2.disabled = true;
				dt3.disabled = true;
				ck.disabled = true;
			} else {
				fixa.disabled = false;
				dt2.disabled = false;
				dt3.disabled = false;
				ck.disabled = false;
			}
		}

		function money() {
			var value = parseInt(document.getElementById("valor").value);

			const formatter = new Intl.NumberFormat('pt-BR', {
				minimumFractionDigits: 2,
				maximumFractionDigits: 2,
			});

			document.getElementById("valor").value = formatter.format(value);
			
		}

		$(document).ready(function(){
			$('#valor').focusout (function(e){
				if ($(this).val() == "") return;
				var val = $(this).val().replace(',','.');
				var valor = parseFloat(val);
				var res = valor.toLocaleString('pt-BR',{
					minimumFractionDigits: 2,
					maximumFractionDigits: 2,
				});
				$(this).val(res);
			});
		});

	</script>

	<script type="text/javascript">
		$('#data').datepicker({

		});
		$('#data2').datepicker({

		});
		$('#data3').datepicker({

		});
	</script>
	
@endsection
