@extends('layouts.admin')

@section('page-header')
    <h1>Panel Administrativo</h1>
    <p> Bienvenido <b>{{ Auth::user()->name }}</b>, aca se mostrara el contenido del panel administrativo.</p>
    <hr class="">
@stop
@section('content')
@stop
