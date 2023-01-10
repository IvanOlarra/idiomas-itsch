@extends('layout/main')

@section('contenido-main')



<div class="container">
    @if(Session::get('errorid'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="alert-heading">Alerta!</h4>
        <p>{{ Session::get('errorid') }}</p>


    </div>
    @endif

</div>
<!--INICIO CUADRO SALIDA AGREGAR PLAN-->


<div class="modal-dialog modal-xl">
    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Agregar Plan de Estudio</h5>

        </div>
        @foreach ($selecplan as $informacion )
        <form action="{{ route('update.modoficar-plan', $informacion->ID_PLANESTUDIO ) }}" method="POST">
            @method('PATCH')
            @csrf


            <div class="row>">
                <div class="col-sm">




                    <div class="form-group">
                        <label for="exampleFormControlInput1">ID:</label>
                        <input type="text" name="ID_PLANESTUDIO" class="form-control form-control-sm"
                            pattern="[A-Zz-a]{1,30}" maxlength="30" placeholder="ID Plan"
                            value="{{ $informacion->ID_PLANESTUDIO}}" required>
                        {!! $errors->first('ID_PLANESTUDIO','<span class="alert-danger">:message</span><br>')
                        !!}

                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Clave:</label>
                        <input type="text" name="PLAN_CLAVE" pattern="[a-zZ-A]{1,30}" maxlength="30"
                            class="form-control form-control-sm" placeholder="Clave"
                            value="{{ $informacion->PLAN_CLAVE }}" required>
                        {!! $errors->first('PLAN_CLAVE','<span class="alert-danger">:message</span><br>')
                        !!}


                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Idioma:</label>
                        <select name="PLAN_NOMBRE_IDIOMA" class="form-control form-control-sm"
                            id="exampleFormControlSelect1">

                            <option> {{ $informacion->PLAN_NOMBRE_IDIOMA }} </option>

                            <option> INGLÉS </option>
                            <option> ESPAÑOL </option>
                            <option> FRANCÉS </option>
                            <option> ITALIANO </option>
                            <option> RUSO </option>


                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleFormControlInput1">Inicio:</label>
                        <input type="date" name="PLAN_IN" pattern="[a-zZ-A]{1,30}" maxlength="30"
                            class="form-control form-control-sm" placeholder="Inicio del Plan"
                            value="{{ $informacion->PLAN_IN }}" required>
                        {!! $errors->first('PLAN_IN','<span class="alert-danger">:message</span><br>')
                        !!}


                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Final:</label>
                        <input type="date" name="PLAN_FIN" pattern="[a-zZ-A]{1,30}" maxlength="30"
                            class="form-control form-control-sm" placeholder="Final del Plan"
                            value="{{ $informacion->PLAN_FIN }}" required>
                        {!! $errors->first('PLAN_FIN','<span class="alert-danger">:message</span><br>')
                        !!}


                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Estado:</label>
                        <input type="text" name="PLAN_ESTADO" pattern="[a-zZ-A]{1,30}" maxlength="30"
                            class="form-control form-control-sm" placeholder="Estado del Plan"
                            value="{{ $informacion->PLAN_ESTADO }}" required>
                        {!! $errors->first('PLAN_ESTADO','<span class="alert-danger">:message</span><br>')
                        !!}


                    </div>


                    <div class="form-group">
                        <label for="exampleFormControlInput1">Cantidad de Modulos:</label>
                        <input type="text" name="PLAN_CMOD" pattern="[a-zZ-A]{1,30}" maxlength="30"
                            class="form-control form-control-sm" placeholder="Cantidad de Modulos"
                            value="{{ $informacion->PLAN_CMOD }}" required>
                        {!! $errors->first('PLAN_CMOD','<span class="alert-danger">:message</span><br>')
                        !!}


                    </div>



                </div>
                @endforeach

            </div>

            <div class="modal-footer">
                <a href="/plan-estudio" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</a>
                <button type="submit" class="btn btn-success">Modificar</button>

            </div>
        </form>

    </div>
</div>



<!--FINAL  CUADRO SALIDA MODIFICAR PLAN-->


@endsection