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

    <!--Cuadro a Salir para Modificar Docente-->


    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Modificar Docente</h5>

            </div>
            @foreach ($selecdocente as $informacion)
                <form action="{{ route('update.modoficar-docente', $informacion->ID_DOCENTE) }}" method="POST">
                    @method('PATCH')
                    @csrf

                    <div class="row>">
                        <div class="col-sm">

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">ID:</label>
                                        <input type="text" name="ID_DOCENTE" value="{{ $informacion->ID_DOCENTE }}" name="ID_DOCENTE"
                                            pattern="[A-Zz-a]{1,6}" class="form-control form-control-sm" maxlength="6"
                                            placeholder="ID" required>
                                        {!! $errors->first('ID_DOCENTE', '<span class="alert-danger">:message</span><br>') !!}
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Clave:</label>
                                        <input type="text" name="DOCENTE_CLAVE" value="{{ $informacion->DOCENTE_CLAVE }}"
                                            class="form-control form-control-sm" maxlength="30" placeholder="Clave"
                                            required>
                                        {!! $errors->first('DOCENTE_CLAVE', '<span class="alert-danger">:message</span><br>') !!}
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Nombre:</label>
                                        <input type="text" name="DOCENTE_NOMBRE"
                                            value="{{ $informacion->DOCENTE_NOMBRE }}"
                                            class="form-control form-control-sm" pattern="[a-zZ-A]{1,30}" maxlength="30"
                                            placeholder="Nombre" required>
                                        {!! $errors->first('DOCENTE_NOMBRE', '<span class="alert-danger">:message</span><br>') !!}
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Paterno:</label>
                                        <input type="text" name="DOCENTE_AP_PAT"
                                            value="{{ $informacion->DOCENTE_AP_PAT }}"
                                            class="form-control form-control-sm" pattern="[a-zZ-A]{1,30}" maxlength="30"
                                            placeholder="Apellido Paterno" required>
                                        {!! $errors->first('DOCENTE_AP_PAT', '<span class="alert-danger">:message</span><br>') !!}
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Materno:</label>
                                        <input type="text" name="DOCENTE_AP_MAT"
                                            value="{{ $informacion->DOCENTE_AP_MAT }}"
                                            class="form-control form-control-sm" pattern="[a-zZ-A]{1,30}" maxlength="30"
                                            placeholder="Apellido Materno">
                                        {!! $errors->first('DOCENTE_AP_MAT', '<span class="alert-danger">:message</span><br>') !!}
                                    </div>
                                </div>
                            </div>




                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Sexo:</label>
                                        <select class="form-control  form-control-sm" name="DOCENTE_SEXO"
                                            id="exampleFormControlSelect1">
                                            <option>{{ $informacion->DOCENTE_SEXO }}</option>
                                            <option>Masculino</option>
                                            <option>Femenino</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Tipo De Sangre:</label>
                                        <select class="form-control form-control-sm" name="DOCENTE_TIPO_SANGRE"
                                            id="exampleFormControlSelect1">

                                            <option>{{ $informacion->DOCENTE_TIPO_SANGRE }}</option>
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
                                        <label for="exampleFormControlInput1 ">Fecha de Nacimiento:</label>

                                        <input class="form-control form-control-sm" name="DOCENTE_FECHA_NAC" type="date"
                                            value="{{ $informacion->DOCENTE_FECHA_NAC }}" id="example-date-input">

                                    </div>
                                </div>
                            </div>








                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Calle:</label>
                                        <input type="text" class="form-control form-control-sm" name="DOCENTE_CALLE"
                                            value="{{ $informacion->DOCENTE_CALLE }}" maxlength="30" placeholder="Calle"
                                            required>
                                        {!! $errors->first('DOCENTE_CALLE', '<span class="alert-danger">:message</span><br>') !!}

                                    </div>
                                </div>

                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Colonia:</label>
                                        <input type="text" class="form-control form-control-sm" maxlength="30"
                                            name="DOCENTE_COLONIA" value="{{ $informacion->DOCENTE_COLONIA }}"
                                            placeholder="Colonia" required>
                                        {!! $errors->first('DOCENTE_COLONIA', '<span class="alert-danger">:message</span><br>') !!}
                                    </div>
                                </div>

                            </div>



                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Estado:</label>
                                        <select class="form-control form-control-sm" name="DOCENTE_ESTADO"
                                            id="exampleFormControlSelect1">
                                            <option>{{ $informacion->DOCENTE_ESTADO }}</option>
                                            <option value="Aguascalientes">Aguascalientes</option>
                                            <option value="Baja California">Baja California</option>
                                            <option value="Baja California Sur">Baja California Sur</option>
                                            <option value="Campeche">Campeche</option>
                                            <option value="Chiapas">Chiapas</option>
                                            <option value="Chihuahua">Chihuahua</option>
                                            <option value="CDMX">Ciudad de México</option>
                                            <option value="Coahuila">Coahuila</option>
                                            <option value="Colima">Colima</option>
                                            <option value="Durango">Durango</option>
                                            <option value="Estado de México">Estado de México</option>
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
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Municipio:</label>
                                        <input type="text" class="form-control form-control-sm" maxlength="30"
                                            name="DOCENTE_MUNICIPIO" value="{{ $informacion->DOCENTE_MUNICIPIO }}"
                                            pattern="[a-zZ-A]{1,30}" placeholder="Municipio" required>
                                        {!! $errors->first('DOCENTE_MUNICIPIO', '<span class="alert-danger">:message</span><br>') !!}
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Telefono Celular:</label>
                                            <input type="tel" class="form-control form-control-sm" pattern="[0-9]{1,30}"
                                                maxlength="30" name="DOCENTE_MOVIL"
                                                value="{{ $informacion->DOCENTE_MOVIL }}" placeholder="Telefono Celular">
                                            {!! $errors->first('DOCENTE_MOVIL', '<span class="alert-danger">:message</span><br>') !!}
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Telefono Casa:</label>
                                            <input type="tel" class="form-control form-control-sm" name="DOCENTE_CASA"
                                                value="{{ $informacion->DOCENTE_CASA }}" pattern="[0-9]{1,30}"
                                                maxlength="30" placeholder="Telefono Casa">
                                            {!! $errors->first('DOCENTE_CASA', '<span class="alert-danger">:message</span><br>') !!}
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Email address</label>

                                            <input maxlength="30" type="text" class="form-control"
                                                value="{{ $correo }}" id="exampleFormControlInput1"
                                                placeholder="name@example.com" disabled>

                                            {!! $errors->first(
    'DOCENTE_CORREO',
    '<span
                                        class="alert-danger">:message</span><br>',
) !!}
                                        </div>
                                    </div>
                                </div>


                            </div>


                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Clave Profesional:</label>
                                        <select class="form-control  form-control-sm" name="DOCENTE_GRADO_ESCOLAR"
                                            id="exampleFormControlSelect1">


                                            <option>{{ $informacion->DOCENTE_GRADO_ESCOLAR }}</option>
                                            <option>Primaria</option>
                                            <option>Secundaria</option>
                                            <option>Media Superior</option>
                                            <option>Superior</option>
                                            <option>Maestria</option>
                                            <option>Doctorado</option>

                                        </select>
                                        {!! $errors->first(
    'DOCENTE_GRADO_ESCOLAR',
    '<span
                                    class="alert-danger">:message</span><br>',
) !!}
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Especialidad:</label>
                                        <input type="text" class="form-control form-control-sm" name="DOCENTE_ESPECIALIDAD"
                                            value="{{ $informacion->DOCENTE_ESPECIALIDAD }}" pattern="[a-zZ-A]{1,30}"
                                            maxlength="30" placeholder="Especialidad">
                                        {!! $errors->first(
    'DOCENTE_ESPECIALIDAD',
    '<span
                                    class="alert-danger">:message</span><br>',
) !!}
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <label for="exampleFormControlInput1 ">Ingreso:</label>
                                    <input class="form-control form-control-sm" type="date" name="DOCENTE_FECHA_ING"
                                        value="{{ $informacion->DOCENTE_FECHA_ING }}" id="example-date-input">

                                </div>



                            </div>




                            <div class="row">
                                <div class="col-sm">

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Observaciones:</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="DOCENTE_OBSERVACIONES" maxlength="500"
                                            rows="3">{{ $informacion->DOCENTE_OBSERVACIONES }}</textarea>
                                    </div>
                                </div>

                            </div>

                        </div>
            @endforeach
        </div>

        <div class="modal-footer">
            <a type="button" href="{{ route('docente.actualizado') }}" class="btn btn-secondary"
                data-dismiss="modal">Cerrar</a>
            <button type="submit" class="btn btn-success">Modificar</button>

        </div>
        </form>

    </div>
    </div>


    <!--FIN  CUADRO SALIDA AGREGAR DOCENTE-->
@endsection
