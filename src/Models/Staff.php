<?php

namespace Eutranet\Setup\Models;

use App\Models\User;
use Flash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Schema;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\TranslationLoader\LanguageLine;
use Eutranet\Setup\Traits\HasArticles;
use Spatie\Translatable\HasTranslations;
use Eutranet\Be\Models\Agency;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;

/**
 * The Staff class has all users of the back-office
 * The staff performs all operation on users, sales/leads and consultations.
 * Staff members can have a portfolio of uses (StaffUser)
 * Staff members can take part to a team (StaffTeam)
 *
 */
class Staff extends Authenticatable implements HasMedia, MustVerifyEmail
{
	use HasApiTokens;
	use Notifiable;
	use InteractsWithMedia;
	use HasFactory;
	use SoftDeletes;
	use HasArticles;
	use HasTranslations;
	use HasRoles;
	use HasPermissions;

	// representante should NOT BE USED at all !

	/**
	 * @var string
	 */
	protected $table = "staffs";

	/**
	 * @var string
	 */
	protected string $guard_name = 'staff';

	protected $fillable = [
		'nif',
		'login',
		'gender_id',
		'appellative_id',
		'first_name',
		'last_name',
		'date_of_birth',
		'function',
		'lead',
		'resume',
		'address1',
		'address2',
		'postal_code',
		'city',
		'council',
		'district',
		'country_id',
		'phone',
		'mobile',
		'email',
		'lead',
		'body',
		'country_id',
		'password',
		'agency_id',
		'representante',
		"is_active",
		'is_super'
	];
	public array $translatable = ['lead', 'body', 'function'];

	public static function getFields(): array
	{
		return [
			'nif' => ['input', 'pttaxid', 'required', trans('staffs.Tax ID'), trans('staffs.Enter the user Tax id')],
			'login' => ['input', 'text', 'required', trans('staffs.Login'), trans('staffs.This is not your email, but an internal pattern')],
			'email' => ['input', 'email', 'required', trans('staffs.Account email'), trans('staffs.This MUST NOT be deleted or updated')],
			'representante' => ['input', 'text', 'required', trans('staffs.Representante'), trans('staffs.Deprecated'), 'readonly'],
			'gender_id' => ['select', 'list', 'required', trans('staffs.Gender'), trans('staffs.Select the gender'), 'App\Models\Commons\Gender'],
			'appellative_id' => ['select', 'list', 'required', trans('staffs.Appellative'), trans('staffs.Select the title'), 'App\Models\Commons\Appellative'],
			'first_name' => ['input', 'text', 'required', trans('staffs.First Name'), trans('staffs.Enter a first name')],
			'last_name' => ['input', 'text', 'required', trans('staffs.Last Name'), trans('staffs.Enter a last name')],
			'function' => ['input', 'text', 'optional', trans('staffs.Function'), trans('staffs.Enter a function')],

			'date_of_birth' => ['dates', 'date', 'required', trans('staffs.Date of Birth'), trans('staffs.Select date of birth')],

			'address1' => ['input', 'text', 'required', trans('staffs.Address First Line'), trans('staffs.Max. 35 characters"')],
			'address2' => ['input', 'text', 'optional', trans('staffs.Address Second Line'), trans('staffs.Max. 35 characters"')],
			'postal_code' => ['input', 'text', 'required', trans('staffs.Postal code'), trans('staffs.Enter a postal code')],
			'city' => ['input', 'text', 'required', trans('staffs.City'), trans('staffs.Enter a city')],
			'council' => ['input', 'text', 'required', trans('staffs.Council'), trans('staffs.Enter a council')],
			'district' => ['input', 'text', 'required', trans('staffs.District'), trans('staffs.Enter a district')],

			'country_id' => ['select', 'list', 'required', trans('staffs.Country'), trans('staffs.Select a country'), '\Eutranet\Commons\Models\Country'],

			'phone' => ['input', 'phone', 'required', trans('staffs.Phone'), trans('staffs.Should be formatted like +351.999123456')],
			'mobile' => ['input', 'phone', 'required', trans('staffs.Mobile phone'), trans('staffs.Should be formatted like +351.999123456')],

			'lead' => ['input', 'textarea', 'optional', trans('staffs.Lead'), trans('staffs.Enter a short intro')],
			'body' => ['input', 'textarea', 'optional', trans('staffs.Resume'), trans('staffs.Entre a kind of resume')],

			'agency_id' => ['select', 'list', 'required', 'Agency', 'Select an agency', 'App\Models\Corporate\Agency'],
		];
	}

	public static function getClassLead(): string
	{
		return '';
	}

	/**
	 * A media collection to attach images to model docs
	 * @return void
	 */
	public function registerMediaCollections(): void
	{
		$this->addMediaCollection('staffs');
	}

	/**
	 * @return void
	 */
	public static function boot()
	{

		parent::boot();
		static::saveTranslations();

		static::creating(function ($item) {

		});

		static::created(function ($item) {
			Flash::success('Staff member profile successfully created.');
		});

		static::updating(function ($item) {

		});

		static::updated(function ($item) {
			Flash::success('Staff member profile uccessfully updated.');
		});

		static::deleting(function ($item) {

		});

		static::deleted(function ($item) {
			Flash::success('Staff member profile successfully soft deleted.');
		});
	}

