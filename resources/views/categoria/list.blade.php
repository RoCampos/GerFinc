<div class="text-ts font-weight-bold text-primary mb-2">
    Categorias existentes
</div>
<div class="list-group">
	@foreach($categorias as $categoria)
	@if($categoria->principal)
	<div class="row align-items-center">
		<div class="col-md-3">
			<a href="{{'#col'.$categoria->id}}" class="list-group-item border-0 text-gray-900" data-toggle="collapse" role="button"><span class="badge badge-success">{{$categoria->despesas->count()}}</span>
				 {{$categoria->etiqueta}} <i class="fas fa-angle-down text-gray-900"></i>
			</a>
		</div>
	</div>
	<div class="collapse" id="{{'col'.$categoria->id}}">
		@foreach ($categoria->subgrupos() as $subcat)
		<div class="row align-items-center">
			<div class="col-md-3">
				<div href="" class="list-group-item border-0 ml-2 text-gray-800">
					<span class="badge badge-success">{{$subcat->despesas->count()}}</span> 
					{{$subcat->etiqueta}}
				</div>	
			</div>
		</div>
		@endforeach
	</div>
	@endif
	@endforeach

</div>