<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $paginas;

    public function __construct($paginas)
    {
        $this->paginas = $paginas;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.breadcrumb');
    }
}
