<?php

namespace Eutranet\Setup\Database\Seeders;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Eutranet\Setup\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $this->seedDefaultRoles();
    }

    private static function seedDefaultRoles()
    {
        if (Schema::hasTable('roles')) {
            $roles = [
                array(
                    'name' => 'super-admin',
                    'guard_name' => 'admin',
                    'description' => '{"en":"Super administrator role.", "pt":"Super administrador", "fr":"Super administrateur"}',
                ),
                array(
                    'name' => 'data-officer',
                    'guard_name' => 'admin',
                    'description' => '{"en":"GDPR Data officer role.", "pt":"GDPR Data officer", "fr":"Délégué aux données RGPD"}',
                ),
                array(
                    'name' => 'backend-admin',
                    'guard_name' => 'admin',
                    'description' => '{"en":"General manager", "pt":"Director geral", "fr":"Directeur général"}',
                ),
                array(
                    'name' => 'content-manager',
                    'guard_name' => 'admin',
                    'description' => '{"en":"Content Manager / Translator.", "pt":"Gestor de conteudos / Traductor", "fr":"Gestionnaire de contenus / Traducteur"}',
                ),
                array(
                    'name' => 'super-staff',
                    'guard_name' => 'staff',
                    'description' => '{"en":"StaffMember manager", "pt":"Gestor de pessoal", "fr":"Directeur du personnel"}',
                ),
                array(
                    'name' => 'staff',
                    'guard_name' => 'staff',
                    'description' => '{"en":"Staff member", "pt":"Funcionario", "fr":"Membre du personnel"}',
                ),
                array(
                    'name' => 'blog-writer',
                    'guard_name' => 'web',
                    'description' => '{"en":"Blog writer", "pt":"Escritor de Blog", "fr":"Rédacteur du blogue"}',
                ),
                array(
                    'name' => 'account-holder',
                    'guard_name' => 'web',
                    'description' => '{"en":"Account holder", "pt":"Titular de conta", "fr":"Titulaire de compte"}',
                ),
                array(
                    'name' => 'marketer',
                    'guard_name' => 'web',
                    'description' => '{"en":"Marketer", "pt":"Responsavel do marketing", "fr":"Responsable marketing"}',
                ),
                array(
                    'name' => 'lead',
                    'guard_name' => 'web',
                    'description' => '{"en":"Lead", "pt":"Lead", "fr":"Prospect"}',
                ),
                array(
                    'name' => 'customer',
                    'guard_name' => 'web',
                    'description' => '{"en":"Customer", "pt":"Cliente", "fr":"Client"}',
                ),
            ];

            // Assign roles to the first four admins
            foreach ($roles as $role) {
                $newRole = Role::firstOrCreate([
                    'name' => $role['name'], // First
                    'guard_name' => $role['guard_name']
                ]);
                $newRole->setTranslation('description', 'en', json_decode($role['description'], true)['en'])
                    ->setTranslation('description', 'pt', json_decode($role['description'], true)['pt'])
                    ->setTranslation('description', 'fr', json_decode($role['description'], true)['fr'])
                    ->save();
            }
        }
    }
}
