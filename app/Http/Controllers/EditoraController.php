<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Editora;
use Illuminate\Http\Request;

class EditoraController extends Controller
{
    public function __construct(Editora $editora)
    {
        $this->editora = $editora;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'chegamos aqui';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->editora->rules(), $this->editora->feedback());

        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens/editoras', 'public');

        $editora = $this->editora->create([

            'nome' => $request->nome,
            'sigla' => $request->sigla,
            'imagem' => $imagem_urn,
            'cidade' => $request->cidade,
            'uf' => $request->uf,
            'pais' => $request->pais,
        ]);
        return response()->json($editora, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $editora = $this->editora->with('livros')->find($id);
        if ($editora === null) {
            return response()->json(['erro' => 'O recurso pesquisado não existe'], 404);
        }
        return response()->json($editora, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Editora  $editora
     * @return \Illuminate\Http\Response
     */
    public function edit(Editora $editora)
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
        $editora = $this->editora->find($id);
        if ($editora === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach ($editora->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas, $editora->feedback());
        } else {
            $request->validate($editora->rules(), $editora->feedback());
        }

        //remove o arquivo antigo caso um novo arquivo tenha sido enviado no request
        if ($request->file('imagem')) {
            Storage::disk('public')->delete($editora->imagem);
        }

        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens/editoras', 'public');

        //preencher o objeto $editora com os dados do request
        $editora->fill($request->all());
        $editora->imagem = $imagem_urn;
        $editora->save();

        return response()->json($editora, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $editora = $this->editora->find($id);
        if ($editora === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }

        //remove o arquivo antigo
        Storage::disk('public')->delete($editora->imagem);

        $editora->delete();
        return response()->json(['msg' => 'A Editora foi removida com sucesso!'], 200);
    }

    public function obterEditora(Request $request)
    {
        $editora = Editora::get(['sigla', 'nome', 'id']);
        foreach ($editora as $item) {
            $inventEditora[$item->id]  = $item->sigla . ' - ' . $item->nome;
        }
        return response()->json($inventEditora, 200);
    }
}
