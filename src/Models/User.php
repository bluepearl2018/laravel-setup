<?php

namespace Eutranet\Setup\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\TranslationLoader\LanguageLine;
use Eutranet\Setup\Traits\HasArticles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\ArrayShape;

/**
 * The Admin class is meant to describe and save administrators into DB
 * Administrators have a particular role to play, as well as an ad hoc guard.
 * Super admin is always the FIRST ADMIN.
 */
class User extends \App\Models\User
{
	use Notifiable;
	use InteractsWithMedia;

	/**
	 * @var string
	 */
	protected $table = "users";

	/**
	 * Create a new Eloquent model instance.
	 *
	 * @param  array  $attributes
	 * @return void
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
		$this->mergeFillable([
			'user_status_id',
			'has_accepted_general_terms_on',
			'has_accepted_my_space_general_terms_on',
			'account_deletion_request_received_on',
			'troublemaking_score',
			'is_valid',
			'is_locked',
		]);
	}

	/**
	 * @var string[]
	 */
	protected $casts = [
		'is_valid' => 'boolean',
		'is_locked' => 'boolean',
		'has_accepted_general_terms_on' => 'datetime',
		'has_accepted_my_space_generaL_term_on' => 'datetime',
		'account_deletion_request_received_on' => 'datetime',
	];

	/**
	 * @return \string[][]
	 */
	#[ArrayShape(['email' => "string[]", 'name' => "string[]", 'phone' => "string[]", 'nif' => "string[]", 'country_id' => "string[]"])]
	public static function getFields(): array
	{
		return [
			'email' => ['input', 'email', 'required', 'Account email', 'This MUST NOT be deleted or updated', 'readonly'],
			'name' => ['input', 'text', 'required', 'Account Name', 'This is the account name', 'readonly'],
			'phone' => ['input', 'phone', 'required', 'Phone', 'Enter or update a phone number'],
		];
	}
	
	/**
	 * @return void
	 */
	public static function saveTranslations()
	{
		$lls = array(
			array('group' => 'fields', 'key' => 'name', 'text' => '{"en":"Name", "pt":"Nome"}'),
			array('group' => 'fields', 'key' => 'is_super', 'text' => '{"en":"Is super administrator", "pt":"Super administador ?"}'),
			array('group' => 'fields', 'key' => 'email', 'text' => '{"en":"Email", "pt":"Email"}'),
			array('group' => 'fields', 'key' => 'password', 'text' => '{"en":"Password", "pt":"Palavra-passe"}')
		);
		foreach ($lls as $ll) {
			LanguageLine::firstOrCreate($ll);
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
		return "Administrators ensure the smooth running of the platform, in particular by ensuring its maintenance, but also by managing user privileges, checking logs and debugging.";
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
		if(Schema::hasTable('model_docs'))
		{
			ModelDoc::firstOrCreate([
				'table_name' => (new Admin())->getTable(),
				'slug' => Str::slug((new Admin())->getTable()),
				'name' => Str::replace(Str::snake(Str::afterLast(__CLASS__, '\\')), '_', ' '),
				'namespace' => __NAMESPACE__,
				'description' => self::getClassLead(),
				'comment' => NULL,
				'default_role' => 'admin'
			]);
		}
	}
	/**
	 * Always encrypt the password when it is updated.
	 *
	 * @param $value
	 * @return void
	 */
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = bcrypt($value);
	}

}
