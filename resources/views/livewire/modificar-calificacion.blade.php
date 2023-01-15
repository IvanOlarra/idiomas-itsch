<div>


    <div class="container">
        <div class="col-sm">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Grupos:</label>
                <select class="form-control  form-control-sm" name="DOCENTE_SEXO" id="exampleFormControlSelect1"
                    wire:model="grupo">

                    @foreach ($listaGrupos as $grupo)
                        <option value="{{ $grupo->ID_GRUPO }}">{{ $grupo->GRUPO_NOM_GRUPO }}</option>
                    @endforeach
                </select>
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

    <div class="table-responsive-xl container">
        <form>

            <table class="table">

                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Matricula</th>
                        <th scope="col">Unidad 1</th>
                        <th scope="col">Unidad 2</th>
                        <th scope="col">Unidad 3</th>
                        <th scope="col">Unidad 4</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody> 
                    @foreach ($listaAlumnos as $alumno)
                    <tr>
                        <th scope="row">{{ $alumno['ALUMNO_NOMBRE'] }} {{ $alumno['ALUMNO_APELLIDO_PAT'] }}
                            {{ $alumno['ALUMNO_APELLIDO_MAT'] }}</th>
                        <td>{{ $alumno['ID_ALUMNO'] }}</td>
                        <td><input wire:model.debounce="listaCalificaciones.{{ $alumno['ID_ALUMNO'] }}.CALIF_PARCIAL1"
                                name="{{ $alumno['ID_ALUMNO'] }}-P1" type="number"
                                class="form-control form-control-sm {{ $listaCalificaciones[$alumno['ID_ALUMNO']]['CALIF_PARCIAL1'] >= 70 ? 'border-success' : 'border-warning' }}"
                                required {{ $parcial1 == 1 ? '' : 'disabled' }}>
                            @error('listaCalificaciones.' . $alumno['ID_ALUMNO'] . '.CALIF_INGLES_PARCIAL1')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td><input wire:model.debounce="listaCalificaciones.{{ $alumno['ID_ALUMNO'] }}.CALIF_PARCIAL2"
                                name="{{ $alumno['ID_ALUMNO'] }}-P2" type="number"
                                class="form-control form-control-sm {{ $listaCalificaciones[$alumno['ID_ALUMNO']]['CALIF_PARCIAL2'] >= 70 ? 'border-success' : 'border-warning' }}" required
                                {{ $parcial2 == 1 ? '' : 'disabled' }}>
                            @error('listaCalificaciones.' . $alumno['ID_ALUMNO'] . '.CALIF_PARCIAL2')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td><input wire:model.debounce="listaCalificaciones.{{ $alumno['ID_ALUMNO'] }}.CALIF_PARCIAL3"
                                name="{{ $alumno['ID_ALUMNO'] }}-P3" type="number"
                                class="form-control form-control-sm {{ $listaCalificaciones[$alumno['ID_ALUMNO']]['CALIF_PARCIAL3'] >= 70 ? 'border-success' : 'border-warning' }}" required
                                {{ $parcial3 == 1 ? '' : 'disabled' }}>
                            @error('listaCalificaciones.' . $alumno['ID_ALUMNO'] . '.CALIF_PARCIAL3')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td><input wire:model.debounce="listaCalificaciones.{{ $alumno['ID_ALUMNO'] }}.CALIF_PARCIAL4"
                                name="{{ $alumno['ID_ALUMNO'] }}-P3" type="number"
                                class="form-control form-control-sm {{ $listaCalificaciones[$alumno['ID_ALUMNO']]['CALIF_PARCIAL4'] >= 70 ? 'border-success' : 'border-warning' }}" required
                                {{ $parcial4 == 1 ? '' : 'disabled' }}>

                            @error('listaCalificaciones.' . $alumno['ID_ALUMNO'] . '.CALIF_PARCIAL4')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </td>
                        <td>
                       <button wire:click="enviarCalificaciones({{ $alumno['ID_ALUMNO'] }})" 
                       name="{{ $alumno['ID_ALUMNO'] }}-btn" class="btn btn-success" {{ $parcial == -1 ? 'disabled':''  }}>Modificar</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
           
            
        </form>
        

    </div>
    {{--<div class="container m-1">
        <div class="row">
            <div class="col-6">
                {{ $alumnosPaginado->links() }}
            </div>

        </div>
    </div>--}}


</div>
