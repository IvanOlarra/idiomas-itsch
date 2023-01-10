@extends('layout/main')


@section('contenido-main')

<!--Cuadro a Salir para ModificarGrupo-->


<div class="modal-dialog modal-xl">
    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Modificar Grupo</h5>

        </div>


        @foreach ($selecgrupo as $informacion )
        <form action="{{ route('update.modoficar-grupo', $informacion->ID_GRUPO ) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="container">

                <div class="row">
                    <!--Columna 1-->
                    <div class="col-sm">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">ID:</label>
                                <input type="text" name="ID_GRUPO_NOMBRE" value="{{ $informacion->ID_GRUPO }}"
                                    pattern="[A-Zz-a]{1,30}" class="form-control form-control-sm" maxlength="30"
                                    placeholder="ID" required disabled>
                                {!! $errors->first('ID_GRUPO_NOMBRE','<span class="alert-danger">:message</span><br>')
                                !!}

                            </div>



                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Plan de Estudio:</label>

                                        <select name="GRUPO_ID_PLANESTUDIO" class="form-control form-control-sm"
                                            id="exampleFormControlSelect1" required>


                                            <option></option>

                                            <?php foreach ($selecplan as $item) {?> <option>
                                                <?php echo $item->	ID_PLANESTUDIO ; ?> </option>
                                            <?php
                                                        }//cierro el foreach
                                                        ?>






                                        </select>

                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Modulo:</label>
                                        <select name="ID_MODULO" class="form-control form-control-sm"
                                            id="exampleFormControlSelect1" required>

                                            <option>{{ $informacion->ID_MODULO}} </option>
                                            <?php foreach ($selecmod as $item) {?>
                                            <option>
                                                <?php echo $item->	ID_MODULO  ; ?> </option>
                                            <?php
                                                            }//cierro el foreach
                                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Ubicacion:</label>
                                        <select name="GRUPO_ID_UBICACION" class="form-control form-control-sm"
                                            id="exampleFormControlSelect1" required>

                                            <option> </option>

                                          

                                        </select>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Semestre:</label>
                                        <input type="tel" name="GRUPO_SEMESTRE"
                                            value="" pattern="[0-9]{1,11}"
                                            maxlength="11" class="form-control form-control-sm" placeholder="Semestre"
                                            required>
                                        {!! $errors->first('GRUPO_SEMESTRE','<span
                                            class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>
                                </div>
                                <div class="col-sm">

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Tipo:</label>
                                        <input type="text" name="GRUPO_TIPO" value="{{ $informacion->GRUPO_TIPO }}"
                                            pattern="[A-Za-z]{1,30}" maxlength="30" class="form-control form-control-sm"
                                            placeholder="Tipo Letras" required>
                                        {!! $errors->first('GRUPO_TIPO','<span
                                            class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>

                                </div>
                                <div class="col-sm">


                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Numero de Alumnos:</label>
                                        <input type="tel" name="GRUPO_NUM_ALUMNOS"
                                            value="{{ $informacion->GRUPO_NUM_ALUMNOS }}" pattern="[0-9]{1,11}"
                                            maxlength="11" class="form-control form-control-sm"
                                            placeholder="Numero de Alumnos" required>
                                        {!! $errors->first('GRUPO_NUM_ALUMNOS','<span
                                            class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Dia:</label>
                                        <input type="tel" name="GRUPO_DIA" pattern="[0-9]{1,11}" maxlength="11"
                                            class="form-control form-control-sm" placeholder="Dia"
                                            value="" required>
                                        {!! $errors->first('GRUPO_DIA','<span class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Docente :</label>
                                        <select name="ID_DOCENTE" class="form-control form-control-sm"
                                            id="exampleFormControlSelect1" required>

                                            <option value={{ $informacion->ID_DOCENTE}}>
                                                {{ $informacion->DOCENTE_NOMBRE }}
                                                {{ $informacion->DOCENTE_AP_PAT }} {{ $informacion->DOCENTE_AP_MAT }}
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
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">LIM:</label>
                                        <input type="tel" name="GRU_LIM" value=""
                                            pattern="[0-9]{1,4}" maxlength="4" class="form-control form-control-sm"
                                            placeholder="LIM Numeros" required>
                                        {!! $errors->first('GRU_LIM','<span class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">HLU:</label>
                                        <input type="text" name="GRU_HLU" value=""
                                            pattern="[A-Za-z]{1,5}" maxlength="5" class="form-control form-control-sm"
                                            placeholder="HLU Letras" required>
                                        {!! $errors->first('GRU_HLU','<span class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Hora de Inicio:</label>
                                        <input type="time" name="GRUPO_HORA_IN" class="form-control form-control-sm"
                                            placeholder="Inicio" value="" required>
                                        {!! $errors->first('GRUPO_HORA_IN','<span
                                            class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Hora Terminacion:</label>
                                        <input type="time" name="GRUPO_HORA_FIN" class="form-control form-control-sm"
                                            placeholder="Termino" value="">
                                        {!! $errors->first('GRUPO_HORA_FIN','<span
                                            class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Total horas:</label>
                                        <input type="tel" name="GRUPO_HORA_TOTAL"
                                            value="" pattern="[0-9]{1,11}"
                                            maxlength="11" class="form-control form-control-sm"
                                            placeholder="Total Horas" required>
                                        {!! $errors->first('GRUPO_HORA_TOTAL','<span
                                            class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>
                                </div>
                            </div>




                        </div>




                    </div>

                    <!--Columna 2
                    <div class="col-sm">
                        <div class="col-sm">


                            <div class="row">
                                <div class="col-sm">

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">ALU:</label>
                                        <input type="text" name="GRU_ALU" value=""
                                            pattern="[A-Za-z]{1,3}" maxlength="3" class="form-control form-control-sm"
                                            placeholder="ALU" required>
                                        {!! $errors->first('GRU_ALU','<span class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>
                                </div>
                                <div class="col-sm">

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">HMA:</label>
                                        <input type="text" name="GRU_HMA" value=""
                                            pattern="[A-Za-z]{1,5}" maxlength="5" class="form-control form-control-sm"
                                            placeholder="HMA" required>
                                        {!! $errors->first('GRU_HMAE','<span class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>
                                </div>
                                <div class="col-sm">

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">AMA:</label>
                                        <input type="text" name="GRU_AMA" value=""
                                            pattern="[A-Za-z]{1,3}" maxlength="3" class="form-control form-control-sm"
                                            placeholder="AMA" required>
                                        {!! $errors->first('GRU_AMA','<span class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">HMI:</label>
                                        <input type="text" name="GRU_HMI" value=""
                                            pattern="[A-Za-z]{1,5}" maxlength="5" class="form-control form-control-sm"
                                            placeholder="HMI" required>
                                        {!! $errors->first('GRU_HMI','<span class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>
                                </div>
                                <div class="col-sm">

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">AMI:</label>
                                        <input type="text" name="GRU_AMI" value=""
                                            pattern="[A-Za-z]{1,3}" maxlength="3" class="form-control form-control-sm"
                                            placeholder="AMI" required>
                                        {!! $errors->first('GRU_AMI','<span class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>
                                </div>
                                <div class="col-sm">

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">HJU:</label>
                                        <input type="text" name="GRU_HJU" value=""
                                            pattern="[A-Za-z]{1,5}" maxlength="5" class="form-control form-control-sm"
                                            placeholder="HJU" required>
                                        {!! $errors->first('GRU_HJU','<span class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">AJU:</label>
                                        <input type="text" name="GRU_AJU" value=""
                                            pattern="[A-Za-z]{1,3}" maxlength="3" class="form-control form-control-sm"
                                            placeholder="AJU" required>
                                        {!! $errors->first('GRU_AJU','<span class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>
                                </div>
                                <div class="col-sm">

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">HVI:</label>
                                        <input type="text" name="GRU_HVI" value=""
                                            pattern="[A-Za-z]{1,5}" maxlength="5" class="form-control form-control-sm"
                                            placeholder="HVI" required>
                                        {!! $errors->first('GRU_HVI','<span class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>
                                </div>
                                <div class="col-sm">

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">AVI:</label>
                                        <input type="text" name="GRU_AVI" value=""
                                            pattern="[A-Za-z]{1,3}" maxlength="3" class="form-control form-control-sm"
                                            placeholder="AVI" required>
                                        {!! $errors->first('GRU_AVI','<span class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">HSA:</label>
                                        <input type="text" name="GRU_HSA" value=""
                                            pattern="[A-Za-z]{1,3}" maxlength="3" class="form-control form-control-sm"
                                            placeholder="HSA" required>
                                        {!! $errors->first('GRU_HSA','<span class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>
                                </div>
                                <div class="col-sm">

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">ASA:</label>
                                        <input type="text" name="GRU_ASA" value=""
                                            pattern="[A-Za-z]{1,3}" maxlength="3" class="form-control form-control-sm"
                                            placeholder="ASA" required>
                                        {!! $errors->first('GRU_ASA','<span class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>
                                </div>
                                <div class="col-sm">

                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">DES:</label>
                                        <input type="text" name="GRU_DES" value=""
                                            pattern="[A-Za-z]{1,50}" maxlength="50" class="form-control form-control-sm"
                                            placeholder="DES" required>
                                        {!! $errors->first('GRU_DES','<span class="alert-danger">:message</span><br>')
                                        !!}

                                    </div>
                                </div>
                            </div>







                        </div>
                    </div>-->
                    @endforeach
                </div>

            </div>


            <div class="modal-footer">
                <a href="/grupo" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</a>
                <button type="submit" class="btn btn-success">Modificar</button>
            </div>

        </form>
    </div>
</div>






<!--FIN CUADRO Modoficar Grupoo-->

@endsection