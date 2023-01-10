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

    </div>

    <div class="table-responsive-xl container">
        <form>

            <table id="example" class="table table-hover table-bordered">
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
                            <th scope="row">{{ $alumno->ALUMNO_NOMBRE }} {{ $alumno->ALUMNO_APELLIDO_PAT }}
                                {{ $alumno->ALUMNO_APELLIDO_MAT }}</th>
                            <td>{{ $alumno->ID_ALUMNO }}</td>
                            <td><input wire:model.debounce="listaCalificaciones.{{ $alumno->ID_ALUMNO }}.CALIF_PARCIAL1"
                                    name="{{ $alumno->ID_ALUMNO }}-P1" type="number"
                                    class="form-control form-control-sm {{ $listaCalificaciones[$alumno->ID_ALUMNO]['CALIF_PARCIAL1'] >= 70 ? 'border-success' : 'border-warning' }}"
                                    required {{ $parcial1 == 1 ? '' : 'disabled' }}>
                                @error('listaCalificaciones.' . $alumno->ID_ALUMNO . '.CALIF_INGLES_PARCIAL1')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td><input wire:model.debounce="listaCalificaciones.{{ $alumno->ID_ALUMNO }}.CALIF_PARCIAL2"
                                    name="{{ $alumno->ID_ALUMNO }}-P2" type="number"
                                    class="form-control form-control-sm {{ $listaCalificaciones[$alumno->ID_ALUMNO]['CALIF_PARCIAL2'] >= 70 ? 'border-success' : 'border-warning' }}" required
                                    {{ $parcial2 == 1 ? '' : 'disabled' }}>
                                @error('listaCalificaciones.' . $alumno->ID_ALUMNO . '.CALIF_PARCIAL2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </td>
                            <td><input wire:model.debounce="listaCalificaciones.{{ $alumno->ID_ALUMNO }}.CALIF_PARCIAL3"
                                    name="{{ $alumno->ID_ALUMNO }}-P3" type="number"
                                    class="form-control form-control-sm {{ $listaCalificaciones[$alumno->ID_ALUMNO]['CALIF_PARCIAL3'] >= 70 ? 'border-success' : 'border-warning' }}" required
                                    {{ $parcial3 == 1 ? '' : 'disabled' }}>
                                @error('listaCalificaciones.' . $alumno->ID_ALUMNO . '.CALIF_PARCIAL3')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </td>
                            <td><input wire:model.debounce="listaCalificaciones.{{ $alumno->ID_ALUMNO }}.CALIF_PARCIAL4"
                                    name="{{ $alumno->ID_ALUMNO }}-P3" type="number"
                                    class="form-control form-control-sm {{ $listaCalificaciones[$alumno->ID_ALUMNO]['CALIF_PARCIAL4'] >= 70 ? 'border-success' : 'border-warning' }}" required
                                    {{ $parcial4 == 1 ? '' : 'disabled' }}>

                                @error('listaCalificaciones.' . $alumno->ID_ALUMNO . '.CALIF_PARCIAL4')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </td>
                            <td>
                           <button wire:click="enviarCalificaciones({{ $alumno->ID_ALUMNO }})" 
                           name="{{ $alumno->ID_ALUMNO }}-btn" class="btn btn-success" {{ $parcial == -1 ? 'disabled':''  }}>Modificar</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            
        </form>

    </div>

    <script>
        Livewire.on('grupoChanged', () => {
            table.draw();
        })
    </script>


</div>
