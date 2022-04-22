<?php

namespace Eutranet\Setup\Models;

use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\ArrayShape;
use Spatie\Translatable\HasTranslations;

class Menu extends Model
{

	use HasTranslations;

	protected $table = "menus";
	protected $fillable = [
		'component',
		'name',
		'route_class'
	];
	protected array $translatable = [
		'name'
	];

	#[ArrayShape(['component' => "string[]", 'name' => "string[]", 'route_class' => "string[]"])]
	public static function getFields(): array
	{
		// field, type, required, placeholder, tip, model for select
		return [
			'component' => ['input', 'text', 'required', 'Component', 'Like... users.tabs.nav'],
			'name' => ['input', 'text', 'required', 'Name', 'Enter the name'],
			'route_class' => ['input', 'text', 'required', 'Route class', 'Enter the route class'],
		];
	}

	/**
	 * This static function is essential for the documentation service provider
	 * The namespace is saved into doc_models table
	 * @return string
	 */
	public static function getNamespace(): string
	{
		return __NAMESPACE__;
	}
}
