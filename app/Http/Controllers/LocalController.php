<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Local;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    public function __construct(Local $local)
    {
        $this->local = $local;
    }
    
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $locais = Local::select(
            'locais.id',
            'locais.ambiente',
            'locais.estante',
            'locais.prateleira',
            'locais.created_at',
            'locais.updated_at'
        )
        ->get();

    return view('locais.index', ['locais' => $locais]);
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
        $request->validate($this->local->rules(), $this->local->feedback());

        $local = $this->local->create($request->all());
        return response()->json($local, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $local = $this->local->find($id);
        if ($local === null) {
            return response()->json(['erro' => 'O recurso pesquisado não existe'], 404);
        }
        return response()->json($local, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Local  $local
     * @return \Illuminate\Http\Response
     */
    public function edit(Local $local)
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
        $local = $this->local->find($id);
        if ($local === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach ($local->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $local->feedback());
        } else {
            $request->validate($local->rules(), $local->feedback());
        }

        $local->update($request->all());
        return response()->json($local, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $local = $this->local->find($id);
        if ($local === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }

        $local->delete();
        return response()->json(['msg' => 'O local foi removido com sucesso!'], 200);
    }
    public function obterLocal(Request $request)
    {
        $local = Local::get(['ambiente', 'estante', 'prateleira', 'id']);
        foreach ($local as $item) {
            $inventlocal[$item->id]  = $item->ambiente . ' - ' . $item->local . ' - ' . $item->prateleira;
        }
        return response()->json($inventlocal, 200);
    }
}
