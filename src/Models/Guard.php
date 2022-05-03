<?php

namespace Eutranet\Setup\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

/**
 *
 */
class Guard extends Model
{
    use HasTranslations;

    /**
     * @var string
     */
    protected $table = 'guards';
    /**
     * @var string[]
     */
    protected $fillable = ['slug', 'name', 'description'];
    /**
     * @var array|string[]
     */
    protected array $translatable = ['name', 'description'];

    /**
     * @return void
     */
    public static function boot()
    {
        parent::boot();
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
        return "After you have registered the provider using the provider method, you may switch to the new user provider in your auth.php configuration file. First, define a provider that uses your new driver. https://laravel.com/docs/9.x/authentication";
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
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
                'table_name' => (new Guard())->getTable(),
                'slug' => Str::slug((new Guard())->getTable()),
                'name' => Str::replace(Str::snake(Str::afterLast(__CLASS__, '\\')), '_', ' '),
                'namespace' => __NAMESPACE__,
                'description' => self::getClassLead(),
                'comment' => null,
                'default_role' => 'admin'
            ]);
        }
    }
}
