<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Http\Controllers\LivroController;

class LivroCreate extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $livro;
    public function __construct(Livro $livro)
    {
        $this->livro = $livro;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.livro-create');
    }
}
