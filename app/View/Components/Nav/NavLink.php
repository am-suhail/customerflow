<?php

namespace App\View\Components\Nav;

use Illuminate\View\Component;

class NavLink extends Component
{
    /**
     * The Nav Link Route Name.
     *
     * @var string
     */
    public $route;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route)
    {
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.nav.nav-link');
    }
}
