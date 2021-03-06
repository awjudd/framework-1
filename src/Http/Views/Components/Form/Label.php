<?php
namespace Haunt\Http\Views\Components\Form;

use Illuminate\View\Component;
use Haunt\Http\Views\Traits\Inline;
use Haunt\Http\Views\Traits\Content;

class Label extends Component
{
	use Content;
	use Inline;

    /**
     * Create a new component instance.
     *
     * @param string|null $content
     * @param bool $inline
     * @return void
     */
    public function __construct(?string $content = null, bool $inline = false)
    {
        $this->content = $content;
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
