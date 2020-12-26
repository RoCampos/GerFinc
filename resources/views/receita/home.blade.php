@extends('layout.index') 

@section('css-link')                 
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet)}}">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
@endsection

@section('conteudo')
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Receitas</h1>
		</div>
		
		
		<a href="{{route('receitas.create')}}" class="btn btn-primary">
				<i data-feather="plus-circle"></i>
			</a>
		</h1>

		<hr>

		<div class="card mb-4">
			<div class="card-body">
				<div class="table-responsive">

					@if(count($receitas))

						<table class="table table-striped table-bordered" id="tabela" width="100%" cellspacing="0">
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
										<td>{{ \Carbon\Carbon::parse($receitas[$i]->data)->format('d/m/Y')}}</td>
									 </tr>
								 @endfor
							 </tbody>
						</table>

					@else
						<p>Sem informações no banco de dados</p>
					@endif
				</div>
			</div>
		</div>
		
@endsection

@section('script')


<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}">
</script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}">	
</script>

<script type="text/javascript">
	$(document).ready(function() {
    $('#tabela').DataTable({
    	columnDefs: [
    		{
    			targets: [0],
    			orderData: [0,1]
    		},
    	]
    });
} );
</script>
@endsection