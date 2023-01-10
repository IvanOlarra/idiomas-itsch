@extends('layout/main')


@section('contenido-main')



<div class="table-responsive-xl container">

    <table class="table table-hover table-bordered ">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Matricula</th>
                <th scope="col">Nombre Alumno</th>
                <th scope="col">Unidad 1</th>
                <th scope="col">Unidad 2</th>
                <th scope="col">Unidad 3</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">Calificacion1</th>
                <td>S16030159</td>
                <td>Raul Armando Medina</td>
                <td>9</td>
                <td>9</td>
                <td>9</td>

            </tr>

        </tbody>
    </table>

</div>


@endsection