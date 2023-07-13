@foreach ($livros as $livro)
<div class="row">
  <div class="col-12">
    <div class="card rounded">
      <div class="card-header bg-light p-3">
        @if($livro->status == 1)
        Situação: <span class="badge badge-success">Disponível</span>
        @elseif($livro->status == 0)
        Situação: <span class="badge badge-warning">Emprestado</span>
        @elseif($livro->status == 2)
        Situação: <span class="badge badge-danger">Não devolvido</span>
        @endif
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-2 bg-light rounded pt-4 pb-4 text-center border border-primary">
            Foto
          </div>
          <div class="col-5">
            <span>Nome: &nbsp;&nbsp;&nbsp;{{$livro->nome}}</span>
            <br>
            <span>Editora: &nbsp;&nbsp;&nbsp;{{$livro->editora_sigla}}</span>
            <br>
            <span>Autor: &nbsp;&nbsp;&nbsp;{{$livro->autor_nome}}</span>
            <br>
            <span>Autor Espiritual: &nbsp;&nbsp;&nbsp;{{$livro->espirito_nome}}</span>
            <br>
            <span>Tradutor: &nbsp; &nbsp; &nbsp; {{$livro->tradutor}}</span>
            <br>
          </div>
          <div class="col-5">
            <span>Categoria: &nbsp;&nbsp;&nbsp;{{$livro->categoria_nome}}</span>
            <br>
            <span>Assunto: &nbsp;&nbsp;&nbsp;{{$livro->assunto_nome}} / {{$livro->assunto_detalhe}}</span>
            <br>
            <span>Tipo: &nbsp;&nbsp;&nbsp;{{$livro->tipo_nome}}</span>
            <br>
            <span>Local/Estante/Prateleira: &nbsp&nbsp&nbsp{{$livro->local_ambiente}} - &nbsp;{{$livro->local_estante}} - &nbsp;{{$livro->local_prateleira}}</span>
            <br>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
