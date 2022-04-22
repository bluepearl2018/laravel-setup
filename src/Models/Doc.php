<?php

namespace Eutranet\Setup\Models;

use App\Models\Admin\Admin;
use App\Models\Contents\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;
use JetBrains\PhpStorm\ArrayShape;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Translatable\HasTranslations;

/**
 * Dpc class to save documentation pages (Back office)
 * Dpcumentation pages belong to a documentation page category
 * Are taggable.
 */
class Doc extends Model implements HasMedia
{
	use HasTranslations;
	use InteractsWithMedia;
	use HasFactory;
	use HasRoles;
	use SoftDeletes;

	/**
	 * @var string
	 */
	protected $table = "docs";
	/**
	 * @var string[]
	 */
	protected $fillable = ['meta_description', 'slug', 'meta_title', 'title', 'lead', 'body', 'doc_category_id', 'author_type', 'author_id'];
	/**
	 * @var array|string[]
	 */
	protected array $translatable = ['meta_description', 'meta_title', 'title', 'lead', 'body'];

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
	 * @return string[][]
	 */

	#[ArrayShape(['doc_category_id' => "string[]", 'slug' => "string[]", 'title' => "string[]", 'meta_title' => "string[]", 'meta_description' => "string[]", 'lead' => "string[]", 'body' => "string[]"])]
	public function getFields(): array
	{
		// field, type, required, placeholder, tip, model
		return [
			'doc_category_id' => ['select', 'list', 'optinal', 'Document category', 'Selecte the document category', 'Eutranet\Setup\Models\DocCategory'],
			'slug' => ['input', 'text', 'required', 'Doc page slug', 'Enter the slug'],
			'title' => ['input', 'text', 'required', 'Doc page title', 'Enter the title'],
			'meta_title' => ['input', 'text', 'required', 'Doc page SEO title', 'Enter the SEO title (140 chars)'],
			'meta_description' => ['input', 'text', 'required', 'Doc page SEO meta description', 'Enter the SEO title (140 chars)'],
			'lead' => ['input', 'textarea', 'required', 'Doc page lead', 'Doc page Intro'],
			'body' => ['input', 'textarea', 'optional', 'Doc page body', 'Use the text formatter if needed']
		];
	}

	/**
	 * In order to attach images and pdf to docs
	 * Like screenschots...
	 *
	 * @return void
	 */

	public function registerMediaCollections(): void
	{
		$this->addMediaCollection('docs');
	}

	/**
	 * @throws InvalidManipulation
	 */
	public function registerMediaConversions(Media $media = NULL): void
	{
		$this->addMediaConversion('thumb')
			->width(368)
			->height(232)
			->performOnCollections('docs');
	}

	/**
	 * The route key for the model should be the slug
	 *
	 * @return string
	 */
	public function getRouteKeyName(): string
	{
		return 'slug';
	}

	/**
	 * Get the documentation page cateogry where the page belongs to
	 *
	 * @return BelongsTo
	 */
	public function category(): BelongsTo
	{
		return $this->belongsTo(DocCategory::class, 'doc_category_id');
	}

	/**
	 * Get the author of the document, which is an admin
	 *
	 * @return BelongsTo
	 */
	public function author(): BelongsTo
	{
		return $this->belongsTo(Admin::class, 'admin_id');
	}

	/**
	 * Get all tags associated to the dpcument page.
	 *
	 * @return MorphToMany
	 */
	public function tags(): MorphToMany
	{
		return $this->morphToMany(Tag::class, 'taggable');
	}
}
