<?php
namespace Haunt\Http\Views\Components\Form;

use Illuminate\View\Component;
use Haunt\Http\Views\Traits\Inline;

class Label extends Component
{
	use Inline;

    /**
     * Create a new component instance.
     *
     * @param bool $inline
     * @return void
     */
    public function __construct(bool $inline = false)
    {
        $this->inline = $inline;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('haunt-component::form.label');
    }
}
