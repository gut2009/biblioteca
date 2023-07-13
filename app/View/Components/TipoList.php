<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Http\Controllers\TipoController;

class TipoList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $tipos;
    public function __construct($tipos)
    {
        $this->tipos = $tipos;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tipo-list');
    }
}
