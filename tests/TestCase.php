<?php

namespace Eutranet\Setup\Tests;

use Eutranet\Setup\Providers\SetupServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
	public function setUp(): void
	{
		parent::setUp();
		// additional laravel-setup
	}

	protected function getPackageProviders($app): array
	{
		return [
			SetupServiceProvider::class,
		];
	}

	protected function getEnvironmentSetUp($app)
	{
		// perform environment laravel-setup
	}
}
