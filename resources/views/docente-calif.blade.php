@extends('layout/main')


@section('contenido-main')

@livewire('modificar-calificacion', ['listaGrupos'=>$listaGrupos])

@endsection