<?php
namespace Haunt\Http\Views\Traits;

trait FullWidth
{
	/**
	 * Whether the button should be full width.
	 * @var bool
	 */
	public bool $fullWidth;

    /**
     * Apply the full width classes.
     *
     * @param string $full
     * @param string $dense
     * @return string
     */
    public function applyFullWidth(string $full = 'w-full', string $dense = '')
    {
		return $this->fullWidth ? $full : $dense;
    }
}
