<?php declare(strict_types=1);
/*
 * This file is part of phpunit/php-text-template.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\Template;

use InvalidArgumentException;

final class RuntimeException extends InvalidArgumentException implements Exception
{
}
