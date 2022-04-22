<?php

namespace Eutranet\Setup\Models;

use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\ArrayShape;

/**
 *
 */
class SetupProcess extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'setup_processes';
	/**
	 * @var string[]
	 */
	protected $fillable = ['name', 'description', 'comment', 'started', 'is_complete'];
	/**
	 * @var string[]
	 */
	protected $casts = [
		'is_complete' => 'boolean'
	];

	/**
	 * Get the fields for the generator
	 * @return array
	 */
	#[ArrayShape(['name' => "array", 'description' => "array", 'comment' => "array", 'console_action' => "string[]", 'console_check' => "string[]"])]
	public static function getFields(): array
	{
		return [
			'name' => ['input', 'text', 'required', trans('laravel-setup-process.Name'), trans('laravel-setup-process.Enter a name or title for the laravel-setup step.')],
			'description' => ['input', 'textarea', 'required', trans('laravel-setup-process.Description'), trans('laravel-setup-processs.A few lines explanation.')],
			'comment' => ['input', 'textarea', 'optional', trans('laravel-setup-process.Comment'), trans('laravel-setup-processs.Comment for developers.')],
			'console_action' => ['input', 'text', 'optional', 'Console action', 'Enter the console action command'],
			'console_check' => ['input', 'text', 'required', 'Console check', 'Enter the console check command'],

//			'started' => ['checkbox', 'option', 'optional', trans('laravel-setup-process.Process is started'), trans('laravel-setup-process.Check if started')],
//			'is_complete' => ['checkbox', 'option', 'optional', trans('laravel-setup-process.Step is complete'), trans('laravel-setup-process.Check if complete')],
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
