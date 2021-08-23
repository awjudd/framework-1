<?php
namespace Haunt\Http\Components;

use Livewire\Component;

class RepeatableComponent extends Component
{
	public array $items;
	public string $view;

    public function mount(string $view)
    {
        $this->view = $view;
    }

	public function render()
	{
        return view('haunt-component::livewire.repeatable');
	}

	public function add()
	{
		$this->items[] = ['test'];
	}
}
