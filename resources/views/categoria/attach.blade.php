<div class="text-ts font-weight-bold text-primary mb-2">
    Vincular Grupos e Subgrupos
</div>
<hr>
<form action="{{route('categorias.attachcategoria')}}" method="POST" id="form-vincular">
    @csrf
    <div class="form-group">
    	<label class="form-control-label">Principal</label>
    	<select class="form-select" id="grupo" name="grupo">
        @if($categorias)
    		@foreach ($categorias as $element)
    		<option value="{{$element->id}}" @if(old('grupo') == $element->id) selected="selected" @endif>{{$element->etiqueta}}</option>
    		@endforeach
        @endif
    	</select>
    </div>

    <input type="hidden" name="select" id="select">

    <div class="form-group">
    	<label class="form-control-label">Secundário</label>
    	<select class="form-select" id="subgrupo" name="subgrupo">
        @if($categorias->count())
    		@foreach ($categorias->first()->available()->get() as $element)
            <option value="{{$element->id}}" @if(old('grupo') == $element->id) selected="selected" @endif>{{$element->etiqueta}}</option>
            @endforeach
        @endif
    	</select>
    </div>

    <div class="form-group">
        <button class="btn btn-primary float-right">
            Vincular
        </button>
    </div>
</form>

@section('script2')

<script type="text/javascript">
	$(document).ready(function(){
		var select = document.querySelector('#grupo');

        select.onchange = function(e) {
            id = $(this).children("option:selected").val();

            var CSRF_TOKEN = "{{csrf_token()}}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                }
            })
            $.ajax({
                url: "{{route('categorias.available')}}",
                type: 'POST',
                data: {id: $(this).children("option:selected").val()},
                dataType: 'JSON',
                success: function(data) {
                    var items = JSON.parse(data.msg);
                    var select = document.querySelector('#subgrupo');

                    $(select).find('option').remove().end();
                    for (item of items) {
                        var child = document.createElement('option')
                        child.setAttribute('value', item.id);
                        child.innerHTML = item.etiqueta;
                        $(select).append(child);
                        console.log(select);
                    }

                }
            });
            // return false;  
        }

	});
</script>

@endsection

