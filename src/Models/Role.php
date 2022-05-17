<?php

namespace Eutranet\Setup\Models;

use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

/**
 * The Role class is an extension of the original
 * \Spatie\Permission\Models\Role
 * It can be used / called in the role and permissiohs admin part
 * Please note THIS MODEL is called by App/config => permission.php
 */
class Role extends \Spatie\Permission\Models\Role
{
    use HasTranslations;

    /**
     * @var string
     */
    protected $table = 'roles';
    /**
     * @var string[]
     */
    protected $fillable = ['name', 'guard_name', 'description'];

    /**
     * @var array|string[]
     */
    protected array $translatable = ['description'];

    #[ArrayShape(['name' => "string[]", 'guard_name' => "string[]", 'description' => "string[]"])]
    public static function getFields(): array
    {
        // field, type, required, placeholder, tip, model
        return [
            'name' => ['input', 'text', 'required', trans('roles.Name'), trans('roles.Enter the role name')],
            'guard_name' => ['select', 'list', 'required', trans('roles.Guard name'), trans('roles.Select the guard name'), 'Eutranet\Setup\Models\Guard'],
            'description' => ['input', 'textarea', 'optional', trans('roles.Description'), trans('roles.Enter a description')],
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
        return "The roles can have permissions.";
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'name';
    }

    /**
     * @return void
     */
    public static function boot()
    {
        parent::boot();
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
                'table_name' => (new Role())->getTable(),
                'slug' => Str::slug((new Role())->getTable()),
                'name' => Str::replace(Str::snake(Str::afterLast(__CLASS__, '\\')), '_', ' '),
                'namespace' => __NAMESPACE__,
                'description' => self::getClassLead(),
                'comment' => null,
                'default_role' => 'admin'
            ]);
        }
    }
}
