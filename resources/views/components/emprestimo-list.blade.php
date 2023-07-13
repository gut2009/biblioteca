@foreach ($emprestimos as $emprestimo)
<div class="row">
  <div class="col-12">
    <div class="card rounded">
      <div class="card-header bg-light p-3">
        @if($emprestimo->status == 0)
        Situação: <span class="badge badge-warning">Em andamento</span>
        @elseif($emprestimo->status == 1)
        Situação: <span class="badge badge-success">Encerrado </span>
        @elseif($emprestimo->status == 2)
        Situação: <span class="badge badge-danger">Não devolvido </span>
        @endif
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-2 bg-light rounded pt-4 pb-4 text-center border border-primary">
            Foto
          </div>
          <div class="col-5">
            <span>Código: {{$emprestimo->id}}</span>
            <br>
            <span>Cliente: {{$emprestimo->cliente_id}}</span>
            <br>
            <span>Nome: {{$emprestimo->cliente_nome}}</span>
            <br>
            <span>Livro: {{$emprestimo->livro_nome}}</span>
            <br>
          </div>
          <div class="col-5">
            <span>Data emprestimo: {{$emprestimo->dt_inicio}}</span>
            <br>
            <span>Data Prevista Devolução: {{$emprestimo->dt_devolucao}}</span>
            <br>
            <span>Data Efetiva da devolução: {{$emprestimo->dt_final}}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
