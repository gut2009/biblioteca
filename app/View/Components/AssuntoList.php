<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Http\Controllers\AssuntoController;


class AssuntoList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $assuntos;
    public function __construct($assuntos)
    {
        $this->assuntos = $assuntos;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.assunto-list');
    }
}
