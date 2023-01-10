@extends('layout/main')

@section('contenido-main')


<div class="container">
    <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
        </li>
    </ul>
</div>
<div class="modal-dialog modal-l">
    <div class="modal-content">
        <div class="modal-header">
            <h5>Abrir Parciales</h5>
        </div>
        <form action="{{ route('parciales.actualizado') }}" method="POST">
            @method('PATCH')
            @csrf
        <div class="col-sm">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="parcial1" @if($informacion['parcial1'] == 1)) checked @endif>
                <label class="form-check-label" for="defaultCheck1">
                 Parcial 1
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox"   name="parcial2"  @if($informacion['parcial2'] == 1)) checked @endif>
                <label class="form-check-label" for="defaultCheck2">
                  Parcial 2
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox"  name="parcial3"  @if($informacion['parcial3'] == 1)) checked @endif>
                <label class="form-check-label" for="defaultCheck3">
                 Parcial 3
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox"  name="parcial4"  @if($informacion['parcial4'] == 1)) checked @endif>
                <label class="form-check-label" for="defaultCheck">
                  Parcial 4
                </label>
              </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success">Cambiar</button>

        </div>
        </form>

    </div>
</div>
















@endsection