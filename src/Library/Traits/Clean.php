<?php
namespace Haunt\Library\Traits;

trait Clean
{
    /**
     * Get the attributes that have been changed since last sync.
     *
     * @return array
     */
    public function getClean(): array
    {
        $clean = [];

        foreach ($this->getAttributes() as $key => $original) {
            if (!$this->originalIsEquivalent($key, $original)) {
                $clean[$key] = $this->getOriginal()[$key] ?? null;
            }
        }

        return $clean;
    }
}
