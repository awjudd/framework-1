<?php
namespace Haunt\Library\Classes;

abstract class Observer
{
	/**
	 * Listen to the creating event.
	 *
	 * @param object $model   The model to use with this event.
	 * @return void
	 */
	public function creating(object $model)
	{
		$this->cleanse($model);
	}

	/**
	 * Listen to the updating event.
	 *
	 * @param object $model   The model to use with this event.
	 * @return void
	 */
	public function updating(object $model)
	{
		$this->cleanse($model);
	}


	/**
	 * Cleanse the provided attributes.
	 *
	 * @param object $model
	 * @return object $model
	*/
	private function cleanse(object $model): object
	{
		return $this->stripHtml($this->purifyHtml($model));
	}

	/**
	 * Clean the Html.
	 *
	 * @param object $model
	 * @return object $model
	 */
	private function purifyHtml(object $model): object
	{
		$attributes = $this->getPurifyAttributes();

		foreach($attributes as $a) {
			if(isset($model->$a)) {
				$purify = new Purify();
				$model->$a = $purify->clean($model->$a);
			}
		}

		return $model;
	}

	/**
	 * Remove all the HTML.
	 *
	 * @param object $model
	 * @return object $model
	 */
	private function stripHtml(object $model): object
	{
		$attributes = $this->getStripAttributes();

		foreach($attributes as $a) {
			if(isset($model->$a)) {
				$model->$a = strip_tags($model->$a);
			}
		}

		return $model;
	}

	/**
	 * Get the attributes to purify, e.g. allow certain HTML.
	 *
	 * @return array<string>
	 */
	abstract public function getPurifyAttributes(): array;

	/**
	 * Get the attributes to strip e.g. remove all HTML.
	 *
	 * @return array<string>
	 */
	abstract public function getStripAttributes(): array;
}
