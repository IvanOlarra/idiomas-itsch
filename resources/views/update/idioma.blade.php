@extends('layout/main')


@section('contenido-main')




<div class="modal-dialog modal-lg">
    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Modificar Idioma</h5>



        </div>

        @foreach ($selecidioma as $informacion )
        <form action="{{ route('update.modoficar-idioma', $informacion->ID_IDIOMA ) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="container">


                <div class="row">
                    <div class="col-sm">

                        <div class="form-group">
                            <label for="exampleFormControlInput1">ID Idioma:</label>
                            <input type="text" name="ID_IDIOMA" class="form-control form-control-sm"
                                pattern="[A-Zz-a]{1,30}" maxlength="30" placeholder="ID"
                                value="{{ $informacion->ID_IDIOMA }}" required disabled>
                            {!! $errors->first('ID_IDIOMA','<span class="alert-danger">:message</span><br>')
                            !!}

                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nombre:</label>
                            <input type="text" name="IDIOMA_NOMBRE" pattern="[a-zZ-A]{1,30}" maxlength="30"
                                class="form-control form-control-sm" placeholder="Nombre"
                                value="{{ $informacion->IDIOMA_NOMBRE }}" required>
                            {!! $errors->first(' IDIOMA_NOMBRE','<span class="alert-danger">:message</span><br>')
                            !!}


                        </div>

                    </div>

                </div>

                @endforeach
            </div>

            <div class="modal-footer">
                <a type="button" href="/idioma" class="btn btn-secondary" data-dismiss="modal">Cerrar</a>
                <button type="submit" class="btn btn-success">Modificar</button>
            </div>

        </form>
    </div>
</div>



<!--FINAL  CUADRO SALIDA AGREGAR IDIOMA-->


@endsection