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
    <!--BOTON-->

    <!-- Large modal -->
    <div class="container">
        <h5>Lista de Secretariado
            <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg">

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus"
                    viewBox="0 0 16 16">
                    <path
                        d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                    <path fill-rule="evenodd"
                        d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                </svg>
                Agregar
            </button>
        </h5>

    </div>

    <!--BOTON-->


    <!--Table-->
    <div class="table-responsive-xl container">

        <table id="example" class="table table-hover table-bordered ">
            <thead class="thead-dark">
                <tr>

                    <th>Email</th>
                    <th>Nombre</th>
                    <th>Sexo</th>
                    <th>Fecha De Nacimiento</th>
                    <th>Opciones</th>




                </tr>
            </thead>

            <tbody>
                @foreach ($selecadmin as $item)
                    <tr>
                        <td>{{ $item->email }} </td>
                        <td>
                            {{ $item->SECRETARIA_NOMBRE }} {{ $item->SECRETARIA_AP_PAT }} {{ $item->SECRETARIA_AP_MAT }}
                        </td>
                        <td>{{ $item->SECRETARIA_SEXO }} </td>
                        <td>{{ $item->SECRETARIA_FECHA_NAC }}</td>



                        <td>
                            <center>
                                <a type="button" class="btn btn-primary "
                                    href="{{ route('update.mostsecre_modificar', $item->ID_SECRETARIAL) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                    Ver/Editar</a>

                                <a type="button" class="btn btn-danger"
                                    href="{{ route('delete.secre_eliminar', $item->ID_SECRETARIAL) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd"
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                    Eliminar</a>
                               
                            </center>

                        </td>


                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>


    <!--FiN Table-->



    <!--Cuadro a Salir para Agregar-->

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Agregar Secretaria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('insert.agregar-secre') }}" method="POST">
                    @csrf

                    <div class="row>">
                        <div class="col-sm">

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">ID:</label>
                                        <input type="text" name="ID_ADMIN" value="{{ old('ID_ADMIN') }}"
                                            pattern="[A-Zz-a]{1,10}" class="form-control form-control-sm" maxlength="10"
                                            placeholder="ID" required>
                                        {!! $errors->first('ID_ADMIN', '<span class="alert-danger">:message</span><br>') !!}
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Clave:</label>
                                        <input type="text" name="ADMIN_CLAVE" value="{{ old('ADMIN_CLAVE') }}"
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
                                        <input type="text" name="ADMIN_NOMBRE" value="{{ old('ADMIN_NOMBRE') }}"
                                            class="form-control form-control-sm" pattern="[A-Za-z]{1,30}" maxlength="30"
                                            placeholder="Nombre" required>
                                        {!! $errors->first('ADMIN_NOMBRE', '<span class="alert-danger">:message</span><br>') !!}
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Paterno:</label>
                                        <input type="text" name="ADMIN_AP_PAT" value="{{ old('ADMIN_AP_PAT') }}"
                                            class="form-control form-control-sm" pattern="[A-Za-z]{1,30}" maxlength="30"
                                            placeholder="Apellido Paterno" required>
                                        {!! $errors->first('ADMIN_AP_PAT', '<span class="alert-danger">:message</span><br>') !!}
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Materno:</label>
                                        <input type="text" name="ADMIN_AP_MAT" value="{{ old('ADMIN_AP_MAT') }}"
                                            class="form-control form-control-sm" pattern="[A-Za-z]{1,30}" maxlength="30"
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
                                            value="2011-08-19" id="example-date-input">

                                    </div>
                                </div>
                            </div>








                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Calle:</label>
                                        <input type="text" class="form-control form-control-sm" name="ADMIN_CALLE"
                                            value="{{ old('ADMIN_CALLE') }}" maxlength="30" placeholder="Calle" required>
                                        {!! $errors->first('ADMIN_CALLE', '<span class="alert-danger">:message</span><br>') !!}
                                    </div>
                                </div>

                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Colonia:</label>
                                        <input type="text" class="form-control form-control-sm" maxlength="30"
                                            name="ADMIN_COLONIA" value="{{ old('ADMIN_COLONIA') }}" placeholder="Colonia"
                                            required>
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
                                            name="ADMIN_MUNICIPIO" value="{{ old('ADMIN_MUNICIPIO') }}"
                                            pattern="[A-Za-z]{1,30}" placeholder="Municipio" required>
                                        {!! $errors->first(
    'ADMIN_MUNICIPIO',
    '<span
                                        class="alert-danger">:message</span><br>',
) !!}
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Telefono Celular:</label>
                                            <input type="tel" class="form-control form-control-sm" pattern="[0-9]{1,30}"
                                                maxlength="30" name="ADMIN_MOVIL" value="{{ old('ADMIN_MOVIL') }}"
                                                placeholder="Telefono Celular">
                                            {!! $errors->first(
    'ADMIN_MOVIL',
    '<span
                                            class="alert-danger">:message</span><br>',
) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Telefono Casa:</label>
                                            <input type="tel" class="form-control form-control-sm" name="ADMIN_CASA"
                                                value="{{ old('ADMIN_CASA') }}" pattern="[0-9]{1,30}" maxlength="30"
                                                placeholder="Telefono Casa">
                                            {!! $errors->first(
    'ADMIN_CASA',
    '<span
                                            class="alert-danger">:message</span><br>',
) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Correo electrónico:</label>
                                            @livewire('busqueda-correo', ['nombre' => 'ADMIN_CORREO'])
                                        </div>
                                    </div>
                                </div>



                            </div>



                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Clave Profesional:</label>
                                        <input type="text" class="form-control form-control-sm"
                                            name="ADMIN_CLAVE_PROFESIONAL" value="{{ old('ADMIN_CLAVE_PROFESIONAL') }}"
                                            maxlength="30" placeholder="Clave Profesional">
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
                                            value="{{ old('ADMIN_ESPECIALIDAD') }}" pattern="[A-Za-z]{1,30}"
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
                                        value="2011-08-19" id="example-date-input">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Observaciones:</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="ADMIN_OBSERVACIONES" maxlength="500" rows="3"
                                            placeholder="Observaciones"></textarea>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Agregar</button>

                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
