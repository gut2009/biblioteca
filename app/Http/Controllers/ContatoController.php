<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Contato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function __construct(Contato $contato)
    {
        $this->contato = $contato;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contatos = Contato::join('clientes', 'contatos.cliente_id', '=', 'clientes.id')
        ->select(
            'contatos.id',
            'contatos.cliente_id',
            'contatos.mensagem',
            'contatos.status',
            'clientes.nome as cliente_nome',
        )
        ->get();

    return view('contatos.index', ['contatos' => $contatos]);
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
        $request->validate($this->contato->rules(), $this->contato->feedback());

        $contato = $this->contato->create($request->all());

        return response()->json($contato, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*
        $contato = $this->contato->with('cliente')->find($id);
        if ($contato === null) {
            return response()->json(['erro' => 'O recurso pesquisado não existe'], 404);
        }
        return response()->json($contato, 200);
        */

        $contatos = $this->contato->find($id);

        return response()->json($contatos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\contato  $contato
     * @return \Illuminate\Http\Response
     */
    public function edit(Contato $contato)
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
        $contato = $this->contato->find($id);
        if ($contato === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach ($contato->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            $request->validate($regrasDinamicas, $contato->feedback());
        } else {
            $request->validate($contato->rules(), $contato->feedback());
        }
        // preenchemndo o objeto AutorEspiritual com todos os recursos do request
        $contato->fill($request->all());
        $contato->save();
        return response()->json($contato, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contato = $this->contato->find($id);
        if ($contato === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }

        $contato->delete();
        return response()->json(['msg' => 'O Contato foi removido com sucesso!'], 200);
    }
}
