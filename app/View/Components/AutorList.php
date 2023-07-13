<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Http\Controllers\AutorController;

class AutorList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $autores;
    public function __construct($autores)
    {
        $this->autores = $autores;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.autor-list');
    }
}
