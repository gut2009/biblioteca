<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
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
            'nome' => 'required|unique:tipos,nome,' . $this->id . '|min:3',
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome.unique' => 'O nome do tipo de objeto já existe',
            'nome.min' => 'O nome do tipo de objeto deve ter, no mínimo, 3 caracteres',
        ];
    }

    public function livros()
    {
        //UM tipo POSSUI MUITOS livros
        return $this->hasMany('App\Models\Livro');
    }
}
