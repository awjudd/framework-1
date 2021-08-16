<?php

namespace Haunt\Http\Views\Components\Table;

use Illuminate\View\Component;
use Haunt\Http\Views\Traits\Type;
use Haunt\Http\Views\Traits\Content;

class Column extends Component
{
	use Content;
    use Type;

	/**
	 * The width of the element.
	 * @var string
	 */
    public string $width;

    /**
     * Create a new component instance.
     *
     * @param string|null $content
     * @param string $type
     * @param string $width
     * @return void
     */
    public function __construct(?string $content = null, string $type = 'data', string $width = 'px')
    {
        $this->content = $content;
        $this->type = $type;
        $this->width = $width;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('haunt-component::table.column');
    }

	/**
	 * Apply the type.
	 *
	 * @return string
	 */
	public function applyType(): string
	{
        switch($this->type) {
            case 'head': {
                return "border-b-0 w-{$this->width} dark:border-gray-900";
                break;
            }
            default: {
                return "text-left dark:border-gray-750";
            }
        }
	}
}
