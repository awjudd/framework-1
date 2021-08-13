<?php
namespace Haunt\Http\Views\Components;

use Illuminate\View\Component;

class Layout extends Component
{
	/**
     * Create the component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render(): \Illuminate\View\View
    {
        return view('haunt-component::layout');
    }
}
