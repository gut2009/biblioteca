<div class="row">
  <div class="col-12">
    <div class="card rounded">
      <table class="table table-striped table-sm table-hover">
        <thead class="table-success">
          <tr>
            <th scope="col">Cód</th>
            <th scope="col">Ambiente</th>
            <th scope="col">Estante</th>
            <th scope="col">Prateleira</th>
            <th scope="col">Criação</th>
            <th scope="col">Alteração</th>
          </tr>
        </thead>
        @foreach ($locais as $local)
        <tbody class="table-info">
          <tr>
            <th scope="row">{{$local->id}}</th>
            <td>{{$local->ambiente}}</td>
            <td>{{$local->estante}}</td>
            <td>{{$local->prateleira}}</td>
            <td>{{$local->created_at}}</td>
            <td>{{$local->updated_at}}</td>
          </tr>
        </tbody>
        @endforeach
      </table>
    </div>
  </div>
</div>
