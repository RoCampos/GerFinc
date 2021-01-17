@extends('layout.index')

@section('css-link')

<!-- Custom styles for this page -->
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('conteudo')

		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Despesas</h1>
			<a href="{{route('despesas.create')}}" class="btn btn-primary btn-circle">
				<i data-feather="plus-circle"></i>
			</a>

        </div>

		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped" id="tabela">

						<thead>
							<tr>
								<th>Descrição</th>
								<th>Fixa</th>
								<th>Data</th>
								<th>Status</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Descrição</th>
								<th>Fixa</th>
								<th>Data</th>
								<th>Status</th>
							</tr>
						</tfoot>
						<tbody>
							@for($i = 0; $i < count($despesas); $i++)
								<tr>
									<td>
										<a href="{{route('despesas.show', ['despesa'=>$despesas[$i]->id])}}">
											{{$despesas[$i]->descricao}}	
										</a>
									</td>
									<td>
										@if($despesas[$i]->fixa) 
											Sim
										@endif
									</td>
									<td>
										{{Formatter::dataformat($despesas[$i]->data)}}
									</td>
									<td>
										-
									</td>
								</tr>
							@endfor
						</tbody>
					</table>
				</div>
			</div>
		</div>
@endsection


@section('script')
<!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script>
    	$(document).ready(function() {
  			$('#tabela').DataTable();
		});
    </script>
@endsection