<?php

namespace Eutranet\Setup\Repository\Eloquent;

use Eutranet\Setup\Repository\BaseRepository;
use JetBrains\PhpStorm\Pure;
use Eutranet\Setup\Models\Role;
use Eutranet\Setup\Repository\Interface\EutranetSetupInterface;

class RoleRepository extends BaseRepository implements EutranetSetupInterface
{

	/**
	 * Role Repository constructor.
	 *
	 * @param Role $model
	 */

	#[Pure] public function __construct(Role $model)
	{
		parent::__construct($model);
	}

}
