<?php
namespace Haunt\Http\Views\Traits;

trait Margin
{
	/**
	 * Whether to show margin on the element.
	 * @var bool
	 */
	public bool $margin;

    /**
     * Apply the margin classes.
     *
     * @param string $margin
     * @param string $noMargin
     * @return string
     */
    public function applyMargin(string $margin = 'mb-4', string $noMargin = '')
    {
        return $this->margin ? $margin : $noMargin;
    }
}
