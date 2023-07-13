<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editora extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'sigla',
        'imagem',
        'cidade',
        'uf',
        'pais'
    ];

    public function rules()
    {
        return [
            'nome' => 'required|unique:editoras,nome,' . $this->id . '|min:5',
            'sigla' => 'required|unique:editoras,sigla,' . $this->id . '|min:3',
            'imagem' => 'required|file|mimes:png,jpeg,jpg,webp',
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome.unique' => 'O nome da Editora já existe',
            'sigla.unique' => 'A sigla da Editora já existe',
            'nome.min' => 'O nome da Editora deve ter, no mínimo, 5 caracteres',
            'sigla.min' => 'A sigla da Editora deve ter, no mínimo, 3 caracteres',
            'imagem.file' => 'A imagem, do tipo png, jpeg, jpg, webp, é obrigatória',
            'imagem.mimes' => 'A imagem deve ser do tipo png, jpeg, jpg, webp',
        ];
    }

    public function livros()
    {
        //UMA editora POSSUI MUITOS livros
        return $this->hasMany('App\Models\Livro');
    }
}
