<?php

namespace Haunt\Http\Views\Components\Form;

use Illuminate\View\Component;
use Haunt\Http\Views\Traits\Margin;
use Haunt\Http\Views\Traits\Disabled;

class Input extends Component
{
	use Disabled;
	use Margin;

    /**
     * Create a new component instance.
     *
	 * @param bool $disabled
	 * @param bool $margin
     * @return void
     */
    public function __construct(bool $disabled = false, bool $margin = false)
    {
        $this->disabled = $disabled;
        $this->margin = $margin;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('haunt-component::form.input');
    }
}
