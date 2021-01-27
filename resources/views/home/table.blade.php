@section('css-link2')
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

<div class="table-responsive">
	<table class="table table-striped" id="tabela-resumo">		
		<thead>
			<tr>
				<th>Tipo</th>
				<th>Janeiro</th>
				<th>Fevereiro</th>
				<th>Março</th>
				<th>Abril</th>
				<th>Maio</th>
				<th>Junho</th>
				<th>Julho</th>
				<th>Agosto</th>
				<th>Setembro</th>
				<th>Outubro</th>
				<th>Novembro</th>
				<th>Dezembro</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>Total</th>
				@foreach($total['meses'] as $mes)
				<th class="text-primary">
					{{Formatter::realmonetary($mes)}}
				</th>
				@endforeach
			</tr>
			<tr>
				<th>Saldo</th>
				@foreach ($total['meses'] as $key => $item)
				<th class="text-success">
					{{
						Formatter::realmonetary(
							current($previsto['meses']) - $item + (next($previsto['meses'])-current($previsto['meses']))
						)
					}}
				</th>
				@endforeach
			</tr>			
		</tfoot>
		<tbody>
			@foreach(array_keys($categorias) as $tag)
			<tr>
				<td>{{$tag}}</td>

				@foreach (array_values($categorias[$tag]) as $mes)
				<td>
					{{Formatter::realmonetary($mes)}}
				</td>
				@endforeach
			</tr>
			@endforeach
		</tbody>

	</table>	
</div>

@section('script2')
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#tabela-resumo').DataTable();
	})
</script>
@endsection