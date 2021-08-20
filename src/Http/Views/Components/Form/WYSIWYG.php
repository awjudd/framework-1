<?php

namespace Haunt\Http\Views\Components\Form;

use Illuminate\View\Component;
use Haunt\Http\Views\Traits\Margin;
use Haunt\Http\Views\Traits\Content;

class WYSIWYG extends Component
{
	use Content;
	use Margin;

    /**
     * Create a new component instance.
     *
     * @param string|null $content
	 * @param bool $margin
     * @return void
     */
    public function __construct(?string $content = null, bool $margin = false)
    {
		$this->content = $content;
        $this->margin = $margin;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('haunt-component::form.wysiwyg');
    }
}
