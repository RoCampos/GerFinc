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
						<th>Edição</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Descrição</th>
						<th>Valor</th>
						<th>Renda Fixa</th>
						<th>Compensação</th>
						<th>Edição</th>
					</tr>
				</tfoot>
				<tbody>
					@for($i = 0; $i < count($receitas); $i++)
						<tr id="{{'r'.$receitas[$i]->id}}">
							<td>
								{{$receitas[$i]->descricao}}
							</td>
							<td>
								@if($receitas[$i]->recebido)
								<div class="text-success">
									{{Formatter::realmonetary($receitas[$i]->valor)}}
								</div>
								@else
									{{Formatter::realmonetary($receitas[$i]->valor)}}
								@endif
							</td>
							<td>@if($receitas[$i]->fixa) Sim @endif</td>
							<td>
								{{Formatter::dataformat($receitas[$i]->data)}}
							</td>

							<td>
								<a id="{{'upd'.$receitas[$i]->id}}" href="" class="btn btn-link" data-toggle="modal" data-target="#editmodal">
									<i class="fas fa-edit">
									</i>
								</a>
								<a id="{{'del'.$receitas[$i]->id}}" href="" class="btn btn-link" data-toggle="modal" data-target="#deletemodal">
									<i class="fas fa-trash"></i>
								</a>
							</td>
						</tr>
					@endfor

				</tbody>

			</table>
		</div>
	</div>
</div>


<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Receita</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <div class="modal-body">
            	
            	@include('receita.edit')

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" href="#" id="edit-submit" onclick="">Salvar</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remover Receita?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" href="#" id="destroy-submit" onclick="">Salvar</a>
            </div>
            <form id="destroy-form" action="" method="POST">
            	@csrf
            	@method('DELETE')
            	
            </form>
        </div>
    </div>
</div>


