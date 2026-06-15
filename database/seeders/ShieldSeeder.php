<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_activity::log","view_any_activity::log","create_activity::log","update_activity::log","restore_activity::log","restore_any_activity::log","replicate_activity::log","reorder_activity::log","delete_activity::log","delete_any_activity::log","force_delete_activity::log","force_delete_any_activity::log","view_documentation","view_any_documentation","create_documentation","update_documentation","restore_documentation","restore_any_documentation","replicate_documentation","reorder_documentation","delete_documentation","delete_any_documentation","force_delete_documentation","force_delete_any_documentation","view_logbook","view_any_logbook","create_logbook","update_logbook","restore_logbook","restore_any_logbook","replicate_logbook","reorder_logbook","delete_logbook","delete_any_logbook","force_delete_logbook","force_delete_any_logbook","view_login::history","view_any_login::history","create_login::history","update_login::history","restore_login::history","restore_any_login::history","replicate_login::history","reorder_login::history","delete_login::history","delete_any_login::history","force_delete_login::history","force_delete_any_login::history","view_member","view_any_member","create_member","update_member","restore_member","restore_any_member","replicate_member","reorder_member","delete_member","delete_any_member","force_delete_member","force_delete_any_member","view_mentor::note","view_any_mentor::note","create_mentor::note","update_mentor::note","restore_mentor::note","restore_any_mentor::note","replicate_mentor::note","reorder_mentor::note","delete_mentor::note","delete_any_mentor::note","force_delete_mentor::note","force_delete_any_mentor::note","view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_user","view_any_user","create_user","update_user","delete_user","delete_any_user","restore_user","restore_any_user","replicate_user","reorder_user","force_delete_user","force_delete_any_user"]},{"name":"mahasiswa","guard_name":"web","permissions":["view_logbook","view_any_logbook","create_logbook","update_logbook","view_documentation","view_any_documentation","create_documentation","update_documentation","view_member","view_mentor::note","view_any_mentor::note"]},{"name":"mentor","guard_name":"web","permissions":["view_logbook","view_any_logbook","view_documentation","view_any_documentation","view_member","view_any_member","view_mentor::note","view_any_mentor::note","create_mentor::note","update_mentor::note","delete_mentor::note"]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
