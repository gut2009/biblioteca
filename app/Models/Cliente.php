<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'imagem',
        'email',
        'nascimento',
        'cidade',
        'uf',
        'status'
    ];

    public function rules()
    {
        return [
            'nome' => 'required|min:3',
            'email' => 'required|unique:clientes,email,' . $this->id . '',
            'imagem' => 'required|file|mimes:png,jpeg,jpg,webp',
            'cidade' => 'required|min:3',
            'uf' => 'required',
            'status' => 'required',
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome.min' => 'O nome do Leitor deve ter, no mínimo, 3 caracteres',
            'cidade.min' => 'O nome da Cidade deve ter, no mínimo, 3 caracteres',
            'email.unique' => 'O email informado já existe',
            'imagem.file' => 'A imagem, do tipo png, jpeg, jpg, webp, é obrigatória',
            'imagem.mimes' => 'A imagem deve ser do tipo png, jpeg, jpg, webp',
        ];
    }

    public function emprestimos()
    {
        //UM cliente POSSUI MUITOS Emprestimos
        return $this->hasMany('App\Models\Emprestimo');
    }

    public function contatos()
    {
        //UM cliente POSSUI MUITOS Contatos
        return $this->hasMany('App\Models\Contato');
    }
}
