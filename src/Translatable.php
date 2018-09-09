<?php

namespace Kabbouchi\NovaTranslatable;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Nova;

class Translatable extends Field
{
	/**
	 * Resolve the given attribute from the given resource.
	 *
	 * @param  mixed  $resource
	 * @param  string  $attribute
	 * @return mixed
	 */
	protected function resolveAttribute($resource, $attribute)
	{
		$translations = $resource->translations()->get(['locale', $attribute])->toArray();
		$results = [];
		foreach ( $translations as $translation ) {
			$results[$translation['locale']] = $translation[$attribute];
		}
		return $results;
	}
}