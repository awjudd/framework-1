<?php

namespace Haunt\Http\Views\Components\Navigation;

use Illuminate\View\Component;
use Haunt\Http\Views\Traits\Active;

class Text extends Component
{
    use Active;

    /**
     * Create a new component instance.
     *
     * @param bool $active
     * @return void
     */
    public function __construct(bool $active = false)
    {
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('haunt-component::navigation.text');
    }
}
