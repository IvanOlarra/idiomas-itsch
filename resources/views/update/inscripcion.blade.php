@extends('layout/main')


@section('contenido-main')

<!--CUADRO SALIDA AGREGAR INSCRIPCION-->

<div class="modal-dialog modal-lg">
    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Inscripcion</h5>

        </div>
        @foreach ($selecinscripcion as $informacion )
        <form action="{{ route('update.modoficar-inscripcion', $informacion->ID_INSCRIPCION ) }}" method="POST">
            @method('PATCH')
            @csrf



            <div class="row>">
                <div class="col-sm">

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Clave:</label>
                        <input type="text" name="ID_INSCRIPCION" class="form-control form-control-sm"
                            pattern="[A-Zz-a]{1,30}" maxlength="30" placeholder="Clave"
                            value="{{$informacion->ID_INSCRIPCION }}" required disabled>
                        {!! $errors->first('ID_INSCRIPCION','<span class="alert-danger">:message</span><br>')
                        !!}

                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Alumno:</label>
                        <select name="INSCRIPCION_ID_ALUMNO" class="form-control form-control-sm"
                            id="exampleFormControlSelect1">

                            <option value={{ $informacion->ID_ALUMNO }}> {{ $informacion->ALUMNO_NOMBRE }}
                                {{ $informacion->ALUMNO_APELLIDO_MAT }} {{ $informacion->ALUMNO_APELLIDO_PAT }}
                            </option>
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
                        <label for="exampleFormControlSelect1">Grupo:</label>
                        <select name="ID_GRUPO_NOMBRE" class="form-control form-control-sm"
                            id="exampleFormControlSelect1">

                            <option> {{ $informacion->ID_GRUPO_NOMBRE }}</option>
                            <?php foreach ($selecgrupo as $item)  {?>

                            <option>

                                <?php  echo $item->	ID_GRUPO_NOMBRE; 
                                        
                                            
                                        ?>
                                </>

                                <?php
                                   

                                            }//cierro el foreach
                                            ?>

                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleFormControlInput1">Folio:</label>
                        <input name="INSCRIPCION_NUM_FOLIO" value="{{ $informacion->INSCRIPCION_NUM_FOLIO }}" type="tel"
                            maxlength="11" pattern="[0-9]{1,11}" class="form-control form-control-sm"
                            placeholder="Numero de Folio" required>
                        {!! $errors->first('INSCRIPCION_NUM_FOLIO','<span class="alert-danger">:message</span><br>')
                        !!}
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">Monto:</label>
                        <input name="INSCRIPCION_MONTO" value="{{ $informacion->INSCRIPCION_MONTO }}" type="tel"
                            maxlength="11" pattern="[0-9]{1,11}" class="form-control form-control-sm"
                            placeholder="$ Cantidad" required>
                        {!! $errors->first('INSCRIPCION_MONTO','<span class="alert-danger">:message</span><br>')
                        !!}
                    </div>

                    <div class="form-group ">
                        <label for="exampleFormControlInput1 ">Fecha
                            Nacimiento:</label>

                        <input name="ISCRIPCION_FECHA" class="form-control form-control-sm" type="date"
                            value="{{ $informacion->ISCRIPCION_FECHA }}" id="example-date-input">

                    </div>


                    <div class="form-group">
                        <label for="exampleFormControlInput1">INS_PER:</label>
                        <input type="text" name="INS_PER" pattern="[a-zZ-A]{1,8}" maxlength="8"
                            class="form-control form-control-sm" placeholder="INS_PER"
                            value="{{ $informacion->INS_PER }}" required>
                        {!! $errors->first('INS_PER','<span class="alert-danger">:message</span><br>') !!}


                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">INS_AN:</label>
                        <input name="INS_AN" value="{{ $informacion->INS_AN }}" type="tel" maxlength="4"
                            pattern="[0-9]{1,4}" class="form-control form-control-sm" placeholder="INS_AN" required>
                        {!! $errors->first('INS_AN','<span class="alert-danger">:message</span><br>') !!}
                    </div>


                </div>
                @endforeach

            </div>

            <div class="modal-footer">
                <a href="/inscripcion" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</a>
                <button type="submit" class="btn btn-success">Modificar</button>

            </div>
        </form>

    </div>
</div>




<!--FINAL  CUADRO SALIDA AGREGAR INSCRIPCION-->
@endsection