<?php

namespace App\View\Components\StatsCard;

use Illuminate\View\Component;

class Index extends Component
{

    /**
     * The Background Color.
     *
     * @var string
     */
    public $color;

    /**
     * The Stats Card Title.
     *
     * @var string
     */
    public $title;

    /**
     * The Stats Card Number.
     *
     * @var int
     */
    public $number;

    /**
     * The Stats Card Route to Page.
     *
     * @var int
     */
    public $route;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($color, $title, $number, $route)
    {
        $this->color = $color;
        $this->title = $title;
        $this->number = $number;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.stats-card.index');
    }
}
