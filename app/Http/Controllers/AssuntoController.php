<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Assunto;
use Illuminate\Http\Request;

class AssuntoController extends Controller
{
    public function __construct(Assunto $assunto)
    {
        $this->assunto = $assunto;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assuntos = Assunto::select(
            'assuntos.id',
            'assuntos.nome',
            'assuntos.detalhe',
            'assuntos.created_at',
            'assuntos.updated_at'
        )
        ->get();

    return view('assuntos.index', ['assuntos' => $assuntos]);
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
        $request->validate($this->assunto->rules(), $this->assunto->feedback());

        $assunto = $this->assunto->create($request->all());

        return response()->json($assunto, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $assunto = $this->assunto->with('livros')->find($id);
        if ($assunto === null) {
            return response()->json(['erro' => 'O recurso pesquisado não existe'], 404);
        }
        return response()->json($assunto, 200);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assunto  $assunto
     * @return \Illuminate\Http\Response
     */
    public function edit(Assunto $assunto)
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
        $assunto = $this->assunto->find($id);
        if ($assunto === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach ($assunto->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas, $assunto->feedback());
        } else {
            $request->validate($assunto->rules(), $assunto->feedback());
        }

        // preenchemndo o objeto ASSUNTO com todos os recursos do request
        $assunto->fill($request->all());
        $assunto->save();
        return response()->json($assunto, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $assunto = $this->assunto->find($id);
        if ($assunto === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }

        $assunto->delete();
        return response()->json(['msg' => 'O Assunto foi removido com sucesso!'], 200);
    }

    public function obterAssunto(Request $request)
    {
        $assunto = Assunto::get(['assunto', 'detalhe', 'id']);
        foreach ($assunto as $item) {
            $inventAssunto[$item->id]  = $item->assunto . ' - ' . $item->detalhe;
        }
        return response()->json($inventAssunto, 200);
    }
}
