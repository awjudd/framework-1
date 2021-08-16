<?php
namespace Haunt\Rules;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;

class Unique implements Rule
{
	private string $column;
	private string $key;
	private string $table;

    /**
     * Create a new rule instance.
     *
     * @param string $table
     * @param string $column
     * @return void
     */
    public function __construct(string $table, string $key, string $column = 'id')
    {
        $this->column = $column;
        $this->key = $key;
        $this->table = $table;
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
		return DB::table($this->table)
			->where($this->column, '!=', $this->key) // ignore the row that has the supplied key
			->where($attribute, '=', $value) // but check the value against the attribute
			->first() === null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.unique');
    }
}
