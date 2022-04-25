<?php

namespace Eutranet\Setup\Models;

use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\ArrayShape;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ModelDoc extends Model
{

	protected $table = "model_docs";
	protected $fillable = [
		'table_name',
		'slug',
		'name',
		'namespace',
		'description',
		'comment',
		'default_role',
		'author_type',
		'author_id'
	];

	/**
	 * This static function is essential for the documentation service provider
	 * The namespace is saved into doc_models table
	 * @return string
	 */
	public static function getNamespace(): string
	{
		return __NAMESPACE__;
	}

	public static function getClassLead(): string
	{
		return "The model documentation table is used to generate a lot of resources automatically.";
	}

	/**
	 * A media collection to attach images to model docs
	 * @return void
	 */
	public function registerMediaCollections(): void
	{
		$this->addMediaCollection('model-docs');
	}

	#[ArrayShape(['table_name' => "string[]", 'slug' => "string[]", 'name' => "string[]", 'namespace' => "string[]", 'description' => "string[]", 'comment' => "string[]", 'body' => "string[]"])]
	public function getFields(): array
	{
		// field, type, required, placeholder, tip, model for select
		return [
			// TODO : check which one are needed
			'table_name' => ['input', 'text', 'required', 'Table name', 'Enter the table name'],
			'slug' => ['input', 'text', 'required', 'Slug', 'Enter the slug (max. 255 chars)'],
			'name' => ['input', 'text', 'required', 'Name', 'Enter the name'],
			'namespace' => ['input', 'text', 'required', 'Namespace', 'Enter the namespace'],
			'description' => ['input', 'textarea', 'required', 'Description', 'Enter the a description'],
			'comment' => ['input', 'textarea', 'required', 'Lead', 'Enter the lead / intro'],
			'body' => ['input', 'textarea', 'required', 'Body', 'Enter the body'],
		];
	}

	/**
	 * The "booted" method of the model.
	 *
	 * @return void
	 */
	protected static function booted()
	{
		if(Schema::hasTable('model_docs'))
		{
			ModelDoc::firstOrCreate([
				'table_name' => (new ModelDoc())->getTable(),
				'slug' => Str::slug((new ModelDoc())->getTable()),
				'name' => Str::replace(Str::snake(Str::afterLast(__CLASS__, '\\')), '_', ' '),
				'namespace' => __NAMESPACE__,
				'description' => self::getClassLead(),
				'comment' => NULL,
				'default_role' => 'admin',
			]);
		}
	}
}