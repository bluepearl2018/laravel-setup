<?php

namespace Eutranet\Setup\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes as SoftDeletes;
use JetBrains\PhpStorm\ArrayShape;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;
use Eutranet\Setup\Models\Staff;
use Illuminate\Support\Facades\Schema;

/**
 * Emails are not messages.
 * Emails are for the WEBSITE, FRONTEND PART, FOR THE AUTHENTICATED USERS
 * Messages are for the BACKOFFICE and AUTHED PART
 *
 */
class Email extends Model implements HasMedia
{
	use InteractsWithMedia;

	// Has Medias, PDF, images...

	use HasRoles;
	use SoftDeletes;

	protected $table = "emails";

	protected $fillable = [
		'from',
		'to',
		'subject',
		'message_body',
		'staff_id',
		'user_id',
		'file_path'
	];

	#[ArrayShape(['subject' => "string[]", 'message_body' => "string[]", 'file_path' => "string[]"])]
	public static function getFields(): array
	{
		// field, type, required, placeholder, tip, model for select
		return [
			'subject' => ['input', 'text', 'required', 'Subject', 'Enter the email subject'],
			'message_body' => ['input', 'textarea', 'required', 'Message', 'Enter the message body'],
			'file_path' => ['input', 'file', 'optional', 'ZIP file, with documents', 'Attach a single document or a zip']
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
	 * Returns the message user wno created the email. Can be null
	 * @return BelongsTo
	 *
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * Returns the message staff member wno created the email. Can be null
	 * @return BelongsTo|null
	 *
	 */
	public function staff(): BelongsTo|null
	{
		if (Schema::hasTable('staffs')) {
			return $this->belongsTo(Staff::class);
		}
		return NULL;
	}
}
