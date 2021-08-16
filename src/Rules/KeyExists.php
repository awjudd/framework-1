<?php
namespace Haunt\Rules;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;

class KeyExists implements Rule
{
    protected string $column;
    protected string $table;

    /**
     * Create a new rule instance.
     *
     * @param string $table
     * @param string $column
     * @return void
     */
    public function __construct(string $table, string $column = 'key')
    {
        $this->column = $column;
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
		$attribute = Str::afterLast($attribute, '.');
		return DB::table($this->table)->where($this->column, '=', $attribute)->first() !== null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.key_exists', ['column' => $this->column, 'table' => $this->table]);
    }
}
