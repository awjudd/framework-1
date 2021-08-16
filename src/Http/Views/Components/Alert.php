<?php

namespace Haunt\Http\Views\Components;

use Illuminate\View\Component;
use Haunt\Http\Views\Traits\Theme;

class Alert extends Component
{
    use Theme;

    /**
     * Create a new component instance.
     *
     * @param string $theme
     * @return void
     */
    public function __construct(string $theme = 'info')
    {
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
