<div class="row">
  <div class="col-12">
    <div class="card rounded">
      <table class="table table-striped table-sm table-hover">
        <thead class="table-success">
          <tr>
            <th scope="col">Cód</th>
            <th scope="col">Autor</th>
            <th scope="col">Nacionalidade</th>
            <th scope="col">Criação</th>
            <th scope="col">Alteração</th>
          </tr>
        </thead>
        @foreach ($autores as $autor)
        <tbody class="table-info">
          <tr>
            <th scope="row">{{$autor->id}}</th>
            <td>{{$autor->nome}}</td>
            <td>{{$autor->nacionalidade}}</td>
            <td>{{$autor->created_at}}</td>
            <td>{{$autor->updated_at}}</td>
          </tr>
        </tbody>
        @endforeach
      </table>
    </div>
  </div>
</div>
