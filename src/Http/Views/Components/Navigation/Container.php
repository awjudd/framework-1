<?php
namespace Haunt\Http\Views\Components\Navigation;

use Illuminate\View\Component;

class Container extends Component
{
	/**
	 * The direction to order the navigation items.
	 * @var bool
	 */
	public string $break;

	/**
	 * The direction to order the navigation items.
	 * @var string
	 */
	public string $direction;

	/**
	 * The direction to order the navigation items.
	 * @var bool
	 */
	public bool $inline;

    /**
     * Create a new component instance.
     *
     * @param string $break
     * @param bool $inline
     * @param string $direction
     * @return void
     */
    public function __construct(string $break = '', string $direction = 'h', bool $inline = false)
    {
        $this->break = $break;
        $this->inline = $inline;
        $this->direction = $direction;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render(): \Illuminate\View\View
    {
        return view('haunt-component::navigation.container');
    }

    /**
     * Apply the direction class.
     *
     * @return string
     */
    public function applyDirection(): string
    {
		$break = $this->break === '' ? '' : "{$this->break}:";
		return $this->direction === 'h' ? "{$break}flex-row {$break}space-x-4 {$break}space-y-0" : "{$break}flex-col {$break}space-x-0 {$break}space-y-2";
    }

    /**
     * Apply the direction class.
     *
     * @return string
     */
    public function applyInline(): string
    {
		return $this->inline ? 'inline-flex' : 'flex';
    }
}
