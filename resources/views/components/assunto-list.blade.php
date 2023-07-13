<div class="row">
  <div class="col-12">
    <div class="card rounded">
      <table class="table table-striped table-sm table-hover">
        <thead class="table-success">
          <tr>
            <th scope="col">Cód</th>
            <th scope="col">Assunto</th>
            <th scope="col">Detalhe</th>
            <th scope="col">Criação</th>
            <th scope="col">Alteração</th>
          </tr>
        </thead>
        @foreach ($assuntos as $assunto)
        <tbody class="table-info">
          <tr>
            <th scope="row">{{$assunto->id}}</th>
            <td>{{$assunto->nome}}</td>
            <td>{{$assunto->detalhe}}</td>
            <td>{{$assunto->created_at}}</td>
            <td>{{$assunto->updated_at}}</td>
          </tr>
        </tbody>
        @endforeach
      </table>
    </div>
  </div>
</div>
