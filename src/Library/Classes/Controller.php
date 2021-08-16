<?php
namespace Haunt\Library\Classes;

use Haunt\Facades\Haunt;
use Illuminate\Support\Str;
use Haunt\Entities\Models\Plugin;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * The number of resources to show.
     * @var int
     */
    protected int $amount = 20;

    /**
     * The columns to run a search through.
     * @var array<string>
     */
    protected array $columns = [
        //
    ];

    /**
     * The symbols to use while searching.
     * @var array<string>
     */
    private array $symbols = [
        '=',
        '!=',
        '==',
        '>',
        '>=',
        '<',
        '<=',
    ];

    /**
	 * Add search parameters to the query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $q
     * @return void
     */
    public function search(\Illuminate\Database\Eloquent\Builder $q): void
    {
        $query = request()->input('q');

        if(!$query) {
            return;
        }

        $searches = explode(',', $query);

        foreach($searches as $search) {
            $symbol = collect($this->symbols)->filter(function($symbol) use($search) {
                return Str::contains($search, $symbol);
            })->last();

            if(!$symbol) {
                $q->whereLike($this->columns, $search);
            } else {
                [$field, $value] = explode($symbol, $search);
                $value = $value !== 'null' ? $value : $value = null;

                switch ($symbol) {
                    case '=':
                        $q->whereLike($field, $value);
                        break;
                    case '==':
                        $q->where($field, '=', $value);
                        break;
                    default:
                        $q->where($field, $symbol, $value);
                        break;
                }
            }
        }
        return;
    }

	/**
	 * Add sort parameters to the query.
	 *
     * @param \Illuminate\Database\Eloquent\Builder $q
	 * @return void
	 */
    public function sort(\Illuminate\Database\Eloquent\Builder $q): void
    {
        $sorts = explode(',', request()->input('sort'));
        foreach($sorts as $sort) {
            if(Str::contains($sort, '-')) {
                $q->orderBy(Str::after($sort, '-'), 'desc');
            } else {
                $q->orderBy($sort, 'asc');
            }
        }
    }
}
