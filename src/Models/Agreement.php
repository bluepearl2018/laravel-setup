<?php

namespace Eutranet\Setup\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;
use JetBrains\PhpStorm\ArrayShape;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\Schema;
use Eutranet\Setup\Models\ModelDoc;
use Illuminate\Support\Str;

class Agreement extends Model implements HasMedia
{
    use HasTranslations;
    use InteractsWithMedia;
    use SoftDeletes;

    /**
     * Agreements are UNSIGNED PDF agreement templates
     */
    protected $table = "agreements";
    protected $fillable = ['name', 'description', 'lead', 'general_terms', 'author_id'];
    protected array $translatable = ['name', 'description', 'lead']; // 'general_terms'

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
        return '';
    }

    /**
     * To be able to instantiate the right Model from our laravel-init
     * with the factory() method, we need to add the following
     * method to our model:
     * @return AgreementFactory
     */
    protected static function newFactory(): AgreementFactory
    {
        return AgreementFactory::new();
    }

    public static function getFields()
    {
        // field, type, required, placeholder, tip, model for select
        return [
            'name' => ['input', 'text', 'required', 'Agreement name', 'Enter the agreement name'],
            'lead' => ['input', 'textarea', 'required', 'Intro', 'Enter an intro'],
            'description' => ['input', 'textarea', 'required', 'Description', 'Enter the description'],
            'general_terms' => ['input', 'textarea', 'required', 'General terms', 'Paste the general terms here']
        ];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('agreements');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
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
                'table_name' => (new Agreement())->getTable(),
                'slug' => Str::slug((new Agreement())->getTable()),
                'name' => Str::replace(Str::snake(Str::afterLast(__CLASS__, '\\')), '_', ' '),
                'namespace' => __NAMESPACE__,
                'description' => self::getClassLead(),
                'comment' => null,
                'default_role' => 'admin'
            ]);
        }
    }
}
