<?php

namespace Haunt\Http\Views\Components\Card;

use Illuminate\View\Component;
use Haunt\Http\Views\Traits\Margin;

class Container extends Component
{
	use Margin;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(bool $margin = true)
    {
        $this->margin = $margin;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('haunt-component::card.container');
    }
}
