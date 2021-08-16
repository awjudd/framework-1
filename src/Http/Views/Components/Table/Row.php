<?php

namespace Haunt\Http\Views\Components\Table;

use Illuminate\View\Component;
use Haunt\Http\Views\Traits\Hover;

class Row extends Component
{
	use Hover;

    /**
     * Create a new component instance.
     *
	 * @param bool $hover
     * @return void
     */
    public function __construct(bool $hover = true)
    {
        $this->hover = $hover;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('haunt-component::table.row');
    }
}
