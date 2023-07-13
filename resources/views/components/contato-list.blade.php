@foreach ($contatos as $contato)
<div class="row">
  <div class="col-12">
    <div class="card rounded">
      <div class="card-header bg-light p-3">
        @if($contato->status == 0)
        Situação: <span class="badge badge-danger">Não respondido</span>
        @elseif($contato->status == 1)
        Situação: <span class="badge badge-warning">Em tratamento</span>
        @elseif($contato->status == 2)
        Situação: <span class="badge badge-success">Respondido</span>
        @endif
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-2 bg-light rounded pt-4 pb-4 text-center border border-primary">
            Foto
          </div>
          <div class="col-4">
            <span>Código do Cliente: {{$contato->cliente_id}}</span>
            <br>
            <span>Nome: {{$contato->cliente_nome}}</span>
          </div>
          <div class="col-6">
            <span>Código do Contato: {{$contato->id}}</span>
            <br>
            <span>Mensagem: {{$contato->mensagem}}</span>
            <br>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
