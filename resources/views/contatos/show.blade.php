<pre>

@foreach ($contatos as $contato)
    <div class="row">
        <div class="col-12">
            <div class="card rounded">
                
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-5">
                            <span>Nome: {{$contato->cliente}}</span>
                            <br>
                            <span>Autor: {{$contato->cliente_id}}</span>
                            <br>
                            <span>Editora: {{$contato->mensagem}}</span>
                        </div>
                        <div class="col-5">
                            <span>Sinopse: {{$contato->cliente_nome}}</span>
                            <br>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

</pre>
