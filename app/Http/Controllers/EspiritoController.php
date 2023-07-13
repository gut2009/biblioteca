<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Espirito;
use Illuminate\Http\Request;

class EspiritoController extends Controller
{
    public function __construct(Espirito $espirito)
    {
        $this->espirito = $espirito;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $espiritos = Espirito::select(
            'espiritos.id',
            'espiritos.nome',
            'espiritos.created_at',
            'espiritos.updated_at'
        )
        ->get();

    return view('espiritos.index', ['espiritos' => $espiritos]);
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
        $request->validate($this->espirito->rules(), $this->espirito->feedback());

        $espirito = $this->espirito->create($request->all());

        return response()->json($espirito, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $espirito = $this->espirito->with('livros')->find($id);
        if ($espirito === null) {
            return response()->json(['erro' => 'O recurso pesquisado não existe'], 404);
        }
        return response()->json($espirito, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\espirito  $espirito
     * @return \Illuminate\Http\Response
     */
    public function edit(Espirito $espirito)
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
        $espirito = $this->espirito->find($id);
        if ($espirito === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach ($espirito->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas, $espirito->feedback());
        } else {
            $request->validate($espirito->rules(), $espirito->feedback());
        }
        // preenchemndo o objeto AutorEspiritual com todos os recursos do request
        $espirito->fill($request->all());
        $espirito->save();
        return response()->json($espirito, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $espirito = $this->espirito->find($id);
        if ($espirito === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }

        $espirito->delete();
        return response()->json(['msg' => 'O Autor Espiritual foi removido com sucesso!'], 200);
    }
    public function obterEspirito(Request $request)
    {
        $espirito = Espirito::get(['nome', 'id']);
        foreach ($espirito as $item) {
            $inventEspirito[$item->id]  = $item->nome;
        }
        return response()->json($inventEspirito, 200);
    }
}
