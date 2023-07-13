<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Http\Controllers\LivroController;

class LivroShow extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $livros;
    public function __construct($livros)
    {
        $this->livros = $livros;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.livro-show');
    }
}
