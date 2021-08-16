<?php

namespace Haunt\Http\Views\Components\Table;

use Illuminate\View\Component;

class Actions extends Component
{
	/**
	 * The delete route path.
	 * @var string
	 */
	public string $delete;

	/**
	 * The edit route path.
	 * @var string
	 */
	public string $edit;

	/**
	 * The view route path.
	 * @var string
	 */
	public string $see;

    /**
     * Create a new component instance.
     *
	 * @param string $edit
	 * @param string $delete
	 * @param string $see
     * @return void
     */
    public function __construct(string $edit, string $delete = '', string $see = '')
    {
        $this->delete = $delete;
		$this->edit = $edit;
		$this->see = $see;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('haunt-component::table.actions');
    }
}
