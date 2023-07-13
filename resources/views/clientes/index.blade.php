@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
<div class="row">
  <div class="col-10">
    <h1>Clientes</h1>
  </div>
  <div class="col-2">
    <button class="btn btn-success">Adicionar</button>
  </div>
</div>
@stop

@section('content')
<div class="container-fluid">
  <x-cliente-list :clientes="$clientes" />
</div>
@stop

@section('footer')
<x-footer></x-footer>
@stop

@section('css')
@stop

@section('js')
@stop
