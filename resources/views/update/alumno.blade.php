<title>ALUMNOS</title>
@extends('layout/main')


@section('contenido-main')
    <!-- Mensaje de alerta de id -->
    <div class="container">
        @if (Session::get('errorid'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="alert-heading">Alerta!</h4>
                <p>{{ Session::get('errorid') }}</p>


            </div>
        @endif

    </div>

    <!-- Mensaje de alerta de Email -->
    <div class="container">
        @if (Session::get('erroremail'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="alert-heading">Alerta!</h4>
                <p>{{ Session::get('erroremail') }}</p>


            </div>
        @endif

    </div>

    <!--Cuadro a Salir para agregar ALumno-->
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Modificar Alumno</h5>



            </div>

            @foreach ($selecalumno as $informacion)
                <form action="{{ route('update.modoficar-alumno', $informacion->ID_ALUMNO) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="container">

                        <div class="row">



                            <!--Columna 1-->
                            <div class="col-sm">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Matricula:</label>
                                        <input type="text" class="form-control form-control-sm" name="ID_ALUMNO"
                                            pattern="[A-Zz-a]{1,15}" maxlength="15" placeholder="Clave"
                                            value="{{ $informacion->ID_ALUMNO }}" required>
                                        {!! $errors->first('ID_ALUMNO', '<span class="alert-danger">:message</span><br>') !!}

                                    </div>

                                    <div class=" row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Nombre:</label>
                                                <input type="text" name="ALUMNO_NOMBRE" pattern="[a-zZ-A]{1,30}"
                                                    maxlength="30" class="form-control form-control-sm" placeholder="Nombre"
                                                    value="{{ $informacion->ALUMNO_NOMBRE }}" required>
                                                {!! $errors->first(
    'ALUMNO_NOMBRE',
    '<span
                                            class="alert-danger">:message</span><br>',
) !!}


                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Paterno:</label>
                                                <input type="text" name="ALUMNO_APELLIDO_PAT"
                                                    value="{{ $informacion->ALUMNO_APELLIDO_PAT }}"
                                                    pattern="[a-zZ-A]{1,30}" maxlength="30"
                                                    class="form-control form-control-sm" placeholder="Apellido Paterno"
                                                    required>
                                                {!! $errors->first(
    'ALUMNO_APELLIDO_PAT',
    '<span
                                            class="alert-danger">:message</span><br>',
) !!}

                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Materno:</label>
                                                <input type="text" value="{{ $informacion->ALUMNO_APELLIDO_MAT }}"
                                                    name="ALUMNO_APELLIDO_MAT" pattern="[a-zZ-A]{1,30}" maxlength="30"
                                                    class="form-control form-control-sm" placeholder="Apellido Materno">
                                                {!! $errors->first(
    'ALUMNO_APELLIDO_MAT',
    '<span
                                            class="alert-danger">:message</span><br>',
) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Sexo:</label>
                                                <select name="ALUMNO_SEXO" class="form-control form-control-sm"
                                                    id="exampleFormControlSelect1">
                                                    <option>{{ $informacion->ALUMNO_SEXO }} </option>
                                                    <option>Masculino</option>
                                                    <option>Femenino</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Tipo De
                                                    Sangre:</label>
                                                <select name="ALUMNO_TIPO_SANGRE" class="form-control form-control-sm"
                                                    id="exampleFormControlSelect1">

                                                    <option>{{ $informacion->ALUMNO_TIPO_SANGRE }}</option>
                                                    <option>A+</option>
                                                    <option>A-</option>
                                                    <option>B+</option>
                                                    <option>B-</option>
                                                    <option>AB+</option>
                                                    <option>AB-</option>
                                                    <option>O+</option>
                                                    <option>O-</option>
                                                    <option>No Sabe
                                                    <option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="form-group ">
                                                <label for="exampleFormControlInput1 ">Fecha de
                                                    Nacimiento:</label>

                                                <input name="ALUMNO_FECHA_NAC" class="form-control form-control-sm"
                                                    type="date" value="{{ $informacion->ALUMNO_FECHA_NAC }}"
                                                    id="example-date-input">

                                            </div>
                                        </div>


                                    </div>




                                    <div class="row">

                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Calle:</label>
                                                <input name="ALUMNO_CALLE" value="{{ $informacion->ALUMNO_CALLE }}"
                                                    type="text" maxlength="30" class="form-control form-control-sm"
                                                    placeholder="Calle" required>
                                                {!! $errors->first(
    'ALUMNO_CALLE',
    '<span
                                            class="alert-danger">:message</span><br>',
) !!}

                                            </div>
                                        </div>

                                        <div class="col-sm">

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Colonia:</label>
                                                <input name="ALUMNO_COLONIA" value="{{ $informacion->ALUMNO_COLONIA }}"
                                                    type="text" maxlength="30" class="form-control form-control-sm"
                                                    placeholder="Colonia" required>
                                                {!! $errors->first(
    'ALUMNO_COLONIA',
    '<span
                                            class="alert-danger">:message</span><br>',
) !!}
                                            </div>
                                        </div>


                                    </div>


                                    <div class="row">

                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Municipio:</label>
                                                <input name="ALUMNO_MUNICIPIO"
                                                    value="{{ $informacion->ALUMNO_MUNICIPIO }}" type="text"
                                                    pattern="[a-zZ-A]{1,30}" maxlength="30"
                                                    class="form-control form-control-sm" placeholder="Municipio" required>
                                                {!! $errors->first(
    'ALUMNO_MUNICIPIO',
    '<span
                                            class="alert-danger">:message</span><br>',
) !!}
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Estado:</label>
                                                <select name="ALUMNO_ESTADO" class="form-control form-control-sm"
                                                    id="exampleFormControlSelect1">
                                                    <option>{{ $informacion->ALUMNO_ESTADO }}</option>
                                                    <option value="Aguascalientes">Aguascalientes</option>
                                                    <option value="Baja California">Baja California</option>
                                                    <option value="Baja California Sur">Baja California Sur
                                                    </option>
                                                    <option value="Campeche">Campeche</option>
                                                    <option value="Chiapas">Chiapas</option>
                                                    <option value="Chihuahua">Chihuahua</option>
                                                    <option value="CDMX">Ciudad de México</option>
                                                    <option value="Coahuila">Coahuila</option>
                                                    <option value="Colima">Colima</option>
                                                    <option value="Durango">Durango</option>
                                                    <option value="Estado de México">Estado de México
                                                    </option>
                                                    <option value="Guanajuato">Guanajuato</option>
                                                    <option value="Guerrero">Guerrero</option>
                                                    <option value="Hidalgo">Hidalgo</option>
                                                    <option value="Jalisco">Jalisco</option>
                                                    <option value="Michoacán">Michoacán</option>
                                                    <option value="Morelos">Morelos</option>
                                                    <option value="Nayarit">Nayarit</option>
                                                    <option value="Nuevo León">Nuevo León</option>
                                                    <option value="Oaxaca">Oaxaca</option>
                                                    <option value="Puebla">Puebla</option>
                                                    <option value="Querétaro">Querétaro</option>
                                                    <option value="Quintana Roo">Quintana Roo</option>
                                                    <option value="San Luis Potosí">San Luis Potosí</option>
                                                    <option value="Sinaloa">Sinaloa</option>
                                                    <option value="Sonora">Sonora</option>
                                                    <option value="Tabasco">Tabasco</option>
                                                    <option value="Tamaulipas">Tamaulipas</option>
                                                    <option value="Tlaxcala">Tlaxcala</option>
                                                    <option value="Veracruz">Veracruz</option>
                                                    <option value="Yucatán">Yucatán</option>
                                                    <option value="Zacatecas">Zacatecas</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">

                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Telefono
                                                    Celular:</label>
                                                <input name="ALUMNO_TELEFONO_PER"
                                                    value="{{ $informacion->ALUMNO_TELEFONO_PER }}" type="tel"
                                                    maxlength="30" pattern="[0-9]{1,30}"
                                                    class="form-control form-control-sm" placeholder="Telefono Celular">
                                                {!! $errors->first(
    'ALUMNO_TELEFONO_PER',
    '<span
                                            class="alert-danger">:message</span><br>',
) !!}
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Telefono Casa:</label>
                                                <input name="ALUMNO_TELEFONO_CASA"
                                                    value="{{ $informacion->ALUMNO_TELEFONO_CASA }}" type="tel"
                                                    maxlength="30" pattern="[0-9]{1,30}"
                                                    class="form-control form-control-sm" placeholder="Telefono Casa">
                                                {!! $errors->first(
    'ALUMNO_TELEFONO_CASA',
    '<span
                                            class="alert-danger">:message</span><br>',
) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Correo electrónico</label>

                                                <input name="ALUMNO_CORREO" value="{{ $correo }}"
                                                    type="text" class="form-control" maxlength="30"
                                                    id="exampleFormControlInput1" placeholder="name@example.com" disabled>
                                                {!! $errors->first(
    'ALUMNO_CORREO',
    '<span
                                            class="alert-danger">:message</span><br>',
) !!}
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Estatus:</label>
                                                <select name="ALUMNO_STATUS" class="form-control form-control-sm">
                                                    <option>{{ $informacion->ALUMNO_STATUS }}</option>
                                                    <option>Vigente</option>
                                                    <option>Baja Temporal</option>
                                                    <option>Baja Definitiva</option>
                                                    <option>Egreso</option>



                                                </select>
                                                {!! $errors->first(
    'ALUMNO_STATUS',
    '<span
                                            class="alert-danger">:message</span><br>',
) !!}
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Nombre Tutor:</label>
                                                <input name="ALUMNO_TUTOR_NOMBRE"
                                                    value="{{ $informacion->ALUMNO_TUTOR_NOMBRE }}" type="text"
                                                    pattern="[a-zZ-A]{1,30}" class="form-control form-control-sm"
                                                    placeholder="Nombre Tutor" maxlength="30">
                                                {!! $errors->first(
    'ALUMNO_TUTOR_NOMBRE',
    '<span
                                            class="alert-danger">:message</span><br>',
) !!}
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Paterno:</label>
                                                <input name="ALUMNO_TUTOR_AR_PAT"
                                                    value="{{ $informacion->ALUMNO_TUTOR_AR_PAT }}" type="text"
                                                    pattern="[a-zZ-A]{1,30}" class="form-control form-control-sm"
                                                    placeholder="Apellido Paterno Tutor" maxlength="30">
                                                {!! $errors->first(
    'ALUMNO_TUTOR_AR_PAT',
    '<span
                                            class="alert-danger">:message</span><br>',
) !!}
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Materno:</label>
                                                <input name="ALUMNO_TUTOR_AR_MAT"
                                                    value="{{ $informacion->ALUMNO_TUTOR_AR_MAT }}" type="text"
                                                    pattern="[a-zZ-A]{1,30}" class="form-control form-control-sm"
                                                    placeholder="Apellido Materno Tutor" maxlength="30">
                                                {!! $errors->first(
    'ALUMNO_TUTOR_AR_MAT',
    '<span
                                            class="alert-danger">:message</span><br>',
) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Carrera:</label>
                                                <select name="ALUMNO_CARRERA" class="form-control form-control-sm">
                                                    <option>{{ $informacion->ALUMNO_CARRERA }}
                                                    </option>
                                                    <option>Sistemas Computacionales</option>
                                                    <option>Tecnologias de la Informacion</option>
                                                    <option>Industrial</option>
                                                    <option>Mecatronica </option>
                                                    <option>Gestion Empresarial </option>
                                                    <option>Bioquimica </option>
                                                    <option>Nanotecnologia </option>
                                                    <option>Secundaria </option>
                                                    <option>Preparatoria </option>



                                                </select>
                                                {!! $errors->first(
    'ALUMNO_CARRERA',
    '<span
                                            class="alert-danger">:message</span><br>',
) !!}
                                            </div>
                                        </div>

                                        <div class="col-sm">
                                            <div class="form-group ">
                                                <label for="exampleFormControlInput1 ">Ano de Ingreso:</label>


                                                <?php
                                                $cont = date('Y');
                                                ?>
                                                <select name="ALUMNO_ING_ANIO" class="form-control form-control-sm">

                                                    <?php while ($cont >= 1999) { ?>
                                                    <option>{{ $informacion->ALUMNO_ING_ANIO }}</option>
                                                    <option value="<?php echo $cont; ?>">
                                                        <?php echo $cont; ?>
                                                    </option>
                                                    <?php $cont = ($cont-1); } ?>
                                                </select>
                                                {!! $errors->first(
    'ALUMNO_ING_ANIO',
    '<span
                                            class="alert-danger">:message</span><br>',
) !!}
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-sm">

                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Observaciones:</label>
                                                <textarea name="ALUMNO_OBSERVACIONES" class="form-control" maxlength="500" id="exampleFormControlTextarea1"
                                                    rows="3">{{ $informacion->ALUMNO_OBSERVACIONES }} </textarea>
                                            </div>
                                        </div>

                                    </div>

                                </div>




                            </div>



                        </div>
            @endforeach
        </div>


        <div class="modal-footer">
            <a type="button" href="{{route('alumno.actualizado')}}" class="btn btn-secondary" data-dismiss="modal">Cerrar</a>
            <button type="submit" class="btn btn-success">Modificar</button>
        </div>

        </form>
    </div>
    </div>


    <!--Final Cuadro a Salir para Modificar Alumno-->
@endsection
