<?php
namespace Haunt\Http\Views\Traits;

trait Inline
{
    /**
     * Whether to display the element inline.
     * @var bool
     */
    public bool $inline;

    /**
     * Apply the inline class.
     *
     * @return string
     */
    public function applyInline(): string
    {
        return $this->inline ? 'inline-block' : 'block';
    }
}
