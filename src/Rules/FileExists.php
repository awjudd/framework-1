<?php
namespace Haunt\Rules;

use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Validation\Rule;

class FileExists implements Rule
{
    protected string $driver;

    /**
     * Create a new rule instance.
     *
     * @param string $driver
     * @return void
     */
    public function __construct(string $driver = 'local')
    {
        $this->driver = $driver;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
		return Storage::disk($this->driver)->exists($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.file_exists');
    }
}
