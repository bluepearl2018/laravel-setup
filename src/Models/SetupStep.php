<?php

namespace Eutranet\Setup\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Translatable\HasTranslations;
use JetBrains\PhpStorm\ArrayShape;

/**
 * The Setup Step model allows us to save information about the setup process
 *
 */
class SetupStep extends Model implements HasMedia
{

	use InteractsWithMedia;

	/**
	 * @var string
	 */
	protected $table = "setup_steps";
	/**
	 * @var string[]
	 */
	protected $fillable = [
		"setup_process_id",
		"name",
		"description",
		"console_action",
		"console_check",
		"is_complete",
	];

	/**
	 * @var string[]
	 */
	protected $casts = [
		'is_complete' => 'boolean',
	];

	/**
	 * Translatale fields to be used on a laravel-frontend part
	 * @var array
	 */
	protected array $translatable = [
		'name', 'description'
	];

	/**
	 * Get the fields for the form generator.
	 * @return array
	 */
	#[ArrayShape(['setup_process_id' => "array", 'name' => "array", 'description' => "array", 'comment' => "array", 'console_action' => "string[]", 'console_check' => "string[]"])]
	public static function getFields(): array
	{
		return [
			'setup_process_id' => ['select', 'list', 'required', trans('laravel-setup-step.Setup process'), trans('laravel-setup-steps.Select a setup process id from the list'), 'App\Models\Admin\SetupProcess'],
			'name' => ['input', 'text', 'required', trans('laravel-setup-step.Name'), trans('laravel-setup-steps.Enter a name or title for the laravel-setup step.')],
			'description' => ['input', 'textarea', 'required', trans('laravel-setup-step.Description'), trans('laravel-setup-steps.A few lines explanation.')],
			'comment' => ['input', 'textarea', 'optional', trans('laravel-setup-step.Comment'), trans('laravel-setup-steps.Comment for developers.')],
			'console_action' => ['input', 'text', 'optional', 'Console action', 'Enter the console action command'],
			'console_check' => ['input', 'text', 'required', 'Console check', 'Enter the console check command'],
//			'is_complete' => ['checkbox', 'option', 'optional', 'Step is complete', 'Mark as complete'],
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

	/**
	 * @return void
	 */
	public function registerMediaCollections(): void
	{
		$this->addMediaCollection('laravel-setup-steps');
	}
}
