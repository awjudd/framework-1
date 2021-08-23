<?php
namespace Haunt\Http\Components;

use Livewire\Component;

class RepeatableComponent extends Component
{
	/**
	 * The items created.
	 * @var array
	 */
	public array $items = [];

	/**
	 * The title of the component.
	 * @var string|null
	 */
	public ?string $title;

	/**
	 * The view to repeat.
	 * @var string
	 */
	public string $view;

    public function mount(string $view, array $items = [], ?string $title = null)
    {
        $this->items = collect($items)->map(function($item, $key) {
			$item['id'] = 'item-'.$key;
			return $item;
		})->toArray();
        $this->title = $title;
        $this->view = $view;
    }

	public function render()
	{
        return view('haunt-component::livewire.repeatable');
	}

	public function addItem()
	{
		$this->items[] = ['id' => 'item-'.count($this->items)];
	}

	public function removeItem(int $index)
	{
		unset($this->items[$index]);
	}

	public function moveUp(int $index)
	{
		$this->moveElement($index, $index-1);
	}

	public function moveDown(int $index)
	{
		$this->moveElement($index, $index+1);
	}

	private function moveElement($start, $end) {
		$out = array_splice($this->items, $start, 1);
		array_splice($this->items, $end, 0, $out);
	}
}
