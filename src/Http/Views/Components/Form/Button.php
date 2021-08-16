<?php

namespace Haunt\Http\Views\Components\Form;

use Illuminate\View\Component;
use Haunt\Http\Views\Traits\Theme;
use Haunt\Http\Views\Traits\Content;
use Haunt\Http\Views\Traits\FullWidth;

class Button extends Component
{
	use Content;
	use FullWidth;
    use Theme;

    /**
     * Create a new component instance.
     *
     * @param string|null $content
     * @param bool $fullWidth
     * @param string $theme
     * @return void
     */
    public function __construct(?string $content = null, bool $fullWidth = false, string $theme = 'info')
    {
        $this->content = $content;
        $this->fullWidth = $fullWidth;
        $this->theme = $theme;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('haunt-component::form.button');
    }
}
