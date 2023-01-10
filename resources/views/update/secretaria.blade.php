@extends('layout/main')


@section('contenido-main')
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


    <!--Cuadro a Salir para Modificar Secre-->


    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Modificar Secretaria</h5>

            </div>
            @foreach ($selecadmin as $informacion)
                <form action="{{ route('update.modoficar-secre', $informacion->ID_SECRETARIAL) }}" method="POST">
                    @method('PATCH')
                    @csrf

                    <div class="row>">
                        <div class="col-sm">

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">ID:</label>
                                        <input type="text" value="{{ $informacion->ID_SECRETARIAL }}" name="ID_SECRETARIAL"
                                            pattern="[A-Zz-a]{1,10}" class="form-control form-control-sm" maxlength="10"
                                            placeholder="ID" required>
                                        {!! $errors->first('ID_ADMIN', '<span class="alert-danger">:message</span><br>') !!}
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Clave:</label>
                                        <input type="text" name="ADMIN_CLAVE" value="{{ $informacion->SECRETARIA_CLAVE }}"
                                            class="form-control form-control-sm" maxlength="30" placeholder="Clave"
                                            required>
                                        {!! $errors->first('ADMIN_CLAVE', '<span class="alert-danger">:message</span><br>') !!}
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Nombre:</label>
                                        <input type="text" name="ADMIN_NOMBRE"
                                            value="{{ $informacion->SECRETARIA_NOMBRE }}"
                                            class="form-control form-control-sm" pattern="[a-zZ-A]{1,30}" maxlength="30"
                                            placeholder="Nombre" required>
                                        {!! $errors->first('ADMIN_NOMBRE', '<span class="alert-danger">:message</span><br>') !!}
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Paterno:</label>
                                        <input type="text" name="ADMIN_AP_PAT"
                                            value="{{ $informacion->SECRETARIA_AP_PAT }}"
                                            class="form-control form-control-sm" pattern="[a-zZ-A]{1,30}" maxlength="30"
                                            placeholder="Apellido Paterno" required>
                                        {!! $errors->first('ADMIN_AP_PAT', '<span class="alert-danger">:message</span><br>') !!}
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Materno:</label>
                                        <input type="text" name="ADMIN_AP_MAT"
                                            value="{{ $informacion->SECRETARIA_AP_MAT }}"
                                            class="form-control form-control-sm" pattern="[a-zZ-A]{1,30}" maxlength="30"
                                            placeholder="Apellido Materno">
                                        {!! $errors->first('ADMIN_AP_MAT', '<span class="alert-danger">:message</span><br>') !!}
                                    </div>
                                </div>
                            </div>




                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Sexo:</label>
                                        <select class="form-control  form-control-sm" name="ADMIN_SEXO"
                                            id="exampleFormControlSelect1">
                                            <opcion>{{ $informacion->SECRETARIA_SEXO }}</opcion>
                                            <option>Masculino</option>
                                            <option>Femenino</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Tipo De Sangre:</label>
                                        <select class="form-control form-control-sm" name="ADMIN_TIPO_SANGRE"
                                            id="exampleFormControlSelect1">

                                            <option>{{ $informacion->SECRETARIA_TIPO_SANGRE }}</option>
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

                                        <input class="form-control form-control-sm" name="ADMIN_FECHA_NAC" type="date"
                                            value="{{ $informacion->SECRETARIA_FECHA_NAC }}" id="example-date-input">

                                    </div>
                                </div>
                            </div>








                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Calle:</label>
                                        <input type="text" class="form-control form-control-sm" name="ADMIN_CALLE"
                                            value="{{ $informacion->SECRETARIA_CALLE }}" maxlength="30"
                                            placeholder="Calle" required>
                                        {!! $errors->first('ADMIN_CALLE', '<span class="alert-danger">:message</span><br>') !!}
                                    </div>
                                </div>

                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Colonia:</label>
                                        <input type="text" class="form-control form-control-sm" maxlength="30"
                                            name="ADMIN_COLONIA" value="{{ $informacion->SECRETARIA_COLONIA }}"
                                            placeholder="Colonia" required>
                                        {!! $errors->first('ADMIN_COLONIA', '<span class="alert-danger">:message</span><br>') !!}
                                    </div>
                                </div>

                            </div>



                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Estado:</label>
                                        <select class="form-control form-control-sm" name="ADMIN_ESTADO"
                                            id="exampleFormControlSelect1">
                                            <option>{{ $informacion->SECRETARIA_ESTADO }}</option>
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
                                            name="ADMIN_MUNICIPIO" value="{{ $informacion->SECRETARIA_MUNICIPIO }}"
                                            pattern="[a-zZ-A]{1,30}" placeholder="Municipio" required>
                                        {!! $errors->first('ADMIN_MUNICIPIO', '<span class="alert-danger">:message</span><br>') !!}
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Telefono Celular:</label>
                                            <input type="tel" class="form-control form-control-sm" pattern="[0-9]{1,30}"
                                                maxlength="30" name="ADMIN_MOVIL"
                                                value="{{ $informacion->SECRETARIA_MOVIL }}"
                                                placeholder="Telefono Celular">
                                            {!! $errors->first('ADMIN_MOVIL', '<span class="alert-danger">:message</span><br>') !!}
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Telefono Casa:</label>
                                            <input type="tel" class="form-control form-control-sm" name="ADMIN_CASA"
                                                value="{{ $informacion->SECRETARIA_CASA }}" pattern="[0-9]{1,30}"
                                                maxlength="30" placeholder="Telefono Casa">
                                            {!! $errors->first('ADMIN_CASA', '<span class="alert-danger">:message</span><br>') !!}
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Email address</label>
                                            <input maxlength="30" type="text" class="form-control" value="{{ $correo }}" id="exampleFormControlInput1"
                                                placeholder="name@example.com" disabled>
                                            {!! $errors->first('ADMIN_CORREO', '<span class="alert-danger">:message</span><br>') !!}
                                        </div>
                                    </div>
                                </div>




                            </div>


                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Clave Profesional:</label>
                                        <input type="text" class="form-control form-control-sm"
                                            name="ADMIN_CLAVE_PROFESIONAL"
                                            value="{{ $informacion->SECRETARIA_CLAVE_PROFESIONAL }}" maxlength="30"
                                            placeholder="Clave Profesional">
                                        {!! $errors->first(
    'ADMIN_CLAVE_PROFESIONAL',
    '<span
                                    class="alert-danger">:message</span><br>',
) !!}
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Especialidad:</label>
                                        <input type="text" class="form-control form-control-sm" name="ADMIN_ESPECIALIDAD"
                                            value="{{ $informacion->SECRETARIA_ESPECIALIDAD }}" pattern="[A-Za-z]{1,30}"
                                            maxlength="30" placeholder="Especialidad">
                                        {!! $errors->first(
    'ADMIN_ESPECIALIDAD',
    '<span
                                    class="alert-danger">:message</span><br>',
) !!}
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <label for="exampleFormControlInput1 ">Ingreso:</label>
                                    <input class="form-control form-control-sm" type="date" name="ADMIN_FECHA_ING"
                                        value="{{ $informacion->SECRETARIA_FECHA_ING }}" id="example-date-input">
                                </div>
                            </div>




                            <div class="row">
                                <div class="col-sm">

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Observaciones:</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="ADMIN_OBSERVACIONES" maxlength="500"
                                            rows="3">{{ $informacion->SECRETARIA_OBSERVACIONES }}</textarea>
                                    </div>
                                </div>

                            </div>

                        </div>
            @endforeach
        </div>

        <div class="modal-footer">
            <a type="button" href="{{route('secre.actualizado')}}" class="btn btn-secondary" data-dismiss="modal">Cerrar</a>
            <button type="submit" class="btn btn-success">Modificar</button>

        </div>
        </form>

    </div>
    </div>
@endsection
