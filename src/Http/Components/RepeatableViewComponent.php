<?php
namespace Haunt\Http\Components;

use Livewire\Component;

class RepeatableViewComponent extends Component
{
	/**
	 * The data to pass to the view.
	 * @var array
	 */
	public array $data;

	/**
	 * The unique item index.
	 * @var int
	 */
	public int $index;

	/**
	 * The view to repeat.
	 * @var string
	 */
	public string $view;

    public function mount(string $view, array $data = [], int $index = 0)
    {
        $this->index = $index;
        $this->data = $data;
        $this->view = $view;
    }

	public function render()
	{
        return view($this->view);
	}
}
