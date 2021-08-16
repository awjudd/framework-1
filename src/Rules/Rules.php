<?php
namespace Haunt\Rules;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Rules implements Rule
{
    protected string $keyColumn;
    protected string $rulesColumn;
    protected string $table;

    /**
     * Create a new rule instance.
     *
     * @param string $table
     * @param string $keyColumn
     * @param string $rulesColumn
     * @return void
     */
    public function __construct(string $table, string $keyColumn = 'key', string $rulesColumn = 'rules')
    {
        $this->keyColumn = $keyColumn;
        $this->rulesColumn = $rulesColumn;
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
		$state = DB::table($this->table)->where($this->keyColumn, '=', $attribute)->first();

		if($state->rules === null) {
			return true;
		}

		$validator = Validator::make([$attribute => $value], [
			$attribute => $state->rules
		])->validate();

		return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '';
    }
}
