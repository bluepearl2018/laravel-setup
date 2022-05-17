<?php

namespace Eutranet\Setup\Models;

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
use Spatie\Translatable\HasTranslations;
use Spatie\Permission\Traits\HasRoles;
use Str;
use Illuminate\Support\Facades\Schema;
use Eutranet\Frontend\Models\Tag;

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
     * @return string[][]
     */

    #[ArrayShape(['doc_category_id' => "string[]", 'slug' => "string[]", 'title' => "string[]", 'meta_title' => "string[]", 'meta_description' => "string[]", 'lead' => "string[]", 'body' => "string[]"])]
    public static function getFields(): array
    {
        // field, type, required, placeholder, tip, model
        return [
            'doc_category_id' => ['select', 'list', 'optinal', trans('documentations.Document category'), trans('documentations.Select the document category', 'Eutranet\Setup\Models\DocCategory')],
            'slug' => ['input', 'text', 'required', trans('documentations.Doc page slug'), trans('documentations.Enter the slug')],
            'title' => ['input', 'text', 'required', trans('documentations.Doc page title'), trans('documentations.Enter the title')],
            'meta_title' => ['input', 'text', 'required', trans('documentations.Doc page SEO title'), trans('documentations.Enter the SEO title (140 chars)')],
            'meta_description' => ['input', 'text', 'required', trans('documentations.Doc page SEO meta description'), trans('documentations.Enter the SEO title (140 chars)')],
            'lead' => ['input', 'textarea', 'required', trans('documentations.Doc page lead'), trans('documentations.Doc page Intro')],
            'body' => ['input', 'textarea', 'optional', trans('documentations.Doc page body'), trans('documentations.Use the text formatter if needed')]
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
     * @return string
     */
    public static function getClassLead(): string
    {
        return "The software documentation.";
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
    public function registerMediaConversions(Media $media = null): void
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

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        if (Schema::hasTable('model_docs')) {
            ModelDoc::firstOrCreate([
                'table_name' => (new Doc())->getTable(),
                'slug' => Str::slug((new Doc())->getTable()),
                'name' => Str::replace(Str::snake(Str::afterLast(__CLASS__, '\\')), '_', ' '),
                'namespace' => __NAMESPACE__,
                'description' => self::getClassLead(),
                'comment' => null,
                'default_role' => 'admin'
            ]);
        }
    }
}
