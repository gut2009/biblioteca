<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Http\Controllers\EmprestimoController;

class EmprestimoList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $emprestimos;
    public function __construct($emprestimos)
    {
        $this->emprestimos = $emprestimos;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.emprestimo-list');
    }
}
