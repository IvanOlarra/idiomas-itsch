<title> Calificaciones </title>
@extends('layout/main')


@section('contenido-main')



<!--Botton Salir-->
<div class="container">
    <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">

            <h5>Calificaciones
                
                <!-- Large modal Boton Agregar Calificacion 

                <button onclick="" type="button" class="btn btn-success" data-toggle="modal"
                    data-target=".bd-example-modal-lg">

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-person-plus" viewBox="0 0 16 16">
                        <path
                            d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                        <path fill-rule="evenodd"
                            d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                    Agregar Calificacion

                </button>-->

            </h5>
        </li>
    </ul>


</div>

<!--FIN DEL BOTTON-->

<!--Table-->
<div class="container">
    <table class="table table-hover table-bordered ">
        <thead class="thead-dark">
            <tr>
                <th>   </th>
                <th>Parcial 1</th>
                <th>Parcial 2</th>
                <th>Parcial 3</th>
                <th>Parcial 4</th>
            </tr>
        </thead>
        @foreach ($seleccalificacion as $item)
        <tbody>
            <tr>
                <td>
                {{$item -> PLAN_NOMBRE_IDIOMA}}
                </td>
                <td>
                {{$item -> CALIF_PARCIAL1}}
                </td>
                <td>
                {{$item -> CALIF_PARCIAL2}}
                </td>
                <td>
                {{$item -> CALIF_PARCIAL3}}
                </td>
                <td>
                {{$item -> CALIF_PARCIAL4}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="container">
    <h5>Cardex</h5>
    <table class="table table-hover table-bordered ">
        <thead class="thead-dark">
            <tr>
                <th>   </th>
                <th>Módulo 1</th>
                <th>Módulo 2</th>
                <th>Módulo 3</th>
                <th>Módulo 4</th>
                <th>Módulo 5</th>
                <th>Módulo 6</th>
                <th>Módulo 7</th>
                <th>Módulo 8</th>
                <th>Módulo 9</th>
            </tr>
        </thead>
        @foreach ($selectcardex as $item)
        <tbody>

            <tr>
                <td>
                    {{$item -> PLAN_NOMBRE_IDIOMA}}
                </td>
                <td>
                    {{$item -> CARDEX_CALIF_MOD1}}
                </td>
                <td>
                    {{$item -> CARDEX_CALIF_MOD2}}
                </td>
                <td>
                    {{$item -> CARDEX_CALIF_MOD3}}
                </td>
                <td>
                    {{$item -> CARDEX_CALIF_MOD4}}
                </td>
                <td>
                    {{$item -> CARDEX_CALIF_MOD5}}
                </td>
                <td>
                    {{$item -> CARDEX_CALIF_MOD6}}
                </td>
                <td>
                    {{$item -> CARDEX_CALIF_MOD7}}
                </td>
                <td>
                    {{$item -> CARDEX_CALIF_MOD8}}
                </td>
                <td>
                    {{$item -> CARDEX_CALIF_MOD9}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



<!--FINAL  Modulo-->


@endsection