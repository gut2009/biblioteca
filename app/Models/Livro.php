<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'nome',
        'complemento',
        'editora_id',
        'autor_id',
        'espirito_id',
        'outros_autores',
        'tradutor',
        'sinopse',
        'imagem',
        'edicao',
        'paginas',
        'categoria_id',
        'assunto_id',
        'tipo_id',
        'cidade',
        'uf',
        'isbn',
        'local_id',
        'status'
    ];


    public function rules()
    {
        return [
            'editora_id' => 'exists:editoras,id',
            'autor_id' => 'exists:autores,id',
            'espirito_id' => 'exists:autores_espirituais,id',
            'categoria_id' => 'exists:categorias,id',
            'assunto_id' => 'exists:assuntos,id',
            'tipo_id' => 'exists:tipos,id',
            'local_id' => 'exists:estantes,id',

            'nome' => 'required|min:3|max:100',
            'complemento' => 'required|min:3|max:150',
            'editora_id' => 'required',
            'autor_id' => 'required',
            'espirito_id' => 'required',
            'sinopse' => 'required|min:5|max:800',
            'imagem' => 'required|file|mimes:png,jpeg,jpg,webp',
            'paginas' => 'required',
            'categoria_id' => 'required',
            'assunto_id' => 'required',
            'tipo_id' => 'required',
            'local_id' => 'required',
            'status' => 'required'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            "nome.min" => "O nome do Livro tem que possuir mais de 3 letras",
            "nome.max" => "O nome do Livro tem que ter no máximo 100 caracteres",
            "complemento.min" => "O complemento do Livro tem que possuir mais de 3 letras",
            "complemento.max" => "O complemento do Livro tem que ter no máximo 150 caracteres",
            "sinopse.min" => "A Sinopse deve ter, no mínimo, 5 caracteres",
            "sinopse.max" => "A Sinopse deve ter, no máximo, 800 caracteres",
            'imagem.file' => 'A imagem, do tipo png, jpeg, jpg, webp, é obrigatória',
            'imagem.mimes' => 'A imagem deve ser do tipo png, jpeg, jpg, webp',
        ];
    }

    public function autor()
    {
        //UM livro PERTENCE a UM autor
        return $this->belongsTo('App\Models\Autor');
    }

    public function espirito()
    {
        //UM livro PERTENCE a UM Autor Espiritual
        return $this->belongsTo('App\Models\Espirito');
    }

    public function editora()
    {
        //UM livro PERTENCE a UMA editora
        return $this->belongsTo('App\Models\Editora');
    }

    public function assunto()
    {
        //UM livro PERTENCE a UM assunto
        return $this->belongsTo('App\Models\Assunto');
    }

    public function categoria()
    {
        //UM livro PERTENCE a UMA categoria
        return $this->belongsTo('App\Models\Categoria');
    }

    public function local()
    {
        //UM livro PERTENCE a UMA localização
        return $this->belongsTo('App\Models\Local');
    }

    public function tipo()
    {
        //UM livro PERTENCE a UM tipo
        return $this->belongsTo('App\Models\Tipo');
    }

    public function emprestimos()
    {
        //UM livro POSSUI MUITOS emprestimos
        return $this->hasMany('App\Models\Emprestimo');
    }
}