	public static function saveTranslations()
	{

		$lls = array(
			array('group' => 'fields', 'key' => 'nif', 'text' => '{"en":"Tax ID", "pt":"NIF"}'),
			array('group' => 'fields', 'key' => 'appellative_id', 'text' => '{"en":"Appellative", "pt":"Titulo"}'),
			array('group' => 'fields', 'key' => 'gender_id', 'text' => '{"en":"Gender", "pt":"Gênero"}'),
			array('group' => 'fields', 'key' => 'email', 'text' => '{"en":"Email", "pt":"Email"}'),
			array('group' => 'staffs', 'key' => 'This MUST NOT be deleted or updated', 'text' => '{"en":"This MUST NOT be deleted or updated", "pt":"Náo deve ser modificado (ADMIN ONLY)"}'),
			array('group' => 'staffs', 'key' => 'Enter the user Tax id', 'text' => '{"en":"Enter the user Tax id", "pt":"Indique o NIF"}'),
			array('group' => 'staffs', 'key' => 'Tax ID', 'text' => '{"en":"Staff TAX ID", "pt":"NIF do membro do pessoal"}'),
			array('group' => 'fields', 'key' => 'login', 'text' => '{"en":"Login", "pt":"Login"}'),
			array('group' => 'staffs', 'key' => 'This is not your email, but an internal pattern', 'text' => '{"en":"This is not your email, but an internal pattern", "pt":"Não é o seu mail."}'),

			// Todo Project specific checks
			array('group' => 'fields', 'key' => 'representante', 'text' => '{"en":"Representante", "pt":"Representante"}'),
			array('group' => 'staffs', 'key' => 'Deprecated', 'text' => '{"en":"Deprecated", "pt":"Não se applica, certo ?."}'),
			array('group' => 'staffs', 'key' => 'Select the gender', 'text' => '{"en":"Select the gender", "pt":"Indique o gênero"}'),
			array('group' => 'staffs', 'key' => 'Select the title', 'text' => '{"en":"Select the title", "pt":"Indique o titulo"}'),
			array('group' => 'fields', 'key' => 'first_name', 'text' => '{"en":"First name", "pt":"Nome proprio"}'),
			array('group' => 'fields', 'key' => 'last_name', 'text' => '{"en":"Last name", "pt":"Nome"}'),
			array('group' => 'staffs', 'key' => 'Enter a first name', 'text' => '{"en":"Enter a first name", "pt":"Indique o nome proprio"}'),
			array('group' => 'staffs', 'key' => 'Enter a last name', 'text' => '{"en":"Enter a last name", "pt":"Indique o nome"}'),


		);

		if (Schema::hasTable('language_lines')) {
			foreach ($lls as $ll) {
				LanguageLine::firstOrCreate([
					'group' => $ll['group'],
					'key' => $ll['key'],
					'text' => json_decode($ll['text'], true)
				]);
			};
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
	 * To be able to instantiate the right Model from our laravel-init
	 * with the factory() method, we need to add the following
	 * method to our model:
	 * @return StaffFactory
	 */
	protected static function newFactory(): StaffFactory
	{
		return StaffFactory::new();
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

	/**
	 * A staff member belongs to many teams
	 * @return BelongsToMany
	 */
	public function corporate(): BelongsToMany
	{
		return $this->belongsToMany(Corporate::class, CorporateStaff::class);
	}

	/**
	 * A staff member belongs to many teams
	 * @return BelongsToMany
	 */
	public function teams(): BelongsToMany
	{
		return $this->belongsToMany(Team::class, StaffTeam::class);
	}

	/**
	 * Get users in staff portfolio
	 *
	 * @return BelongsToMany
	 */
	public function users(): BelongsToMany
	{
		return $this->belongsToMany(User::class);
	}

	/**
	 * Get staff roles
	 *
	 * @return BelongsTo
	 */
	public function role(): BelongsTo
	{
		return $this->belongsTo(Role::class, 'role_id');
	}

	/**
	 * Get the gender of the staff member
	 *
	 * @return BelongsTo
	 */
	public function appellative(): BelongsTo
	{
		return $this->belongsTo(Appellative::class);
	}

	/**
	 * Get the gender of the staff member
	 *
	 * @return BelongsTo
	 */
	public function gender(): BelongsTo
	{
		return $this->belongsTo(Gender::class);
	}

	/**
	 * Get the agency where the staff belongs to
	 *
	 * @return BelongsTo
	 */
	public function agency(): BelongsTo
	{
		return $this->belongsTo(Agency::class, 'agency_id');
	}

	/**
	 * Get the consultations assigned to a staff member
	 *
	 * @return HasMany
	 */
	public function consultations(): HasMany
	{
		return $this->hasMany(Consultation::class, 'consultant_id');
	}

	/**
	 * Get the country where the staff belongs to
	 *
	 * @return BelongsTo
	 */
	public function country(): BelongsTo
	{
		return $this->belongsTo(Country::class, 'country_id');
	}
}
