<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'created_at',
        'updated_at'
    ];

    public function rules()
    {
        return [
            'nome' => 'required|unique:categorias,nome,' . $this->id . '|min:5',
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome.unique' => 'A Categoria já existe',
            'nome.min' => 'A Categoria deve ter, no mínimo, 5 caracteres',
        ];
    }

    public function livros()
    {
        //UMA categoria POSSUI MUITOS livros
        return $this->hasMany('App\Models\Livro');
    }
}
