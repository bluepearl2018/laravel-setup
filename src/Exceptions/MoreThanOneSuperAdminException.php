<?php

namespace Eutranet\Setup\Exceptions;

use Illuminate\Support\Collection;
use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;

class MoreThanOneSuperAdminException extends InvalidArgumentException
{
	#[Pure]
	public static function create(int $countAdmins): static
	{
		return new static("The admin count is `{$countAdmins}`. Not more than one super admin is allowed.`.");
	}
}
