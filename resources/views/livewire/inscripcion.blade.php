<div>
    <div class="container">
        <div class="container">
            <div class="row ">
                <div class="col">
                    <h5>Inscripciones</h5>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-2">
                    <select wire:model="cantidadRegistros" class="form-control">
                        <option value=1>1</option>
                        <option value=10>10</option>
                        <option value=20>20</option>
                        <option value=50>50</option>
                        <option value=100>100</option>
                    </select>

                </div>
                <div class="col-3">
                    <p>registros por página.</p>
                </div>

                <div class="col-5 offset-2">
                    <input class="mr-sm-2 form-control " wire:model.debounce.500ms="busqueda" type="search"
                        placeholder="Búsqueda por nombre, correo o número de control." aria-label="Search">
                </div>
            </div>
        </div>

        {{-- Tabla --}}
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Inscripciones</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($listaAlumnos as $alumno)
                @if ($alumno['tipo'] == 'alumno')
                <tr>
                    <th>{{ $alumno['id'] }}</th>
                    <td wire:model="inscribiendo.alumno">{{ $alumno['nombre'] }}</td>

                    @if ($inscribiendo['id'] == $alumno['id'])
                    <td>
                        {{-- Si el alumno está siendo inscrito, se mostrará este form --}}
                        <form>
                            <h5 class="text-center">Inscripción a {{ $inscribiendo['idioma'] }}
                                MÓDULO {{ $inscribiendo['numeroModulo'] }}</h5>


                            {{-- Número de folio --}}
                            <div class="form-row mb-3">
                                <div class="col">
                                    <input type="number" wire:model="inscribiendo.folio" class="form-control"
                                        placeholder="Número de folio" />
                                    @error('inscribiendo.folio')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                {{-- Tipo Alumno --}}
                                <select class="custom-select" aria-placeholder="Grupo"
                                    wire:model="inscribiendo.tipoAlumno">
                                    <option wire:model="inscribiendo.grupo" selected hidden>Tipo Alumno</option>
                                    <option value="Interno">Interno</option>
                                    <option value="Externo">Externo </option>
                                </select>
                            </div>
                            {{-- Cantidad --}}
                            <div class="form-row mb-3">
                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" class="form-control" placeholder="Cantidad"
                                            wire:model="inscribiendo.cantidad" />
                                    </div>
                                    @error('inscribiendo.cantidad')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Grupos --}}
                            <div class="form-row mb-3">
                                <div class="col">
                                    <select class="custom-select" aria-placeholder="Grupo"
                                        wire:model="inscribiendo.idGrupo" onclick="mount()">

                                        <option wire:model="inscribiendo.grupo" selected hidden>Grupo</option>
                                        @foreach ($planesEstudio as $idPlan => $datosPlanEstudio)
                                        @foreach ($datosPlanEstudio['modulos'] as $idModulo => $datosModulo)
                                        @foreach ($datosModulo['grupos'] as $grupo)
                                        @if($grupo['PLAN_NOMBRE_IDIOMA']===$inscribiendo['idioma'] && $grupo['MODULO_NIVEL'] == $inscribiendo["numeroModulo"] )
                                        @if ($grupo['GRUPO_NUM_ALUMNOS'] < $grupo['GRUPO_LIMITE']) <option
                                            value="{{ $grupo['ID_GRUPO'] }}">
                                            {{ $grupo['GRUPO_NOM_GRUPO'] }}
                                            {{ $grupo['GRUPO_TIPO'] }}
                                            ({{ $grupo['GRUPO_NUM_ALUMNOS'] }}/{{ $grupo['GRUPO_LIMITE'] }})
                                            </option>
                                            @endif
                                            @endif
                                            @endforeach
                                            @endforeach
                                            @endforeach
                                    </select>
                                    @error('inscribiendo.idGrupo')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div @if($inscribiendo["cantidad"]< 700 && $inscribiendo["cantidad"]!=null &&
                                $inscribiendo["tipoAlumno"]=="Interno" && $inscribiendo['idGrupo'] !=null||
                                $inscribiendo["cantidad"]< 850 && $inscribiendo["cantidad"]!=null &&
                                $inscribiendo["tipoAlumno"]=="Externo" && $inscribiendo['idGrupo'] !=null ) active @else
                                hidden @endif>
                                <h5 class="text-center">Agregar Adeudo</h5>
                                <div class="form-group ">
                                    <label for="exampleFormControlInput1 ">Fecha:</label>
                                    <input class="form-control form-control-sm" wire:model="inscribiendo.fechaAdeudo"
                                        type="date">
                                    @error('inscribiendo.fechaAdeudo')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-row mb-3">
                                    <div class="col">
                                        <label for="exampleFormControlInput1">Adeudo:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" class="form-control" placeholder="Cantidad"
                                                wire:model="inscribiendo.cantidadAdeudo" />
                                        </div>
                                        @error('inscribiendo.cantidadAdeudo')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row mb-3">
                                    <textarea class="form-control" id="exampleFormControlTextarea1"
                                        wire:model="inscribiendo.descripcionAdeudo" maxlength="500" rows="3"
                                        placeholder="Observaciones"></textarea>
                                </div>

                            </div>


                            {{-- Botones --}}
                            <div class="d-flex justify-content-center">

                                <button @if($inscribiendo["cantidad"]==700 || $inscribiendo["cantidad"]==850 ||
                                    $inscribiendo["cantidadAdeudo"] !=null ) active @else hidden @endif type="button"
                                    class="btn btn-success mx-1" wire:click="inscribir">Inscribir</button>

                                <button type="button" class="btn btn-secondary mx-1"
                                    wire:click="cancelarInscripcion">Cancelar</button>
                            </div>
                        </form>
                    </td>
                    @else
                    <td>
                        @foreach ($planesEstudio as $idPlan => $contenido)
                        @if (isset($alumno['grupos']["$idPlan"]))
                        {{-- Existe el grupo, entonces está inscrito a él --}}
                        <button type="button" class="btn btn-secondary">
                            {{ $contenido['idioma'] }}</button>
                         {{--@elseif (isset($alumno['ultimoModulo']["$idPlan"]))
                        Si no está inscrito a ningún grupo, pero tiene antecedentes en el idioma

                        <button type="button" class="btn btn-success"
                            wire:click="llenarInscripcion('{{ $alumno['id'] }}','{{ $idPlan }}','{{ $alumno['ultimoModulo']["$idPlan"]['modulo'] + 1 }}','{{$alumno['aCursar']}})">
                            {{ $contenido['idioma'] }}  M{{ $alumno['ultimoModulo']["$idPlan"]['modulo'] + 1 }}</button>--}}
                        @else
                        {{-- No tiene antecedentes en el idioma --}}

                        <button type="button" class="btn btn-primary"
                            wire:click="llenarInscripcion('{{ $alumno['id'] }}','{{ $alumno['nombre'] }}','{{ $idPlan }}')">
                            {{ $contenido['idioma'] }}</button>
                        @endif
                        @endforeach
                    </td>
                    @endif

                </tr>
                @else
                {{-- No está registrado --}}
                <tr>
                    <th></th>
                    <td>{{ $alumno->name . ' - ' . $alumno->email }}</td>
                    <td><button type="button" class="btn btn-primary">Registrar</button></td>

                </tr>
                @endif
                @endforeach



            </tbody>
        </table>
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
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Nombre Alumno:</label>
                                    <input type="text" pattern="[a-zZ-A]{1,40}" maxlength="40"
                                        class="form-control form-control-sm" placeholder="Nombre"
                                        wire:model="inscribiendo.alumno" disabled>


                                </div>
                                <div class="form-row mb-3">
                                    <div class="col">
                                        <label for="exampleFormControlInput1">Cantidad Actual:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" class="form-control" placeholder="Cantidad"
                                                wire:model="inscribiendo.cantidad" disabled />
                                        </div>
                                        @error('inscribiendo.cantidad')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group ">
                                    <label for="exampleFormControlInput1 ">Fecha:</label>
                                    <input class="form-control form-control-sm"
                                        value="{{ $inscribiendo['fechaAdeudo']}}" type="date" id="example-date-input">

                                </div>
                                <div class="form-row mb-3">
                                    <div class="col">
                                        <label for="exampleFormControlInput1">Adeudo:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" class="form-control" placeholder="Cantidad" value={{
                                                $inscribiendo['cantidadAdeudo']}} />
                                        </div>
                                        @error('inscribiendo.cantidadAdeudo')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success" wire:click="inscribir">Inscribir</button>

                    </div>
                </div>

            </div>


        </div>
        <div class="container m-1">
            <div class="row">
                <div class="col-6">
                    {{ $alumnosPaginado->links() }}
                </div>

            </div>
        </div>

    </div>

</div>