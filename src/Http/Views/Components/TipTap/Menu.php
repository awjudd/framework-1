<?php

namespace Haunt\Http\Views\Components\TipTap;

use LumiteStudios\LaravelBladeTiptap\Components\TipTapMenu;

class Menu extends TipTapMenu
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('haunt-component::tiptap.menu');
    }
}
