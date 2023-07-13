<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('complemento', 150);
            $table->unsignedBigInteger('editora_id');
            $table->unsignedBigInteger('autor_id');
            $table->unsignedBigInteger('espirito_id');
            $table->string('outros_autores', 100);
            $table->string('tradutor', 100);
            $table->string('sinopse', 400);
            $table->string('imagem', 100);
            $table->string('edicao')->default('1');
            $table->string('paginas');
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('assunto_id');
            $table->unsignedBigInteger('tipo_id');
            $table->string('cidade', 50);
            $table->string('uf', 2);
            $table->integer('isbn');
            $table->unsignedBigInteger('local_id');
            $table->integer('status')->default(0);
            $table->timestamps();

            //foreign key (constraints)
            $table->foreign('editora_id')->references('id')->on('editoras');
            $table->foreign('autor_id')->references('id')->on('autores');
            $table->foreign('espirito_id')->references('id')->on('espiritos');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('assunto_id')->references('id')->on('assuntos');
            $table->foreign('tipo_id')->references('id')->on('tipos');
            $table->foreign('local_id')->references('id')->on('locais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livros');
    }
};
