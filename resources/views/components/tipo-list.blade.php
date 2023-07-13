<div class="row">
  <div class="col-12">
    <div class="card rounded">
      <table class="table table-striped table-sm table-hover">
        <thead class="table-success">
          <tr>
            <th scope="col">Cód</th>
            <th scope="col">Nome</th>
            <th scope="col">Criação</th>
            <th scope="col">Alteração</th>
          </tr>
        </thead>
        @foreach ($tipos as $tipo)
        <tbody class="table-info">
          <tr>
            <th scope="row">{{$tipo->id}}</th>
            <td>{{$tipo->nome}}</td>
            <td>{{$tipo->created_at}}</td>
            <td>{{$tipo->updated_at}}</td>
          </tr>
        </tbody>
        @endforeach
      </table>
    </div>
  </div>
</div>
