<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function __construct(Autor $autor)
    {
        $this->autor = $autor;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autores = Autor::select(
            'autores.id',
            'autores.nome',
            'autores.nacionalidade',
            'autores.created_at',
            'autores.updated_at'
        )
        ->get();

    return view('autores.index', ['autores' => $autores]);
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
        $request->validate($this->autor->rules(), $this->autor->feedback());

        $autor = $this->autor->create($request->all());

        return response()->json($autor, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $autor = $this->autor->with('livros')->find($id);
        if ($autor === null) {
            return response()->json(['erro' => 'O recurso pesquisado não existe'], 404);
        }
        return response()->json($autor, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function edit(Autor $autor)
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
        $autor = $this->autor->find($id);
        if ($autor === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach ($autor->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $autor->feedback());
        } else {
            $request->validate($autor->rules(), $autor->feedback());
        }

        // preenchemndo o objeto AUTOR com todos os recursos do request
        $autor->fill($request->all());
        $autor->save();
        return response()->json($autor, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $autor = $this->autor->find($id);
        if ($autor === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }
        //remove o arquivo antigo
        Storage::disk('public')->delete($autor->imagem);

        $autor->delete();
        return response()->json(['msg' => 'O Autor foi removido com sucesso!'], 200);
    }

    public function obterAutor(Request $request)
    {
        $autor = Autor::get(['nome', 'nacionalidade', 'id']);
        foreach ($autor as $item) {
            $inventAutor[$item->id]  = $item->nome . ' - ' . $item->nacionalidade;
        }
        return response()->json($inventAutor, 200);
    }
}
