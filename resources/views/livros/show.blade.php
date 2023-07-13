<pre>

@foreach ($livros as $livro)
    <div class="row">
        <div class="col-12">
            <div class="card rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <span>Nome: {{$livro->nome}}</span>
                            <br>
                            <span>Complemento: {{$livro->complemento}}</span>
                            <br>
                            <span>Editora: {{$livro->editora_id}}</span>
                            <br>
                            <span>Autor: {{$livro->autor_id}}</span>
                            <br>
                            <span>Espirito: {{$livro->espirito_id}}</span>
                            <br>
                            <span>Outros Autores: {{$livro->outros_autores}}</span>
                            <br>
                        </div>  
                        <div class="col-4">
                            <span>Traduror: {{$livro->tradutor}}</span>
                            <br>
                            <span>Sinopse: {{$livro->sinopse}}</span>
                            <br>
                            <span>Imagem: {{$livro->imagem}}</span>
                            <br>
                            <span>Edição: {{$livro->edicao}}</span>
                            <br>
                            <span>Paginas: {{$livro->paginas}}</span>
                            <br>
                        </div>
                        <div class="col-4">
                            <span>Categoria: {{$livro->categoria_id}}</span>
                            <br>
                            <span>Assunto: {{$livro->assunto_id}}</span>
                            <br>
                            <span>Tipo: {{$livro->tipo_id}}</span>
                            <br>
                            <span>Cidade: {{$livro->cidade}}</span>
                            <br>
                            <span>UF: {{$livro->uf}}</span>
                            <br>
                            <span>ISBN: {{$livro->isbn}}</span>
                            <br>
                            <span>Local: {{$livro->local_id}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

</pre>
