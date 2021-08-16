<?php
namespace Haunt\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class MacroServiceProvider extends ServiceProvider
{
	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot()
	{
        /**
         * Add a "whereLike" condition to the query,
         *
         * @param string|array $attributes
         * @param string|null $searchTerm
         * @return \Illuminate\Database\Eloquent\Builder
         */
        Builder::macro('whereLike', function(string|array $attributes, ?string $searchTerm) {
            $this->where(function(Builder $query) use ($attributes, $searchTerm) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(
                        str_contains($attribute, '.'),
                        function(Builder $query) use ($attribute, $searchTerm) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);

                            $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm) {
                                $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                            });
                        },
                        function (Builder $query) use ($attribute, $searchTerm) {
                            $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                        }
                    );
                }
            });

            return $this;
        });

		// convert boolean
		Collection::macro('convertBoolean', function() {
			return $this->transform(function($value, $key) {
				if(is_bool($value)) {
					return $value ? 'true' : 'false';
				}
				return $value;
			});
		});

		// encode
		Collection::macro('encode', function() {
			return $this->transform(function($value, $key) {
				if(is_array($value)) {
					return $value;
				}
				return utf8_encode($value);
			});
		});

		/**
		 * Add a "randomLetters" option for a string.
		 *
		 * @param int $length
		 * @return string
		 */
		Str::macro('randomLetters', function(int $length) {
			$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		});
	}
}
