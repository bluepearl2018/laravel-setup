<?php

namespace Eutranet\Setup\Exceptions;

use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;

class MoreThanOneSuperStaffException extends InvalidArgumentException
{
    #[Pure]
    public static function create(int $countStaffs): static
    {
        return new static("The admin count is `{$countStaffs}`. Not more than one super staff is allowed.`.");
    }
}
