<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Livro;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public $livro;
    public function __construct(Livro $livro)
    {
        $this->livro = $livro;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response 
     */
    public function index()
    {
                
        $livros = Livro::join('editoras', 'livros.editora_id', '=', 'editoras.id')
        ->join('autores', 'livros.autor_id', '=', 'autores.id')
        ->join('espiritos', 'livros.espirito_id', '=', 'espiritos.id')
        ->join('categorias', 'livros.categoria_id', '=', 'categorias.id')
        ->join('assuntos', 'livros.assunto_id', '=', 'assuntos.id')
        ->join('tipos', 'livros.tipo_id', '=', 'tipos.id')
        ->join('locais', 'livros.local_id', '=', 'locais.id')
        ->select(
            'livros.id',
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
            'livros.status',
            'editoras.nome as editora_nome',
            'editoras.sigla as editora_sigla',
            'autores.nome as autor_nome',
            'espiritos.nome as espirito_nome',
            'categorias.nome as categoria_nome',
            'assuntos.nome as assunto_nome',
            'assuntos.detalhe as assunto_detalhe',
            'tipos.nome as tipo_nome',
            'locais.ambiente as local_ambiente',
            'locais.estante as local_estante',
            'locais.prateleira as local_prateleira'
        )
        ->get();

        return view('livros.index', ['livros' => $livros]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        //return view('livros.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->livro->rules(), $this->livro->feedback());

        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens/livros', 'public');

        /* Requisitanto um por um (Professor João Sant'Ana)*/
        $livro = Livro::create([
            'nome' => $request->nome,
            'complemento' => $request->complemento,
            'editora_id' => $request->editora_id,
            'autor_id' => $request->autor_id,
            'espirito_id' => $request->espirito_id,
            'outros_autores' => $request->outros_autores,
            'tradutor' => $request->tradutor,
            'sinopse' => $request->sinopse,
            'imagem' => $imagem_urn,
            'edicao' => $request->edicao,
            'paginas' => $request->paginas,
            'categoria_id' => $request->categoria_id,
            'assunto_id' => $request->assunto_id,
            'tipo_id' => $request->tipo_id,
            'cidade' => $request->cidade,
            'uf' =>  $request->uf,
            'isbn' =>  $request->isbn,
            'local_id' =>  $request->local_id,
            'status' =>  $request->status,
        ]);
        $livro->fill($request->all());
        $livro->imagem = $imagem_urn;
        $livro->save();
         //Requesitando tudo
        // $livro = $this->livro->create($request->all());

        return response()->json($livro, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$livro = $this->livro->with('editora', 'autor', 'espirito')->find($id);
        $livro = $this->livro->find($id);
        if ($livro === null) {
            return response()->json(['erro' => 'O recurso pesquisado não existe'], 404);
        }
        return response()->json($livro, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function edit(Livro $livro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $livro = $this->livro->find($id);
        if ($livro === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach ($livro->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas, $livro->feedback());
        } else {
            $request->validate($livro->rules(), $livro->feedback());
        }

        //remove o arquivo antigo caso um novo arquivo tenha sido enviado no request
        if ($request->file('imagem')) {
            Storage::disk('public')->delete($livro->imagem);
        }

        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens/livros', 'public');

        //preencher o objeto $marca com os dados do request
        $livro->fill($request->all());
        $livro->imagem = $imagem_urn;
        $livro->save();

        return response()->json($livro, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $livro = $this->livro->find($id);
        if ($livro === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }

        //remove o arquivo antigo
        Storage::disk('public')->delete($livro->imagem);

        $livro->delete();
        return response()->json(['msg' => 'O Livro foi removido com sucesso!'], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function obterLivro(Request $request)
    {
        //$leitor = new Leitor($this->leitor);

        $livro = Livro::get(['nome', 'edicao', 'disponivel', 'id']);
        foreach ($livro as $item) {
            $inventLivro[$item->id]  = $item->nome . ' - ' . $item->edicao . ' - ' . $item->disponivel;
        }
        return response()->json($inventLivro, 200);
    }
}
