<?php
namespace Haunt\Library\Classes;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection= 'haunt';

	/**
	 * The "booting" method of the model.
	 *
	 * @return void
	 */
	protected static function boot()
	{
		parent::boot();
		Model::unguard();
		Model::preventLazyLoading();
	}

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
