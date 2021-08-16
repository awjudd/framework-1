<?php
namespace Haunt\Http\Views\Components;

use Illuminate\View\Component;

class Screen extends Component
{
	/**
	 * The title of the page.
	 * @var string|null
	 */
	public ?string $title;

	/**
     * Create the component instance.
     *
	 * @param string|null $title
     * @return void
     */
    public function __construct(?string $title = null)
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render(): \Illuminate\View\View
    {
        return view('haunt-component::screen');
    }
}
