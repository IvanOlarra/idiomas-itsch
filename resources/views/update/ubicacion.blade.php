@extends('layout/main')


@section('contenido-main')



<!--INICIO CUADRO SALIDA AGREGAR UBICACION-->




<div class="modal-dialog modal-lg">
    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Agregar Ubicacion</h5>



        </div>


        @foreach ($selecubicacion as $informacion )
        <form action="{{ route('update.modoficar-ubicacion', $informacion->ID_UBICACION ) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="container">




                <div class="row">
                    <div class="col-sm">

                        <div class="form-group">
                            <label for="exampleFormControlInput1">ID:</label>
                            <input type="text" name="ID_UBICACION" class="form-control form-control-sm"
                                pattern="[A-Zz-a]{1,30}" maxlength="30" placeholder="ID"
                                value="{{ $informacion->ID_UBICACION }}" required disabled>
                            {!! $errors->first('ID_UBICACION','<span class="alert-danger">:message</span><br>')
                            !!}

                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Edificio:</label>
                            <input type="text" name="UBICACION_EDIFICIO" pattern="[a-zZ-A]{1,2}"
                                class="form-control form-control-sm" maxlength="1" placeholder="Edificio"
                                value="{{ $informacion->UBICACION_EDIFICIO }}" required>
                            {!! $errors->first('UBICACION_EDIFICIO','<span class="alert-danger">:message</span><br>')
                            !!}

                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Salon:</label>
                            <input name="UBICACION_SALON" value="{{ $informacion->UBICACION_SALON }}" type="tel"
                                maxlength="11" pattern="[0-9]{1,11}" class="form-control form-control-sm"
                                placeholder="Numero de Salon" required>
                            {!! $errors->first('UBICACION_SALON','<span class="alert-danger">:message</span><br>')
                            !!}
                        </div>

                    </div>
                    @endforeach
                </div>


            </div>

            <div class="modal-footer">
                <a type="button" href="/ubicacion" class="btn btn-secondary" data-dismiss="modal">Cerrar</a>
                <button type="submit" class="btn btn-success">Modificar</button>
            </div>

        </form>
    </div>
</div>



<!--FINAL  CUADRO SALIDA AGREGAR UBICACION-->
@endsection


<!--FINAL  CUADRO SALIDA modificar UBICACION-->