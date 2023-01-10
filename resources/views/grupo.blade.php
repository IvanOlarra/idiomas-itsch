<!DOCTYPE html>



@extends('layout/main')


@section('contenido-main')
    <div class="container">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">

                <h5>Consulta de Grupo


                    <!-- Large modal Boton Agregar Grupo -->

                    <button onclick="" type="button" class="btn btn-success" data-toggle="modal"
                        data-target=".bd-example-modal-lg">

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-person-plus" viewBox="0 0 16 16">
                            <path
                                d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                            <path fill-rule="evenodd"
                                d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                        </svg>
                        Agregar Grupo

                    </button>

                </h5>
            </li>


        </ul>



    </div>



    <!---->


    <!--Table-->
    <div class="table-responsive-xl container">

        <table id="example" class="table table-hover table-bordered ">
            <thead class="thead-dark">
                <tr>

                    <th>ID Grupo</th>
                    <th>Docente</th>
                    <th>Plan de Estudio</th>
                    <th>Ubicacion</th>
                    <th>Opciones</th>




                </tr>
            </thead>

            <tbody>




                @foreach ($selecgrup as $item)
                    <tr>
                        <td>{{ $item->ID_GRUPO }} </td>
                        <td>
                            {{ $item->DOCENTE_NOMBRE }} {{ $item->DOCENTE_AP_PAT }} {{ $item->DOCENTE_AP_MAT }}
                        </td>
                        <td>{{$item->PLAN_NOMBRE_IDIOMA}}</td>
                        <td>{{$item->GRUPO_UBICACION}}</td>



                        <td>
                            <center>
                                <a type="button" class="btn btn-primary "
                                    href="{{ route('update.mostgrupo_modificar', $item->ID_GRUPO) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                    Ver/Editar</a>

                                <a type="button" class="btn btn-danger"
                                    href="{{ route('delete.grupo_eliminar', $item->ID_GRUPO) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd"
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                    Eliminar</a>
                                    <a type="button" class="btn btn-primary"
                                    data-toggle="modal"
                                    data-target="#cierreGrupo"
                                    data-id="{{$item->ID_GRUPO}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                        <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                                    </svg>
                                    Cierre</a>
                            </center>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <!--FIN TABLE-->

    <!--Cuadro a Salir para AgregarGrupo-->


    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Agregar Grupo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <form action="{{ route('insert.agregar-grupo') }}" method="POST">
                    @csrf
                    <div class="container">

                        <div class="row">
                            <!--Columna 1-->
                            <div class="col-sm">
                                <div class="col-sm">
                                    <div class="row">

                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Modulo:</label>
                                                <select name="ID_MODULO" class="form-control form-control-sm"
                                                    id="exampleFormControlSelect1" required>
                                                    <?php foreach ($selecmod as $item) {?>
                                                    <option><?php echo $item->ID_MODULO; ?> </option>
                                                    <?php
                                                            }//cierro el foreach
                                                            ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Tipo:</label>
                                                <select name="GRUPO_TIPO" class="form-control form-control-sm"
                                                    id="exampleFormControlSelect1" required>

                                                    <option value="SEMANA">Semanal</option>
                                                    <option value="SABATI">Sabatino</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Clasificación:</label>
                                                <select name="GRUPO_CLA" class="form-control form-control-sm"
                                                    id="exampleFormControlSelect1" required>

                                                    <option value="INTERN">Internos</option>
                                                    <option value="EXTERN">Externos</option>
                                                    <option value="PROFES">Profesores</option>
                                                    <option value="MIXTO">Mixto</option>

                                                </select>
                                            </div>
                                        </div>

                                    </div>



                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Semestre:</label>
                                                <input type="tel" name="GRUPO_SEMESTRE"
                                                    value="{{ old('GRUPO_SEMESTRE') }}" pattern="[0-9]{1,11}"
                                                    maxlength="11" class="form-control form-control-sm"
                                                    placeholder="Semestre" required>
                                                {!! $errors->first('GRUPO_SEMESTRE', '<span class="alert-danger">:message</span><br>') !!}

                                            </div>
                                        </div>
                                        <div class="col-sm">

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Tipo:</label>
                                                <input type="text" name="GRUPO_TIPO" value="{{ old('GRUPO_TIPO') }}"
                                                    pattern="[A-Za-z]{1,30}" maxlength="30"
                                                    class="form-control form-control-sm" placeholder="Tipo Letras" required>
                                                {!! $errors->first('GRUPO_TIPO', '<span class="alert-danger">:message</span><br>') !!}

                                            </div>

                                        </div>
                                        <div class="col-sm">


                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Numero de Alumnos:</label>
                                                <input type="tel" name="GRUPO_NUM_ALUMNOS"
                                                    value="{{ old('GRUPO_NUM_ALUMNOS') }}" pattern="[0-9]{1,11}"
                                                    maxlength="11" class="form-control form-control-sm"
                                                    placeholder="Numero de Alumnos" required>
                                                {!! $errors->first('GRUPO_NUM_ALUMNOS', '<span class="alert-danger">:message</span><br>') !!}

                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Dia:</label>
                                                <input type="date" name="GRUPO_DIA" class="form-control form-control-sm"
                                                    placeholder="Dia" required>
                                                {!! $errors->first('GRUPO_DIA', '<span class="alert-danger">:message</span><br>') !!}

                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Docente :</label>
                                                <select name="ID_DOCENTE" class="form-control form-control-sm"
                                                    id="exampleFormControlSelect1" required>

                                                    <?php foreach ($selecdocente as $item)  {?>

                                                    <option value={{ $item->ID_DOCENTE }}>

                                                        <?php echo $item->DOCENTE_NOMBRE, ' ', $item->DOCENTE_AP_PAT, ' ', $item->DOCENTE_AP_MAT;
                                                        
                                                        ?>

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
                                                <input type="tel" name="GRU_LIM" value="{{ old('GRU_LIM') }}"
                                                    pattern="[0-9]{1,4}" maxlength="4" class="form-control form-control-sm"
                                                    placeholder="LIM Numeros" required>
                                                {!! $errors->first('GRU_LIM', '<span class="alert-danger">:message</span><br>') !!}

                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">HLU:</label>
                                                <input type="text" name="GRU_HLU" value="{{ old('GRU_HLU') }}"
                                                    pattern="[A-Za-z]{1,5}" maxlength="5"
                                                    class="form-control form-control-sm" placeholder="HLU Letras" required>
                                                {!! $errors->first('GRU_HLU', '<span class="alert-danger">:message</span><br>') !!}

                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Hora de Inicio:</label>
                                                <input type="time" name="GRUPO_HORA_IN" class="form-control form-control-sm"
                                                    placeholder="Inicio" required>
                                                {!! $errors->first('GRUPO_HORA_IN', '<span class="alert-danger">:message</span><br>') !!}

                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Hora Terminacion:</label>
                                                <input type="time" name="GRUPO_HORA_FIN"
                                                    class="form-control form-control-sm" placeholder="Termino">
                                                {!! $errors->first('GRUPO_HORA_FIN', '<span class="alert-danger">:message</span><br>') !!}

                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Total horas:</label>
                                                <input type="tel" name="GRUPO_HORA_TOTAL"
                                                    value="{{ old('GRUPO_HORA_TOTAL') }}" pattern="[0-9]{1,11}"
                                                    maxlength="11" class="form-control form-control-sm"
                                                    placeholder="Total Horas" required>
                                                {!! $errors->first('GRUPO_HORA_TOTAL', '<span class="alert-danger">:message</span><br>') !!}

                                            </div>
                                        </div>
                                    </div>




                                </div>




                            </div>

                            <!--Columna 2-->
                            <div class="col-sm">
                                <div class="col-sm">


                                    <div class="row">
                                        <div class="col-sm">

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">ALU:</label>
                                                <input type="text" name="GRU_ALU" value="{{ old('GRU_ALU') }}"
                                                    pattern="[A-Za-z]{1,3}" maxlength="3"
                                                    class="form-control form-control-sm" placeholder="ALU" required>
                                                {!! $errors->first('GRU_ALU', '<span class="alert-danger">:message</span><br>') !!}

                                            </div>
                                        </div>
                                        <div class="col-sm">

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">HMA:</label>
                                                <input type="text" name="GRU_HMA" value="{{ old('GRU_HMA') }}"
                                                    pattern="[A-Za-z]{1,5}" maxlength="5"
                                                    class="form-control form-control-sm" placeholder="HMA" required>
                                                {!! $errors->first('GRU_HMAE', '<span class="alert-danger">:message</span><br>') !!}

                                            </div>
                                        </div>
                                        <div class="col-sm">

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">AMA:</label>
                                                <input type="text" name="GRU_AMA" value="{{ old('GRU_AMA') }}"
                                                    pattern="[A-Za-z]{1,3}" maxlength="3"
                                                    class="form-control form-control-sm" placeholder="AMA" required>
                                                {!! $errors->first('GRU_AMA', '<span class="alert-danger">:message</span><br>') !!}

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm">

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">HMI:</label>
                                                <input type="text" name="GRU_HMI" value="{{ old('GRU_HMI') }}"
                                                    pattern="[A-Za-z]{1,5}" maxlength="5"
                                                    class="form-control form-control-sm" placeholder="HMI" required>
                                                {!! $errors->first('GRU_HMI', '<span class="alert-danger">:message</span><br>') !!}

                                            </div>
                                        </div>
                                        <div class="col-sm">

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">AMI:</label>
                                                <input type="text" name="GRU_AMI" value="{{ old('GRU_AMI') }}"
                                                    pattern="[A-Za-z]{1,3}" maxlength="3"
                                                    class="form-control form-control-sm" placeholder="AMI" required>
                                                {!! $errors->first('GRU_AMI', '<span class="alert-danger">:message</span><br>') !!}

                                            </div>
                                        </div>
                                        <div class="col-sm">

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">HJU:</label>
                                                <input type="text" name="GRU_HJU" value="{{ old('GRU_HJU') }}"
                                                    pattern="[A-Za-z]{1,5}" maxlength="5"
                                                    class="form-control form-control-sm" placeholder="HJU" required>
                                                {!! $errors->first('GRU_HJU', '<span class="alert-danger">:message</span><br>') !!}

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm">

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">AJU:</label>
                                                <input type="text" name="GRU_AJU" value="{{ old('GRU_AJU') }}"
                                                    pattern="[A-Za-z]{1,3}" maxlength="3"
                                                    class="form-control form-control-sm" placeholder="AJU" required>
                                                {!! $errors->first('GRU_AJU', '<span class="alert-danger">:message</span><br>') !!}

                                            </div>
                                        </div>
                                        <div class="col-sm">

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">HVI:</label>
                                                <input type="text" name="GRU_HVI" value="{{ old('GRU_HVI') }}"
                                                    pattern="[A-Za-z]{1,5}" maxlength="5"
                                                    class="form-control form-control-sm" placeholder="HVI" required>
                                                {!! $errors->first('GRU_HVI', '<span class="alert-danger">:message</span><br>') !!}

                                            </div>
                                        </div>
                                        <div class="col-sm">

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">AVI:</label>
                                                <input type="text" name="GRU_AVI" value="{{ old('GRU_AVI') }}"
                                                    pattern="[A-Za-z]{1,3}" maxlength="3"
                                                    class="form-control form-control-sm" placeholder="AVI" required>
                                                {!! $errors->first('GRU_AVI', '<span class="alert-danger">:message</span><br>') !!}

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm">

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">HSA:</label>
                                                <input type="text" name="GRU_HSA" value="{{ old('GRU_HSA') }}"
                                                    pattern="[A-Za-z]{1,3}" maxlength="3"
                                                    class="form-control form-control-sm" placeholder="HSA" required>
                                                {!! $errors->first('GRU_HSA', '<span class="alert-danger">:message</span><br>') !!}

                                            </div>
                                        </div>
                                        <div class="col-sm">

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">ASA:</label>
                                                <input type="text" name="GRU_ASA" value="{{ old('GRU_ASA') }}"
                                                    pattern="[A-Za-z]{1,3}" maxlength="3"
                                                    class="form-control form-control-sm" placeholder="ASA" required>
                                                {!! $errors->first('GRU_ASA', '<span class="alert-danger">:message</span><br>') !!}

                                            </div>
                                        </div>
                                        <div class="col-sm">

                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">DES:</label>
                                                <input type="text" name="GRU_DES" value="{{ old('GRU_DES') }}"
                                                    pattern="[A-Za-z]{1,50}" maxlength="50"
                                                    class="form-control form-control-sm" placeholder="DES" required>
                                                {!! $errors->first('GRU_DES', '<span class="alert-danger">:message</span><br>') !!}

                                            </div>
                                        </div>
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


    <div class="modal fade" id="cierreGrupo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="modal-messege"></p>
                    <div class="modal-footer">
                        <button type="button"  class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <a type="button" class="btn btn-danger" id="formCierre"
                        href="{{ route('cierre.grupo_cierre', 1) }}" data-href="{{ route('cierre.grupo_cierre', 1) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                                        <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                                    </svg>
                        Cerrar</a></div>
            </div>
            
        </div>
    </div>
</div>
<script>

$('#cierreGrupo').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this);
  //Enviar valor del id a el form del modal
  action =$('#formCierre').attr('data-href').slice(0,-1);
  action += id;
  $('#formCierre').attr('href',action)
  modal.find('.modal-title').text('Cierre de grupo ' + id)
  modal.find('.modal-messege').text('¿ Desea cerrar el grupo ' + id + ' ?')
})
</script>

    <!--FIN CUADRO AGREGAR ALUMNO-->
@endsection
