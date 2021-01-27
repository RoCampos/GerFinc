<div class="text-ts font-weight-bold text-primary mb-2">
    Cadastrar nova categoria
</div>
<hr>
<form action="{{route('categorias.store')}}" method="POST" id="tag">
    @csrf
    <div class="form-group">
        <input type="text" placeholder="Nova Categoria" name="tag" class="form-control">
        <input type="hidden" name="despesa">    
    </div>

    <div class="form-group">
    	<div class="form-check">
    		<input type="checkbox" class="form-check-input" name="principal" id="principal">
    		<label class="form-check-label" for="principal">Principal</label>
    	</div>
    </div>

    <div class="form-group">
        <button class="btn btn-primary float-right">
            Cadastrar
        </button>
    </div>
</form>
