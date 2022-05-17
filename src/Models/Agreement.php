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
use Spatie\TranslationLoader\LanguageLine;

/**
 *
 */
class Agreement extends Model implements HasMedia
{
    use HasTranslations;
    use InteractsWithMedia;
    use SoftDeletes;

    /**
     * Agreements are UNSIGNED PDF agreement templates
     */
    protected $table = "agreements";
	/**
	 * @var string[]
	 */
	protected $fillable = ['name', 'description', 'lead', 'general_terms', 'author_id'];
	/**
	 * @var array|string[]
	 */
	protected array $translatable = ['name', 'description', 'lead']; // 'general_terms'


	/**
	 * @return array[]
	 */
	public static function getFields()
	{
		// field, type, required, placeholder, tip, model for select
		return [
			'name' => ['input', 'text', 'required', trans('agreements.Agreement name'), trans('agreements.Enter the agreement name')],
			'lead' => ['input', 'textarea', 'required', trans('agreements.Intro'), trans('agreements.Enter an intro')],
			'description' => ['input', 'textarea', 'required', trans('agreements.Description'), trans('agreements.Enter the description')],
			'general_terms' => ['input', 'textarea', 'required', trans('agreements.General terms'), trans('agreements.Paste the general terms here')]
		];
	}

	/**
	 * @return void
	 */
	public static function saveTranslations()
	{
		$lls = array(
			array('group' => 'fields', 'key' => 'name', 'text' => '{"en":"Name", "pt":"Nome", "fr":"Nom"}'),
			array('group' => 'fields', 'key' => 'lead', 'text' => '{"en":"Lead", "pt":"Intro", "fr":"Intro"}'),
			array('group' => 'fields', 'key' => 'description', 'text' => '{"en":"Description", "pt":"Description", "fr":"Description"}'),
			array('group' => 'fields', 'key' => 'general_terms', 'text' => '{"en":"General Terms", "pt":"Condições gerais", "fr":"Conditions générales"}'),

		);
		if (\Schema::hasTable('language_lines')) {
			foreach ($lls as $ll) {
				if(! LanguageLine::where([
					'group' => $ll['group'],
					'key' => $ll['key']
				])->get()->first())
				{
					LanguageLine::create([
						'group' => $ll['group'],
						'key' => $ll['key'],
						'text' => json_decode($ll['text'], true)
					]);
				};
			}
		}
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


	/**
	 * @return void
	 */
	public function registerMediaCollections(): void
    {
        $this->addMediaCollection('agreements');
    }

	/**
	 * @return BelongsTo
	 */
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
		static::saveTranslations();
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
