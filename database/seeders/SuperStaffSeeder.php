<?php

namespace Eutranet\Setup\Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Exception;

class SuperStaffSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 * @throws Exception
	 */
	public function run()
	{
		$loginPrefix = 'login@';
		// From the original "Utilizadores" table
		$staffArray =
		[
			[
				'id' => '1',
				'login' => 'login@superstaff',
				'nif' => '123456789',
				'name' => 'Super staff',
				'gender_id' => '1',
				'appellative_id' => '1',
				'first_name' => 'Linda',
				'last_name' => 'Flora',
				'date_of_birth' => NULL,
				'function' => '{"en":"HR Manager"}',
				'address1' => 'At the corporate address',
				'address2' => NULL,
				'postal_code' => '123456-789',
				'city' => 'Oporto',
				'council' => NULL,
				'district' => NULL,
				'country_id' => '183',
				'phone' => '351913296767',
				'email' => 'superstaff@domain.tld',
				'email_verified_at' => NULL,
				'lead' => '{"en":"As the corporate HR Manager..."}',
				'body' => '{"en":"Human resources managers supervise a company or organization\'s hiring process, from recruiting, interviewing, and hiring new staff. They help connect executives with employees, build an employer brand, improve employee engagement, build strategic talent resources plans."}',
        'password' => '$2y$10$zsrMnjDpC0zVk7agH3EGYuzrtDugG0ORhRtYVOGCcNeyIqQE6TGHC',
        'representante' => 'General',
        'is_active' => '1',
        'is_super' => '1',
        'created_at' => '2022-04-16 17:51:23',
        'updated_at' => NULL,
        'deleted_at' => NULL,
        'agency_id' => '1',
],
];


		if (DB::table('staffs')->get()->count() < 1) {
			DB::table('staffs')->insert(
				$staffArray
			);
			$superStaffRole = DB::table('roles')->where('name', 'super-staff')->get();
			if($superStaffRole !== NULL)
			{
				DB::table('model_has_roles')->insert(
					[
						'role_id' => $superStaffRole[0]->id,
						'model_type' => 'Eutranet\Setup\Models\Staff',
						'model_id' => '1'
					]
				);
			}
		}
	}
}