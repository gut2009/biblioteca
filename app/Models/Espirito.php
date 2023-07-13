<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Espirito extends Model
{
    use HasFactory;

    protected $table = 'espiritos';

    protected $fillable = [
        'nome',
        'created_at',
        'updated_at'
    ];
    public function rules()
    {
        return [
            'nome' => 'required|unique:espiritos,nome,' . $this->id . '|min:5',
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome.unique' => 'O Autor Espiritual já existe',
            'nome.min' => 'O nome do Autor Espiritual deve ter, no mínimo, 5 caracteres',
        ];
    }

    public function livros()
    {
        //UM Autor Espiritual POSSUI MUITOS livros
        return $this->hasMany('App\Models\Livro');
    }
}
