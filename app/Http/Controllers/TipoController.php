<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Tipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    public function __construct(Tipo $tipo)
    {
        $this->tipo = $tipo;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $tipos = Tipo::select(
            'tipos.id',
            'tipos.nome',
            'tipos.created_at',
            'tipos.updated_at'
        )
        ->get();

    return view('tipos.index', ['tipos' => $tipos]);
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
        $request->validate($this->tipo->rules(), $this->tipo->feedback());

        $tipo = $this->tipo->create($request->all());
        return response()->json($tipo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo = $this->tipo->find($id);
        if ($tipo === null) {
            return response()->json(['erro' => 'O recurso pesquisado não existe'], 404);
        }
        return response()->json($tipo, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tipo  $tipo
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipo $tipo)
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
        $tipo = $this->tipo->find($id);
        if ($tipo === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach ($tipo->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $tipo->feedback());
        } else {
            $request->validate($tipo->rules(), $tipo->feedback());
        }

        $tipo->update($request->all());
        return response()->json($tipo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo = $this->tipo->find($id);
        if ($tipo === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }

        $tipo->delete();
        return response()->json(['msg' => 'O tipo foi removido com sucesso!'], 200);
    }

    public function obterTipo(Request $request)
    {
        $tipo = Tipo::get(['nome', 'id']);
        foreach ($tipo as $item) {
            $inventTipo[$item->id]  = $item->nome;
        }
        return response()->json($inventTipo, 200);
    }
}
