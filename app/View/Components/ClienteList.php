<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Http\Controllers\ClienteController;

class ClienteList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $clientes;
    public function __construct($clientes)
    {
        $this->clientes = $clientes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cliente-list');
    }
}
