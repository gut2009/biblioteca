<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Http\Controllers\LocalController;

class LocalList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $locais;
    public function __construct($locais)
    {
        $this->locais = $locais;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.local-list');
    }
}
