<?php

namespace Haunt\Http\Views\Components;

use Illuminate\View\Component;

class Heading extends Component
{
    /**
     * The level of heading to use.
     * @var int
     */
    public int $level;

    /**
     * Create a new component instance.
     *
     * @param int $level
     * @return void
     */
    public function __construct(int $level)
    {
        $this->level = $level;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('haunt-component::heading');
    }

    /**
     * Apply the level class.
     *
     * @return string
     */
    public function applyLevel(): string
    {
        switch($this->level) {
            case 1: {
                return "text-4xl";
                break;
            }
            case 2: {
                return "text-3xl";
                break;
            }
            case 3: {
                return "text-2xl";
                break;
            }
            case 4: {
                return "text-xl";
                break;
            }
            case 5: {
                return "text-lg";
                break;
            }
            case 6: {
                return "text-base";
                break;
            }
        }
    }
}
