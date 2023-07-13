<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Http\Controllers\EditoraController;

class EditoraList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $editoras;
    public function __construct($editoras)
    {
        $this->editoras = $editoras;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.editora-list');
    }
}
