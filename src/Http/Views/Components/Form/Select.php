<?php

namespace Haunt\Http\Views\Components\Form;

use Illuminate\View\Component;
use Haunt\Http\Views\Traits\Margin;

class Select extends Component
{
	use Margin;

    /**
     * Create a new component instance.
     *
	 * @param bool $margin
     * @return void
     */
    public function __construct(bool $margin = false)
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
        return view('haunt-component::form.select');
    }
}
