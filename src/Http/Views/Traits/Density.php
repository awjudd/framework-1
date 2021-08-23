<?php
namespace Haunt\Http\Views\Traits;

trait Density
{
    /**
     * Whether this element is dense.
     * @var bool
     */
    public bool $dense;

    /**
     * Apply the density classes.
     *
     * @param string $dense
     * @param string $wide
     * @return string
     */
    public function applyDensity(string $dense, string $wide): string
    {
		return $this->dense ? $dense : $wide;
    }
}
