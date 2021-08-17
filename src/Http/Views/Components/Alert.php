<?php

namespace Haunt\Http\Views\Components;

use Illuminate\View\Component;
use Haunt\Http\Views\Traits\Theme;
use Haunt\Http\Views\Traits\Content;

class Alert extends Component
{
	use Content;
    use Theme;

    /**
     * Create a new component instance.
     *
     * @param string $theme
     * @return void
     */
    public function __construct(?string $content = null, string $theme = 'info')
    {
        $this->content = $content;
        $this->theme = $theme;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('haunt-component::alert');
    }
}
