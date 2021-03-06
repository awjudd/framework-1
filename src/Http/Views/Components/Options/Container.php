<?php

namespace Haunt\Http\Views\Components\Options;

use Illuminate\View\Component;

class Container extends Component
{
    public string $buttonText;
    public string $buttonTheme;
    public string $buttonUrl;
    public string $placeholder;
    public bool $showSearch;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $buttonText = '', string $buttonTheme = 'success', string $buttonUrl = '', string $placeholder = 'Search...', bool $showSearch = true)
    {
        $this->buttonText = $buttonText;
        $this->buttonTheme = $buttonTheme;
        $this->buttonUrl = $buttonUrl;
        $this->placeholder = $placeholder;
        $this->showSearch = $showSearch;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('haunt-component::options.container');
    }
}
