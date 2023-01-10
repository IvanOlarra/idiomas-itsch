<div class="dropdown">
    <input maxlength="30" type="hidden" id="buscaremail" name="{{$nombre}}" value="{{$identificador}}" required>
    {!! $errors->first('ADMIN_CORREO', '<spanclass="alert-danger">:message</span><br>') !!}
    <input type="text" class="form-control {{ $seleccionado ? 'is-valid' : 'is-invalid' }}" id="busqueda"
        wire:model.debounce.500ms="busqueda" autocomplete="off" placeholder="ejemplo@itsch.edu.mx" required />
    <div class="form-group ajax-search">
        <ul id="resultados" class="dropdown-menu @if (sizeof($resultado) > 0 && !$seleccionado) show @endif ">
            @foreach ($resultado as $res)
                <li class="dropdown-item" wire:click="seleccionar({{ $res['id'] }}, '{{ $res['email'] }}')">{{ $res['email'] }}</li>
            @endforeach
        </ul>
    </div>
</div>
