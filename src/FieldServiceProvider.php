<?php

namespace Kabbouchi\NovaTranslatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
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
				/** @var Field $field */
				$field = $this;
				if ($field instanceof Text)
					$field->component = 'translatable-text';

				if ($field instanceof Textarea)
					$field->component = 'translatable-textarea';

				$field->withMeta(array_merge([
					'locales'     => config('translatable.locales') ?? ['en' => 'English'],
					'indexLocale' => app()->getLocale()
				], $config));


				$field->resolveUsing (function ($value) use ($field) {
					/** @var  NovaRequest $request */
					$request = resolve(NovaRequest::class);
					return $request->findResourceOrFail()->getTranslations($field->attribute);
				});

				return $field;
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
