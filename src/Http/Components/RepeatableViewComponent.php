<?php
namespace Haunt\Http\Components;

use Livewire\Component;

class RepeatableViewComponent extends Component
{
	public int $index;

	/**
	 * The view to repeat.
	 * @var string
	 */
	public string $view;

    public function mount(int $index = 0, string $view)
    {
        $this->index = $index;
        $this->view = $view;
    }

	public function render()
	{
        return view($this->view);
	}
}
