<?php

namespace JohnDoe\BlogPackage\Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Eutranet\Setup\Tests\TestCase;

class InstallPackageTest extends TestCase
{
	/** @test */
	function the_install_command_copies_the_configuration()
	{
		// make sure we're starting from a clean state
		if (File::exists(config_path('eutranet-laravel-setup-laravel-init.php'))) {
			unlink(config_path('eutranet-laravel-setup-laravel-init.php'));
		}

		$this->assertFalse(File::exists(config_path('eutranet-laravel-setup-laravel-init.php')));

		Artisan::call('eutranet:laravel-setup-install');

		$this->assertTrue(File::exists(config_path('eutranet-laravel-setup-laravel-init.php')));
	}
}
