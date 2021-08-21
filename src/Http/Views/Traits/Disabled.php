<?php
namespace Haunt\Http\Views\Traits;

trait Disabled
{
	/**
	 * Whether the element is disabled.
	 * @var bool
	 */
	public bool $disabled;

    /**
     * Apply the disabled classes.
     *
     * @param string $disabled
     * @param string $enabled
     * @return string
     */
    public function applyDisabled(string $disabled = '', string $enabled = '')
    {
        return $this->disabled ? $disabled : $enabled;
    }
}
