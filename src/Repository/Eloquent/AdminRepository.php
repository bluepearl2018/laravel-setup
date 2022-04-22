<?php

namespace Eutranet\Setup\Repository\Eloquent;

use JetBrains\PhpStorm\Pure;
use Eutranet\Setup\Repository\BaseRepository;
use Eutranet\Setup\Models\Admin;
use Eutranet\Setup\Exceptions\MoreThanOneSuperAdminException;
use Eutranet\Setup\Repository\Interface\EutranetSetupInterface;

class AdminRepository extends BaseRepository implements EutranetSetupInterface
{

	/**
	 * Agency Repository constructor
	 *
	 * @param Admin $model
	 */

	#[Pure] public function __construct(Admin $model)
	{
		parent::__construct($model);
	}

	/**
	 * Verify if the admins table has a superadmin
	 */
	public function hasSuperAdmin(): bool
	{
		return $this->model->where('is_super', true)->get()->first() !== NULL;
	}

	/**
	 * Verify if the admins table has a superadmin
	 */
	public function hasCorporate(): bool
	{
		return $this->model->where('is_super', true)->get()->first() !== NULL;
	}

	/**
	 *Throw an error if there is more than one super admin in the DB
	 */
	public function countSuperAdmin()
	{
		if ($this->model->where('is_super', true)->get()->count() > 1) {
			throw new MoreThanOneSuperAdminException($this->model->where('is_super', true)->get()->count());
		}
	}
}
