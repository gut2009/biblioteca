@foreach ($clientes as $cliente)
<div class="row">
  <div class="col-12">
    <div class="card rounded">
      <div class="card-header bg-light p-3">
        @if($cliente->status == 0)
        Situação: <span class="badge badge-warning">Com empréstimo</span>
        @elseif($cliente->status == 1)
        Situação: <span class="badge badge-success">Sem empréstimo</span>
        @elseif($cliente->status == 2)
        Situação: <span class="badge badge-danger">Devolução de Empréstimo em Atraso</span>
        @endif
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-2 bg-light rounded pt-4 pb-4 text-center border border-primary">
            Foto
          </div>
          <div class="col-5">
            <span>Código: {{$cliente->id}}</span>
            <br>
            <span>Nome: {{$cliente->nome}}</span>
            <br>
            <span>Email: {{$cliente->email}}</span>
            <br>
          </div>
          <div class="col-5">
            <span>Data Nascimento: {{$cliente->nascimento}}</span>
            <br>
            <span>Cidade: {{$cliente->cidade}}</span>
            <br>
            <span>Estado: {{$cliente->uf}}</span>
            <br>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
