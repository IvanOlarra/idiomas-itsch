@extends('layout/main')


@section('contenido-main')



<!--PARA QUE SALGA-->
<div class="container">
    <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">

            <h5>Coonsulta de Adeudo
            </h5>
        </li>


    </ul>
    <div align="right">
        <input class=" me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </div>


</div>

<!--PARA QUE SALGA-->





<!--Table-->
<div class="container">

    <table class="table table-hover table-bordered ">
        <thead class="thead-dark">
            <tr>
                <th>Alumno</th>
                <th>Monto restante</th>
                <th>Opciones</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($selecadeudo as $item)


            <tr>
                <td>
                    {{ $item->ALUMNO_NOMBRE }} {{ $item->ALUMNO_APELLIDO_PAT }} {{ $item->ALUMNO_APELLIDO_MAT }}
                </td>
                <td>${{ $item->ADEUDO_MONTO }}</td>


                <td>
                    <center>
                        <a type="button" class="btn btn-primary "
                            href="{{ route('update.mostadeudo_modificar',$item->ID_ADEUDO) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                            Ver/Editar</a>

                        <a type="button" class="btn btn-danger"
                            href="{{ route('delete.adeudo_eliminar',$item->ID_ADEUDO) }}">
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
<!--FIN TABLE-->




<!--INICIO CUADRO SALIR ADEUDO-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Agregar Adeudo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('insert.agregar-adeudo') }}" method="POST">
                @csrf

                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">ID:</label>
                                <input type="text" name="ID_ADEUDO" class="form-control form-control-sm" maxlength="30"
                                    placeholder="Adeudo" value="{{ old('ID_ADEUDO') }}" required>
                                {!! $errors->first('ID_ADEUDO','<span class="alert-danger">:message</span><br>')
                                !!}

                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Alumno:</label>
                                <select name="ID_ALUMNO" class="form-control form-control-sm"
                                    id="exampleFormControlSelect1">

                                    <option> Opciones </option>
                                    <?php foreach ($selecalum as $item)  {?>

                                    <option value={{ $item->ID_ALUMNO }}>

                                        <?php  echo $item->	ALUMNO_NOMBRE," ", $item->	ALUMNO_APELLIDO_MAT," ", $item->ALUMNO_APELLIDO_PAT ; 
                                        
                                            
                                        ?>
                                        </>

                                        <?php
                                   
                          
                                            }//cierro el foreach
                                            ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nombre Adeudor:</label>
                                <input type="text" name="DEU_NOM" pattern="[a-zZ-A]{1,40}" maxlength="40"
                                    class="form-control form-control-sm" placeholder="Nombre"
                                    value="{{ old('	DEU_NOM') }}" required>
                                {!! $errors->first('DEU_NOM','<span class="alert-danger">:message</span><br>')
                                !!}


                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Inscripcion:</label>
                                <select name="ADEUDO_ID_INSCRIPCION" class="form-control form-control-sm"
                                    id="exampleFormControlSelect1">
                                    <option> Opciones </option>
                                    <?php foreach ($selecinscripcion as $item)  {?>

                                    <option>

                                        <?php  echo $item->	ID_INSCRIPCION ; 
                                        
                                            
                                        ?>
                                        </>

                                        <?php
                                   
                          
                                            }//cierro el foreach
                                            ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Monto:</label>
                                <input name="ADEUDO_MONTO" value="{{ old('ADEUDO_MONTO') }}" type="tel" maxlength="11"
                                    pattern="[0-9]{1,11}" class="form-control form-control-sm" placeholder="$" required>
                                {!! $errors->first('ADEUDO_MONTO','<span class="alert-danger">:message</span><br>')
                                !!}
                            </div>
                            <div class="form-group ">
                                <label for="exampleFormControlInput1 ">Fecha de
                                    Adeudo:</label>

                                <input name="ADEUDO_FECHA" class="form-control form-control-sm" type="date"
                                    value="2011-08-19" id="example-date-input">

                            </div>



                            <div class="form-group">
                                <label for="exampleFormControlInput1">Monto Restante:</label>
                                <input name="ADEUDO_MONTO_RES" value="{{ old('ADEUDO_MONTO_RES') }}" type="tel"
                                    maxlength="11" pattern="[0-9]{1,11}" class="form-control form-control-sm"
                                    placeholder="Monto Restante" required>
                                {!! $errors->first('ADEUDO_MONTO_RES','<span class="alert-danger">:message</span><br>')
                                !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Monto Actual:</label>
                                <input name="ADEUDO_MONTO_ACTUAL" value="{{ old('ADEUDO_MONTO_ACTUAL') }}" type="tel"
                                    maxlength="11" pattern="[0-9]{1,11}" class="form-control form-control-sm"
                                    placeholder="Monto Actual" required>
                                {!! $errors->first('ADEUDO_MONTO_ACTUAL','<span
                                    class="alert-danger">:message</span><br>') !!}
                            </div>
                        </div>
                        <div class="col">

                            <div class="form-group ">
                                <label for="exampleFormControlInput1 ">Fecha Nueva:</label>

                                <input name="ADEUDO_FECHA_NUE" class="form-control form-control-sm" type="date"
                                    value="2011-08-19" id="example-date-input">

                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Montor Restante:</label>
                                <input name="ADEUDO_MONTO_RESTANTE" value="{{ old('ADEUDO_MONTO_RESTANTE') }}"
                                    type="tel" maxlength="11" pattern="[0-9]{1,11}" class="form-control form-control-sm"
                                    placeholder="$" required>
                                {!! $errors->first('ADEUDO_MONTO_RESTANTE','<span
                                    class="alert-danger">:message</span><br>')
                                !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">DEU_CON:</label>
                                <input type="text" name="DEU_CON" pattern="[a-zZ-A]{1,80}" maxlength="80"
                                    class="form-control form-control-sm" placeholder="DEU_CON"
                                    value="{{ old('DEU_CON') }}" required>
                                {!! $errors->first('DEU_CON','<span class="alert-danger">:message</span><br>')
                                !!}


                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">DEU_PER:</label>
                                <input type="text" name="DEU_PER" pattern="[a-zZ-A]{1,30}" maxlength="8"
                                    class="form-control form-control-sm" placeholder="DEU_PER"
                                    value="{{ old('DEU_PER') }}" required>
                                {!! $errors->first('DEU_PER','<span class="alert-danger">:message</span><br>')
                                !!}


                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">DEU_AN:</label>
                                <input type="text" name="DEU_AN" pattern="[a-zZ-A]{1,50}" maxlength="50"
                                    class="form-control form-control-sm" placeholder="DEU_AN"
                                    value="{{ old('DEU_AN') }}" required>
                                {!! $errors->first('DEU_AN','<span class="alert-danger">:message</span><br>')
                                !!}


                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Observaciones:</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                    name="ADEUDO_OBSERVACIONES" maxlength="500" rows="3"
                                    required> Observaciones: </textarea>
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






<!--FINAL  CUADRO SALIDA AGREGAR ADEUDO->


@endsection