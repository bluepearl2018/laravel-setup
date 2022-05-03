<?php

namespace Eutranet\Setup\Models;

use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;
use JetBrains\PhpStorm\ArrayShape;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

/**
 * GeneralTerm and its table are to store laravel-corporate general terms.
 * This should implement HasMedia in order to retrieve PDF
 */
class GeneralTerm extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = "general_terms";
    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'description',
        'lead',
        'body',
        'admin_id'
    ];

    /**
     * @var array|string[]
     */
    protected array $translatable = [
        'title',
        'description',
        'lead',
        'body'
    ];

    /**
     * @return \string[][]
     */
    #[ArrayShape(['title' => "string[]", 'description' => "string[]", 'lead' => "string[]", 'body' => "string[]", 'file_path' => "string[]"])]
    public static function getFields(): array
    {
        // field, type, required, placeholder, tip, model for select
        return [
            'title' => ['input', 'textarea', 'required', 'Title', 'Enter the title'],
            'description' => ['input', 'textarea', 'required', 'Description', 'Enter the description'],
            'lead' => ['input', 'textarea', 'required', 'Lead', 'Enter the lead / intro'],
            'body' => ['input', 'textarea', 'required', 'Body', 'Enter the body'],
            'file_path' => ['input', 'file', 'optional', 'PDF version', 'Get a PDF from you preferred folder'],
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
     * This static function is essential for the documentation service provider
     * The namespace is saved into doc_models table
     * @return string
     */
    public static function getClassLead(): string
    {
        return 'These general terms and conditions of service and use of "the portal" 
		apply to all operations carried out under the frontend part of the portal.';
    }

    /**
     * Create a media collection for general terms
     * In other words, to attach A pdf or several versions to a genral term item
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('general_terms');
    }

    /**
     * Create a media collection for general terms
     * In other words, to attach A pdf or several versions to a genral term item
     * @return BelongsTo
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
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
                'table_name' => (new GeneralTerm())->getTable(),
                'slug' => Str::slug((new GeneralTerm())->getTable()),
                'name' => Str::replace(Str::snake(Str::afterLast(__CLASS__, '\\')), '_', ' '),
                'namespace' => __NAMESPACE__,
                'description' => self::getClassLead(),
                'comment' => null,
                'default_role' => 'admin'
            ]);
        }
    }
}
