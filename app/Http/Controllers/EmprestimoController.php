<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Emprestimo;
use Illuminate\Http\Request;

class EmprestimoController extends Controller
{
    public function __construct(Emprestimo $emprestimo)
    {
        $this->emprestimo = $emprestimo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emprestimos = Emprestimo::join('clientes', 'emprestimos.cliente_id', '=', 'clientes.id')
        ->join('livros', 'emprestimos.livro_id', '=', 'livros.id')
        ->select(
            'emprestimos.id',
            'emprestimos.cliente_id',
            'emprestimos.livro_id',
            'emprestimos.dt_inicio',
            'emprestimos.dt_devolucao',
            'emprestimos.dt_final',
            'emprestimos.status',
            'clientes.nome as cliente_nome',
            'livros.nome as livro_nome'
        )
        ->get();

        return view('emprestimos.index', ['emprestimos' => $emprestimos]);


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
        $request->validate($this->emprestimo->rules(), $this->emprestimo->feedback());

        $emprestimo = $this->emprestimo->create($request->all());
        return response()->json($emprestimo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$emprestimo = $this->emprestimo->with('leitor', 'livro')->find($id);
        $emprestimo = $this->emprestimo->find($id);
        if ($emprestimo === null) {
            return response()->json(['erro' => 'O recurso pesquisado não existe'], 404);
        }
        return response()->json($emprestimo, 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function edit(Emprestimo $emprestimo)
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
        $emprestimo = $this->emprestimo->find($id);
        if ($emprestimo === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach ($emprestimo->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $emprestimo->feedback());
        } else {
            $request->validate($emprestimo->rules(), $emprestimo->feedback());
        }

        $emprestimo->update($request->all());
        return response()->json($emprestimo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emprestimo = $this->emprestimo->find($id);
        if ($emprestimo === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }

        $emprestimo->delete();
        return response()->json(['msg' => 'O Emprestimo foi removido com sucesso!'], 200);
    }
}
