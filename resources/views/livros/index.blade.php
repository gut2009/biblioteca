@extends('adminlte::page')

@section('title', 'Livros')

@section('content_header')
<div class="row">
  <div class="col-10">
    <h1>Livros</h1>
  </div>
  <div class="col-2">
    <button class="btn btn-success">Adicionar</button>
  </div>
</div>
@stop

@section('content')
<div class="container-fluid">
  <x-livro-list :livros="$livros" />
</div>
@stop

@section('footer')
<x-footer></x-footer>
@stop

@section('css')
@stop

@section('js')
@stop
