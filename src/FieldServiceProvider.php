<?php

namespace Kabbouchi\NovaTranslatable;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Nova;

class FieldServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Nova::serving(function (ServingNova $event) {
			Nova::script('nova-translatable', __DIR__ . '/../dist/js/field.js');
			Nova::style('nova-translatable', __DIR__ . '/../dist/css/field.css');

			Field::macro('translatable', function ($config = []) {
				if ($this instanceof Text)
					$this->component = 'translatable-text';

				if ($this instanceof Textarea)
					$this->component = 'translatable-textarea';

				$this->withMeta(array_merge([
					'locales'     => config('translatable.locales') ?? ['en' => 'English'],
					'indexLocale' => app()->getLocale()
				], $config));

				return $this;
			});
		});
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}
