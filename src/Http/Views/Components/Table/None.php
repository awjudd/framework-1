<?php

namespace Haunt\Http\Views\Components\Table;

use Illuminate\View\Component;
use Haunt\Http\Views\Traits\Content;

class None extends Component
{
	use Content;

    /**
     * Create a new component instance.
     *
	 * @param string $content
     * @return void
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('haunt-component::table.none');
    }
}
