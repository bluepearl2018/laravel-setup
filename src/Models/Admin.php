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
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;

/**
 * The Admin class is meant to describe and save administrators into DB
 * Administrators have a particular role to play, as well as an ad hoc guard.
 * Super admin is always the FIRST ADMIN.
 */
class Admin extends Authenticatable implements HasMedia, MustVerifyEmail
{
	use HasApiTokens, HasFactory, Notifiable;
	use InteractsWithMedia;
	use HasApiTokens;
	use HasFactory;
	use HasArticles;
	use HasRoles;
	use HasPermissions;

	/**
	 * @var string
	 */
	protected string $guard_name = 'admin';

	/**
	 * @var string
	 */
	protected $table = 'admins';

	/**
	 * @var string[]
	 */
	protected $fillable = [
		'name', 'email', 'password', 'is_super'
	];

	/**
	 * @var string[]
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

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
	 * @return void
	 */
	public static function boot()
	{
		parent::boot();
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
