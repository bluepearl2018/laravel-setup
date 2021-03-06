<?php

namespace Eutranet\Setup\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\HasMedia as HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;
use Eutranet\Frontend\Models\Tag;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Doc Category class to save documentation page categories (Back office)
 * Doc categories have many Page class
 * Are taggable.
 */
class DocCategory extends Model implements HasMedia
{
    use HasTranslations;
    use InteractsWithMedia;
    use HasFactory;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = "doc_categories";
    /**
     * @var string[]
     */
    protected $fillable = ['meta_description', 'parent_id', 'meta_keywords', 'meta_title', 'slug',
        'title', 'lead', 'body', 'author_type', 'author_id'];
    /**
     * @var array|string[]
     */
    protected array $translatable = ['meta_description', 'meta_keywords', 'meta_title', 'title', 'lead', 'body'];

    /**
     * @return string[][]
     */
    #[ArrayShape(['slug' => "string[]", 'parent_id' => "array", 'meta_description' => "string[]", 'meta_title' => "string[]", 'title' => "string[]", 'lead' => "string[]", 'body' => "string[]"])] public static function getFields(): array
    {
        // field, type, required, placeholder, tip, model
        return [
            'slug' => ['input', 'text', 'required', trans('documentation-categories.Doc page slug'), trans('documentation-categories.Enter the slug')],
            'parent_id' => ['select', 'list', 'optinal', trans('documentation-categories.Document category'), trans('documentation-categories.Select the document category'), __CLASS__],
            'meta_description' => ['input', 'text', 'required', trans('documentation-categories.Doc page SEO meta description'), trans('documentation-categories.Enter the SEO title (140 chars)')],
            'meta_title' => ['input', 'text', 'required', trans('documentation-categories.Doc page SEO title'), trans('documentation-categories.Enter the SEO title (140 chars)')],
            'title' => ['input', 'text', 'required', trans('documentation-categories.Doc page title'), trans('documentation-categories.Enter the title')],
            'lead' => ['input', 'textarea', 'required', trans('documentation-categories.Doc page lead'), trans('documentation-categories.Doc page Intro')],
            'body' => ['input', 'textarea', 'optional', trans('documentation-categories.Doc page body'), trans('documentation-categories.Use the text formatter if needed')],
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
        return "The documentation categories where the software documentation belongs to.";
    }

    /**
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('doc-categories');
        // ->useFallbackUrl('/images/undefined-doc-category.jpg')
        // ->useFallbackPath(public_path('/images/undefined-doc-category.jpg'));
    }

    /**
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->performOnCollections('doc-categories');
    }

    /**
     * Get the children
     *
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(DocCategory::class, 'parent_id')->with('children');
    }

    /**
     * Get the parent.
     *
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(DocCategory::class, 'parent_id');
    }

    /**
     * Get the docs for the category.
     *
     * @return HasMany
     */
    public function docs(): HasMany
    {
        return $this->hasMany(Doc::class, 'doc_category_id');
    }

    /**
     * The route key for the model should be a slug.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the author of the document category, which is an admin
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    /**
     * Get all tags for the docCategory.
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
                'table_name' => (new DocCategory())->getTable(),
                'slug' => Str::slug((new DocCategory())->getTable()),
                'name' => Str::replace(Str::snake(Str::afterLast(__CLASS__, '\\')), '_', ' '),
                'namespace' => __NAMESPACE__,
                'description' => self::getClassLead(),
                'comment' => null,
                'default_role' => 'admin'
            ]);
        }
    }
}
