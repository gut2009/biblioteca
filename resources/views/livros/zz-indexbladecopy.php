<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Nova Biblioteca</title>
</head>

<body>
    <h1>Biblioteca</h1>
    <div class="container">
        <h2>Visualizar Livros</h2>

        <div>

            @foreach($livros as $row => $livro)
                <a href="{{ route('livro.show', $row) }}">
                    Livro: {{ $livro['nome'] }} - <br>
                    Editora: {{ $livro['editora_nome'] }}<br>
                    Autor: {{ $livro['autor_nome'] }}<br>
                    Espírito: {{ $livro['espirito_nome'] }}<br>
                    Categoria: {{ $livro['categoria_nome'] }}<br>
                    Assunto: {{ $livro['assunto_nome'] }}<br>
                    Tipo: {{ $livro['tipo_nome'] }}<br>
                    Local: {{ $livro['local_ambiente'] }}<br>
                </a>
                <hr>
                <hr>
            @endforeach

        </div>



        <!--'livros.id',
            'livros.nome',
            'livros.complemento',
            'livros.editora_id',
            'livros.autor_id',
            'livros.espirito_id',
            'livros.outros_autores',
            'livros.tradutor',
            'livros.sinopse',
            'livros.imagem',
            'livros.edicao',
            'livros.paginas',
            'livros.categoria_id',
            'livros.assunto_id',
            'livros.tipo_id',
            'livros.cidade',
            'livros.uf',
            'livros.isbn',
            'livros.local_id',
            'editoras.nome as editora_nome',
            'autores.nome as autor_nome',
            'espiritos.nome as espirito_nome',
            'categorias.nome as categoria_nome',
            'assuntos.nome as assunto_nome',
            'tipos.nome as tipo_nome',
            'locais.ambiente as local_ambiente',-->

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
</body>

</html>
