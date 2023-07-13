@extends('adminlte::page')

@section('title', 'Livros Cadastrar')

@section('content_header')
<div class="row">
  <div class="col-10">
    <h1>Cadastrar Livros</h1>
  </div>

</div>
@stop

@section('content')
<div class="container-fluid">
  <x-livro-store></x-livro-store>
  <form action="{{ route('livros.store') }}" method="POST" class="row g-3">
    @csrf
    <div class="col-md-6">
      <label for="inputNome" class="form-label">Nome do Livro</label>
      <input type="text" class="form-control" id="inputNome">
    </div>
    <div class="col-md-2">
      <label for="inputEditoraId" class="form-label">Editora ID</label>
      <input type="text" class="form-control" id="inputEditoraId">
    </div>
    <div class="col-md-2">
      <label for="inputAutorId" class="form-label">Autor ID</label>
      <input type="text" class="form-control" id="inputAutorId">
    </div>
    <div class="col-md-2">
      <label for="inputEspiritoId" class="form-label">Espirito ID</label>
      <input type="text" class="form-control" id="inputEspiritoId">
    </div>


    <div class="col-6">
      <label for="inputOutrosA" class="form-label">Outros Autores</label>
      <input type="text" class="form-control" id="inputOutrosA">
    </div>
    <div class="col-6">
      <label for="inputTradutor" class="form-label">Tradutor</label>
      <input type="text" class="form-control" id="inputTradutor">
    </div>


    <div class="col-12">
      <label for="inputSinopse" class="form-label">Address 2</label>
      <textarea class="form-control" id="inputSinopse" rows="5"></textarea>
    </div>


    <div class="mb-3">
      <label for="formImagem" class="form-label">Capa do Livro</label>
      <input class="form-control" type="file" id="formImagem">
    </div>

    <div class="col-3">
      <label for="inputEdicao" class="form-label">Edição</label>
      <input type="text" class="form-control" id="inputEdicao">
    </div>
    <div class="col-3">
      <label for="inputPaginas" class="form-label">Paginas</label>
      <input type="text" class="form-control" id="inputPaginas">
    </div>
    <div class="col-2">
      <label for="inputCategoriaId" class="form-label">Categoria ID</label>
      <input type="text" class="form-control" id="inputCategoriaId">
    </div>
    <div class="col-2">
      <label for="inputAssuntoId" class="form-label">Assunto ID</label>
      <input type="text" class="form-control" id="inputAssuntoId">
    </div>
    <div class="col-2">
      <label for="inputTipoId" class="form-label">Tipo ID</label>
      <input type="text" class="form-control" id="inputTipoId">
    </div>


    <div class="col-md-4">
      <label for="inputCidade" class="form-label">Cidade</label>
      <input type="text" class="form-control" id="inputCidade">
    </div>
    <div class="col-md-1">
      <label for="inputUf" class="form-label">Estado</label>
      <input type="text" class="form-control" id="inputUf">
    </div>
    <div class="col-md-3">
      <label for="inputIsbn" class="form-label">ISBN</label>
      <input type="text" class="form-control" id="inputIsbn">
    </div>
    <div class="col-md-2">
      <label for="inputLocal" class="form-label">Local</label>
      <input type="text" class="form-control" id="inputLocal">
    </div>
    <div class="col-md-1">
      <label for="inputStatus" class="form-label">Situação</label>
      <input type="text" class="form-control" id="inputStatus">
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-primary">Sign in</button>
    </div>
  </form>
</div>
@stop

@section('footer')
<x-footer></x-footer>
@stop

@section('css')
@stop

@section('js')
@stop
