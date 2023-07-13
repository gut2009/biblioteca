<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Http\Controllers\EspiritoController;

class EspiritoList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $espiritos;
    public function __construct($espiritos)
    {
        $this->espiritos = $espiritos;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.espirito-list');
    }
}
