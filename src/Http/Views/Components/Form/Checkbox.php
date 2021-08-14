<?php

namespace Haunt\Http\Views\Components\Form;

use Illuminate\View\Component;
use Haunt\Http\Views\Traits\Margin;
use Haunt\Http\Views\Traits\Content;

class Checkbox extends Component
{
	use Content;
	use Margin;

	/**
	 * Whether the element is checked.
	 * @var bool
	 */
    public bool $checked;

    /**
     * Create a new component instance.
     *
     * @param bool $checked
     * @param string $content
	 * @param bool $margin
     * @return void
     */
    public function __construct(bool $checked = false, string $content = '', bool $margin = false)
    {
        $this->checked = $checked;
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
        return view('haunt-component::form.checkbox');
    }

	/**
	 * Apply the "content" classes.
	 *
	 * @return string
	 */
	public function applyContent(): string
	{
		return $this->content !== '' ? 'mr-1' : '';
	}
}
