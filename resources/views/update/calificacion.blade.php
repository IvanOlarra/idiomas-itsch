@extends('layout/main')


@section('contenido-main')

<!--MODULO   Para Agregar   -->

<div class="modal-dialog modal-xl">
    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Modificar Calificacion</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @foreach ($seleccalificacion as $informacion )
        <form action="{{ route('update.modoficar-calificacion', $informacion->ID_CALIFICACION ) }}" method="POST">
            @method('PATCH')
            @csrf


            <div class="row>">
                <div class="col-sm">



                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">ID:</label>
                                <input type="text" name="ID_CALIFICACION" class="form-control form-control-sm"
                                    maxlength="30" placeholder="ID" value="{{ $informacion->ID_CALIFICACION }}" required
                                    disabled>
                                {!! $errors->first('ID_CALIFICACION','<span class="alert-danger">:message</span><br>')
                                !!}

                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Alumno:</label>

                                <select name="CALIFICACION_ID_ALUMNO" class="form-control form-control-sm"
                                    id="exampleFormControlSelect1" required>


                                    <option value={{ $informacion->ID_ALUMNO }}>{{ $informacion->ALUMNO_NOMBRE }}
                                        {{ $informacion->ALUMNO_APELLIDO_PAT }}
                                        {{ $informacion->ALUMNO_APELLIDO_MAT }}</option>

                                    <?php foreach ($selecalum as $item) {?> <option value="{{ $item->ID_ALUMNO }}">
                                        <?php echo $item->ALUMNO_NOMBRE," ",$item->	ALUMNO_APELLIDO_PAT , " ",$item->ALUMNO_APELLIDO_MAT; ?>
                                    </option>
                                    <?php
                                                }//cierro el foreach
                                                ?>


                                </select>

                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Plan de Estudio:</label>

                                <select name="CALIFICACION_ID_PLANESTUDIO" class="form-control form-control-sm"
                                    id="exampleFormControlSelect1" required>



                                    <option>{{ $informacion->ID_PLANESTUDIO }}</option>
                                    <?php foreach ($selecplan as $item) {?> <option>
                                        <?php echo $item->	ID_PLANESTUDIO ; ?> </option>
                                    <?php
                                                }//cierro el foreach
                                                ?>


                                </select>

                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Grupo:</label>

                                <select name="CALIFICACION_ID_GRUPO_NOMBRE" class="form-control form-control-sm"
                                    id="exampleFormControlSelect1" required>


                                    <option>{{ $informacion->ID_GRUPO_NOMBRE }}</option>
                                    <?php foreach ($selecgrupo as $item) {?> <option>
                                        <?php echo $item->	ID_GRUPO_NOMBRE ; ?> </option>
                                    <?php
                                                }//cierro el foreach
                                                ?>


                                </select>

                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Docente:</label>

                                <select name="CALIFICACION_ID_DOCENTE" class="form-control form-control-sm"
                                    id="exampleFormControlSelect1" required>



                                    <option value={{ $informacion->ID_DOCENTE }}>{{ $informacion->DOCENTE_NOMBRE }}
                                        {{$informacion->DOCENTE_AP_PAT  }} {{ $informacion->DOCENTE_AP_MAT }}
                                    </option>
                                    <?php foreach ($selecdocente as $item)  {?>

                                    <option value={{ $item->ID_DOCENTE}}>

                                        <?php  echo $item->	DOCENTE_NOMBRE," ", $item->	DOCENTE_AP_PAT," ", $item->	DOCENTE_AP_MAT ; 
                                                
                                                    
                                                ?>
                                        </>

                                        <?php
                                           
                                  
                                                    }//cierro el foreach
                                                    ?>


                                </select>

                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Modulo:</label>

                                <select name="CALIFICACION_ID_MODULO" class="form-control form-control-sm"
                                    id="exampleFormControlSelect1" required>

                                    <option>{{ $informacion->ID_MODULO }}</option>
                                    <?php foreach ($selecmodulo as $item) {?> <option>
                                        <?php echo $item->ID_MODULO; ?> </option>
                                    <?php
                                                }//cierro el foreach
                                                ?>


                                </select>

                            </div>

                        </div>




                        <div class="col-sm">


                            <div class="form-group">
                                <label for="exampleFormControlInput1">Clase:</label>
                                <input name="CALIFICACION_CLASE" value="{{ $informacion->CALIFICACION_CLASE }}"
                                    type="tel" maxlength="3" pattern="[0-9]{1,3}" class="form-control form-control-sm"
                                    placeholder="Clase" required>
                                {!! $errors->first('CALIFICACION_CLASE','<span
                                    class="alert-danger">:message</span><br>')
                                !!}
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Parcial 1:</label>
                                <input name="P1" pattern="[0-9]{1,3}" value="{{ $informacion->P1 }}" type="tel"
                                    maxlength="3" class="form-control form-control-sm" placeholder="Parcial 1" required>
                                {!! $errors->first('P1','<span class="alert-danger">:message</span><br>')
                                !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Parcial 2:</label>
                                <input name="P2" pattern="[0-9]{1,3}" value="{{ $informacion->P2 }}" type="tel"
                                    maxlength="3" class="form-control form-control-sm" placeholder="Parcial 2" required>
                                {!! $errors->first('P2','<span class="alert-danger">:message</span><br>')
                                !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Parcial 3:</label>
                                <input name="P3" pattern="[0-9]{1,3}" value="{{ $informacion->P3 }}" type="tel"
                                    maxlength="3" class="form-control form-control-sm" placeholder="Parcial 3" required>
                                {!! $errors->first('P3','<span class="alert-danger">:message</span><br>')
                                !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Parcial 4:</label>
                                <input name="P4" pattern="[0-9]{1,3}" value="{{ $informacion->P4 }}" type="tel"
                                    maxlength="3" class="form-control form-control-sm" placeholder="Parcial 4" required>
                                {!! $errors->first('P4','<span class="alert-danger">:message</span><br>')
                                !!}
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlInput1">Parcial final:</label>
                                <input name="PF" pattern="[0-9]{1,3}" value="{{ $informacion->PF }}" type="tel"
                                    maxlength="3" class="form-control form-control-sm" placeholder="Parcial final"
                                    required>
                                {!! $errors->first('PF','<span class="alert-danger">:message</span><br>')
                                !!}
                            </div>
                        </div>

                    </div>





                </div>

                @endforeach
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Agregar</button>

            </div>
        </form>

    </div>
</div>




<!--FINAL  Modulo-->


@endsection