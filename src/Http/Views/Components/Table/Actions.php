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
	public string $deleteIcon;

	/**
	 * The edit route path.
	 * @var string
	 */
	public string $edit;
	public string $editIcon;

	/**
	 * The view route path.
	 * @var string
	 */
	public string $see;
	public string $seeIcon;

    /**
     * Create a new component instance.
     *
	 * @param string $edit
	 * @param string $delete
	 * @param string $see
     * @return void
     */
    public function __construct(string $edit, string $delete = '', string $deleteIcon = 'trash', string $editIcon = 'cog', string $see = '', string $seeIcon = 'eye')
    {
        $this->delete = $delete;
        $this->deleteIcon = $deleteIcon;
		$this->edit = $edit;
		$this->editIcon = $editIcon;
		$this->see = $see;
		$this->seeIcon = $seeIcon;
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
