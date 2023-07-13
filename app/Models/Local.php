<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;

    protected $table = 'locais';

    protected $fillable = [
        'ambiente',
        'estante',
        'prateleira',
        'created_at',
        'updated_at'
    ];

    public function rules()
    {
        return [
            'ambiente' => 'required|min:3',
            'estante' => 'required|min:3',
            'prateleira' => 'required',
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'ambiente.min' => 'O nome do Ambiente deve ter, no mínimo, 3 caracteres',
            'estante.min' => 'O nome da Estante deve ter, no mínimo, 3 caracteres'
        ];
    }

    public function livros()
    {
        //UM local POSSUI MUITOS livros
        return $this->hasMany('App\Models\Livro');
    }
}
