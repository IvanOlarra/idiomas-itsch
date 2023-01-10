@extends('layout/main')


@section('contenido-main')
<!--INICIO CUADRO SALIDA AGREGAR MODULO-->


<div class="modal-dialog modal-sm">
    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Agregar Modulo</h5>



        </div>


        @foreach ($selecmodulo as $informacion )
        <form action="{{ route('update.modIficar-modulo', $informacion->ID_MODULO ) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="container">


                <div class="row">
                    <div class="col-sm">

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Clave:</label>
                            <input type="text" name="ID_MODULO" class="form-control form-control-sm"
                                pattern="[A-Zz-a]{1,30}" maxlength="30" placeholder="Clave"
                                value="{{ $informacion->ID_MODULO }}" required disabled>
                            {!! $errors->first('ID_MODULO','<span class="alert-danger">:message</span><br>')
                            !!}

                        </div>



                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nombre Reticula:</label>
                            <input type="text" name="RETICULA_NOMBRE" class="form-control form-control-sm" maxlength="5"
                                placeholder="Reticula" value="{{ $informacion->RETICULA_NOMBRE }}" required>
                            {!! $errors->first('RET_NOM','<span class="alert-danger">:message</span><br>')
                            !!}

                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Plan de Estudio:</label>

                            <select name="ID_PLANESTUDIO" value='{{$informacion->ID_PLANESTUDIO}}' class="form-control form-control-sm"
                                id="exampleFormControlSelect1" required>

                                <option value='{{$informacion->ID_PLANESTUDIO}}'> {{ $informacion->PLAN_NOMBRE_IDIOMA }}</option>
                                <?php foreach ($selecplan as $item) {?>
                                <option value='{{$item->ID_PLANESTUDIO}}'>
                                    <?php echo $item->PLAN_NOMBRE_IDIOMA; ?>
                                </option>
                                <?php
                                    }//cierro el foreach
                                    ?>


                            </select>

                            {!! $errors->first('ID_PLANESTUDIO','<span class="alert-danger">:message</span><br>')
                            !!}
                        </div>


                    </div>

                </div>
                @endforeach

            </div>

            <div class="modal-footer">
                <a type="button" href="/modulo" class="btn btn-secondary" data-dismiss="modal">Cerrar</a>
                <button type="submit" class="btn btn-success">Modificar</button>
            </div>

        </form>
    </div>
</div>



<!--FINAL  CUADRO SALIDA AGREGAR IDIOMA-->
@endsection