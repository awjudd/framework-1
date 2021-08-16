<?php
namespace Haunt\Http\Views\Components\Form;

use Illuminate\View\Component;
use Haunt\Http\Views\Traits\Content;

class Description extends Component
{
	use Content;

    /**
     * Create a new component instance.
     *
     * @param string|null $content
     * @return void
     */
    public function __construct(?string $content = null)
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
        return view('haunt-component::form.description');
    }
}
