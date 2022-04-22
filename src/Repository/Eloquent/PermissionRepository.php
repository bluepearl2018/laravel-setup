<?php

namespace Eutranet\Setup\Repository\Eloquent;

use Eutranet\Setup\Repository\BaseRepository;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;
use Illuminate\Database\Eloquent\Builder;
use Eutranet\Setup\Models\Permission;
use Eutranet\Setup\Repository\Interface\EutranetSetupInterface;

class PermissionRepository extends BaseRepository implements EutranetSetupInterface
{

	/**
	 * Permission Repository constructor.
	 *
	 * @param Permission $model
	 */

	#[Pure] public function __construct(Permission $model)
	{
		parent::__construct($model);
	}

	/**
	 * Scope a query to only include popular users.
	 *
	 * @param $guardName
	 * @return Collection
	 */
	public function getByGuardName($guardName): Collection
	{
		return $this->model->where('guard_name', $guardName)->get();
	}
}
