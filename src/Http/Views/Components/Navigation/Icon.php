<?php
namespace Haunt\Http\Views\Components\Navigation;

use Illuminate\View\Component;
use Haunt\Http\Views\Traits\Active;

class Icon extends Component
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
     * @return \Illuminate\View\View
     */
    public function render(): \Illuminate\View\View
    {
        return view('haunt-component::navigation.icon');
    }
}
