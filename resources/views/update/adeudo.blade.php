@extends('layout/main')


@section('contenido-main')




<div class="modal-dialog modal-xl">
    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Editar Adeudo</h5>
        </div>
        @foreach ($selecadeudo as $informacion)
        <form action="{{ route('update.modoficar-adeudo', $informacion->ID_ADEUDO ) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Alumno:</label>
                            <input type="text" name="ID_ADEUDO" class="form-control form-control-sm" maxlength="30"
                                placeholder="Adeudo" value="{{ $informacion->ALUMNO_NOMBRE }} {{ $informacion->ALUMNO_NOMBRE }} {{ $informacion-> ALUMNO_APELLIDO_MAT}} {{ $informacion->ALUMNO_APELLIDO_PAT }}" disabled>
                            {!! $errors->first('ID_ADEUDO','<span class="alert-danger">:message</span><br>')
                            !!}
                        </div>
                        <div class="form-group" hidden>
                            <label for="exampleFormControlInput1">Alumno:</label>
                            <input type="text" name="ID_ALUMNO" class="form-control form-control-sm" maxlength="30"
                                placeholder="Adeudo" value="{{ $informacion->ID_ALUMNO }}">
                            {!! $errors->first('ID_ADEUDO','<span class="alert-danger">:message</span><br>')
                            !!}
                        </div>
                        <div class="form-group" hidden>
                            <label for="exampleFormControlInput1">Alumno:</label>
                            <input type="text" name="ID_INSCRIPCION" class="form-control form-control-sm" maxlength="30"
                                placeholder="Adeudo" value="{{ $informacion->ID_INSCRIPCION }}">
                            {!! $errors->first('ID_ADEUDO','<span class="alert-danger">:message</span><br>')
                            !!}
                        </div>
                        <div class="form-row mb-3">
                            <div class="col">
                                <label for="exampleFormControlInput1">Adeudo:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control"  name="ADEUDO_MONTO"
                                    value="{{  $informacion->ADEUDO_MONTO }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="exampleFormControlInput1 ">Fecha de
                                Adeudo:</label>
                            <input name="ADEUDO_FECHA" class="form-control form-control-sm" type="date"
                                value="{{  $informacion->ADEUDO_FECHA }}" id="example-date-input">
                        </div>
                        <div class="form-row mb-3">
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="ADEUDO_DESCRIPCION" value="{{  $informacion->ADEUDO_DESCRIPCION }}" maxlength="500"
                                        rows="3" placeholder="Observaciones"></textarea>
                            </div>
                    </div>
                    @endforeach
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Editar</button>

                </div>
        </form>

    </div>
</div>








<!--FINAL  CUADRO SALIDA AGREGAR ADEUDO->


@endsection