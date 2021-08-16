<?php
namespace Haunt\Http\Views\Traits;

trait Hover
{
	/**
	 * Whether to apply hover classes.
	 * @var bool
	 */
	public bool $hover;

    /**
     * Apply the hover classes.
     *
     * @param string $hover
     * @param string $unhover
     * @return string
     */
    public function applyHover(string $hover, string $unhover = ''): string
    {
		return $this->hover ? $hover : $unhover;
    }
}
