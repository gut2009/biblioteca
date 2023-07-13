<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'detalhe',
        'created_at',
        'updated_at'
    ];

    public function rules()
    {
        return [
            'nome' => 'required|unique:assuntos,nome,' . $this->id . '|min:5',
            'detalhe' => 'required|min:5',
        ];
        /* Unique --> 3 parâmetros:
         * 1) tabela (assuntos)
         * 2) nome da coluna que será pesquisada na tabela
         *      ex: "assuntos,nome" - pode ser omitido se for igual
         * 3) id do registro que será desconsiderado na pesquisa
         *      assuntos, nome, '.$this->id.'
         */
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome.unique' => 'O Assunto já existe',
            'nome.min' => 'O Assunto deve ter, no mínimo, 5 caracteres',
            'detalhe.min' => 'O Detalhe deve ter, no mínimo, 5 caracteres'
        ];
    }

    public function livros()
    {
        //UM assunto POSSUI MUITOS livros
        return $this->hasMany('App\Models\Livro');
    }
}
