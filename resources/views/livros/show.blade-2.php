@extends('adminlte::page')

@section('title', 'Livros Modal')

@section('content_livros-show')
<div class="row">
  <h1>Livros</h1>
</div>
@stop

@section('content')
<div class="container-fluid">
  <x-livro-show :livros="$livros" />
</div>
@stop


@section('footer')
<component-footer></component-footer>
@stop

@section('css')

@stop

@section('js')

@stop