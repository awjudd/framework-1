<?php

namespace Haunt\Http\Views\Components\Form;

use Illuminate\View\Component;

class Delete extends Component
{
    /**
     * The action the delete form should take.
     * @var string
     */
    public string $action;

    /**
     * The alert text to show.
     * @var string
     */
    public string $confirm;

    /**
     * Create a new component instance.
     *
	 * @param string $action
	 * @param string $confirm
     * @return void
     */
    public function __construct(string $action, string $confirm = 'Are you sure you want to delete this resource?')
    {
        $this->action = $action;
        $this->confirm = $confirm;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('haunt-component::form.delete');
    }
}
