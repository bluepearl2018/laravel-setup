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
use Eutranet\Corporate\Models\Agency;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Support\Str;
use Eutranet\Commons\Models\Gender;
use Eutranet\Corporate\Models\Corporate;
use Eutranet\Corporate\Models\CorporateStaffMember;
use Eutranet\Corporate\Models\StaffTeam;
use Eutranet\Corporate\Models\Team;
use Eutranet\Commons\Models\Appellative;
use Eutranet\Commons\Models\Country;
use Eutranet\Corporate\Models\Consultation;

/**
 * The StaffMember class has all users of the back-office
 * The staff performs all operation on users, sales/leads and consultations.
 * Staff members can have a portfolio of uses (StaffPortfolio)
 * Staff members can take part to a team (StaffTeam)
 *
 */
class StaffMember extends Authenticatable implements HasMedia, MustVerifyEmail
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
    protected $table = "staff_members";

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
        'is_staff',
        'is_super'
    ];
    public array $translatable = ['lead', 'body', 'function'];

    public static function getFields(): array
    {
        return [

            'login' => ['input', 'text', 'required', trans('staff-members.Me'), trans('staff-members.This is not your email, but an internal pattern')],
            'email' => ['input', 'email', 'required', trans('staff-members.Account email'), trans('staff-members.This MUST NOT be deleted or updated')],
            'representante' => ['input', 'text', 'required', trans('staff-members.Representante'), trans('staff-members.Deprecated'), 'readonly'],
            'gender_id' => ['select', 'list', 'required', trans('staff-members.Gender'), trans('staff-members.Select the gender'), 'Eutranet\Commons\Models\Gender'],
            'appellative_id' => ['select', 'list', 'required', trans('staff-members.Appellative'), trans('staff-members.Select the title'), 'Eutranet\Commons\Models\Appellative'],
            'first_name' => ['input', 'text', 'required', trans('staff-members.First Name'), trans('staff-members.Enter a first name')],
            'last_name' => ['input', 'text', 'required', trans('staff-members.Last Name'), trans('staff-members.Enter a last name')],
            'function' => ['input', 'text', 'optional', trans('staff-members.Function'), trans('staff-members.Enter a function')],

            'date_of_birth' => ['dates', 'date', 'required', trans('staff-members.Date of Birth'), trans('staff-members.Select date of birth')],

            'address1' => ['input', 'text', 'required', trans('staff-members.Address First Line'), trans('staff-members.Max. 35 characters"')],
            'address2' => ['input', 'text', 'optional', trans('staff-members.Address Second Line'), trans('staff-members.Max. 35 characters"')],
            'postal_code' => ['input', 'text', 'required', trans('staff-members.Postal code'), trans('staff-members.Enter a postal code')],
            'city' => ['input', 'text', 'required', trans('staff-members.City'), trans('staff-members.Enter a city')],
            'council' => ['input', 'text', 'required', trans('staff-members.Council'), trans('staff-members.Enter a council')],
            'district' => ['input', 'text', 'required', trans('staff-members.District'), trans('staff-members.Enter a district')],

            'country_id' => ['select', 'list', 'required', trans('staff-members.Country'), trans('staff-members.Select a country'), '\Eutranet\Commons\Models\Country'],

            'phone' => ['input', 'phone', 'required', trans('staff-members.Phone'), trans('staff-members.Should be formatted like +351.999123456')],
            'mobile' => ['input', 'phone', 'required', trans('staff-members.Mobile phone'), trans('staff-members.Should be formatted like +351.999123456')],

            'lead' => ['input', 'textarea', 'optional', trans('staff-members.Lead'), trans('staff-members.Enter a short intro')],
            'body' => ['input', 'textarea', 'optional', trans('staff-members.Resume'), trans('staff-members.Entre a kind of resume')],

        ];
    }

    public static function getClassLead(): string
    {
        return 'Staff members';
    }

    /**
     * A media collection to attach images to model docs
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('staff-members');
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
            array('group' => 'staff-members', 'key' => 'This MUST NOT be deleted or updated', 'text' => '{"en":"This MUST NOT be deleted or updated", "pt":"Náo deve ser modificado (ADMIN ONLY)"}'),
            array('group' => 'staff-members', 'key' => 'Enter the user Tax id', 'text' => '{"en":"Enter the user Tax id", "pt":"Indique o NIF"}'),
            array('group' => 'staff-members', 'key' => 'Tax ID', 'text' => '{"en":"StaffMember TAX ID", "pt":"NIF do membro do pessoal"}'),
            array('group' => 'fields', 'key' => 'login', 'text' => '{"en":"Me", "pt":"Me"}'),
            array('group' => 'staff-members', 'key' => 'This is not your email, but an internal pattern', 'text' => '{"en":"This is not your email, but an internal pattern", "pt":"Não é o seu mail."}'),

            // Todo Project specific checks
            array('group' => 'fields', 'key' => 'representante', 'text' => '{"en":"Representante", "pt":"Representante"}'),
            array('group' => 'staff-members', 'key' => 'Deprecated', 'text' => '{"en":"Deprecated", "pt":"Não se applica, certo ?."}'),
            array('group' => 'staff-members', 'key' => 'Select the gender', 'text' => '{"en":"Select the gender", "pt":"Indique o gênero"}'),
            array('group' => 'staff-members', 'key' => 'Select the title', 'text' => '{"en":"Select the title", "pt":"Indique o titulo"}'),
            array('group' => 'fields', 'key' => 'first_name', 'text' => '{"en":"First name", "pt":"Nome proprio"}'),
            array('group' => 'fields', 'key' => 'last_name', 'text' => '{"en":"Last name", "pt":"Nome"}'),
            array('group' => 'staff-members', 'key' => 'Enter a first name', 'text' => '{"en":"Enter a first name", "pt":"Indique o nome proprio"}'),
            array('group' => 'staff-members', 'key' => 'Enter a last name', 'text' => '{"en":"Enter a last name", "pt":"Indique o nome"}'),


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
     * @return StaffMemberFactory
     */
    protected static function newFactory(): StaffMemberFactory
    {
        return StaffMemberFactory::new();
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
     * Get the country where the staff belongs to
     *
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        if (\Illuminate\Support\Facades\Schema::hasTable('model_docs')) {
            ModelDoc::firstOrCreate([
                'table_name' => (new StaffMember())->getTable(),
                'slug' => Str::slug((new StaffMember())->getTable()),
                'name' => Str::replace(Str::snake(Str::afterLast(__CLASS__, '\\')), '_', ' '),
                'namespace' => __NAMESPACE__,
                'description' => self::getClassLead(),
                'comment' => null,
                'default_role' => 'admin'
            ]);
        }
    }
}
