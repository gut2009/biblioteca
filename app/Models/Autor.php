<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $table = 'autores';

    protected $fillable = [
        'nome',
        'nacionalidade',
        'created_at',
        'updated_at'
    ];

    public function rules()
    {
        return [
            'nome' => 'required|unique:autores,nome,' . $this->id . '|min:3',
            'nacionalidade' => 'required|min:5',
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome.unique' => 'O nome do Autor já existe',
            'nome.min' => 'O nome do Autor deve ter, no mínimo, 3 caracteres',
            'nacionalidade.min' => 'A nacionalidade deve ter, no mínimo, 5 caracteres'
        ];
    }

    public function livros()
    {
        //UM autor POSSUI MUITOS livros
        return $this->hasMany('App\Models\Livro');
    }
}
