@extends('layout.index')

@section('css-link')

<!-- Custom styles for this page -->
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<script src="https://unpkg.com/feather-icons"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
@endsection

@section('conteudo')

		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Receitas</h1>
			<a href="{{route('receitas.create')}}" class="btn btn-primary">
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
								<th>Valor</th>
								<th>Renda Fixa</th>
								<th>Compensação</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Descrição</th>
								<th>Valor</th>
								<th>Renda Fixa</th>
								<th>Compensação</th>
							</tr>
						</tfoot>
						<tbody>
							@for($i = 0; $i < count($receitas); $i++)
								<tr>
									<td>
										<a href="{{route( 'receitas.show',['receita'=> $receitas[$i]->id] )}}">
												{{$receitas[$i]->descricao}}
										</a>
									</td>
									<td>{{$receitas[$i]->valor}}</td>
									<td>@if($receitas[$i]->fixa) Sim @endif</td>
									<td>{{\Carbon\Carbon::parse($receitas[$i]->data)->format('d/m/Y')}}
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

    <script>
  		feather.replace()
	</script>
@endsection