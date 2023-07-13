<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'livro_id',
        'dt_inicio',
        'dt_devolucao',
        'dt_final',
        'status'
    ];

    public function rules()
    {
        return [
            'cliente_id' => 'exists:clientes,id',
            'livro_id' => 'exists:livros,id',
            'cliente_id' => 'required',
            'livro_id' => 'required',
            'dt_inicio' => 'required',
            'dt_devolucao' => 'required',
            'status' => 'required'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
        ];
    }

    public function cliente()
    {
        //UM emprestimo PERTENCE a UM Cliente
        return $this->belongsTo('App\Models\Cliente');
    }

    public function livro()
    {
        //UM emprestimo PERTENCE a UM livro
        return $this->belongsTo('App\Models\Livro');
    }
}
