<?php

namespace Eutranet\Setup\Http\Controllers;

use Illuminate\Http\Request;
use Eutranet\Setup\Models\User;


/**
 * As an extension of base Crud controller, which is protected by the auth:admin middleware
 * User controller allows appellative management
 */
class UserController extends BaseCrudController
{
	/**
	 * @param User $user
	 */
	public function __construct(User $user)
	{
		$resourceName = 'User';
		$tableName = 'users';
		parent::__construct($user, $resourceName, $tableName);
	}

	/**
	 * @return mixed
	 */
	public function inputStore(Request $request): array
	{
		$rules = [
			'email' => 'email|not_in:users,email',
			'nif' => 'nullable|max:9',
			'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:16',
			'name' => 'string|max:50'
		];
		return $request->validate($rules);
	}

	/**
	 * @return mixed
	 */
	public function inputUpdate(Request $request): array
	{
		$rules = [
			'email' => 'email|not_in:users,email',
			'nif' => 'nullable|max:9',
			'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:16',
			'name' => 'string|max:50'
		];
		return $request->validate($rules);
	}
}
