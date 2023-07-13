<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'mensagem',
        'status'
    ];

    public function rules()
    {
        return [
            'cliente_id' => 'exists:clientes,id',
            'cliente_id' => 'required',
            'mensagem' => 'required|min:10|max:400',
            'status' => 'required',
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'mensagem.min' => 'A mensagem deve ter, no mínimo, 10 caracteres',
            'mensagem.max' => 'A mensagem deve ter, no máximo, 400 caracteres'
        ];
    }

    public function cliente()
    {
        //UM contato PERTENCE a UM Cliente
        return $this->belongTo('App\Models\Cliente');
    }
}
