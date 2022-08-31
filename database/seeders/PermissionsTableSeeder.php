<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //permission dashboard
        Permission::create(['name' => 'dashboard.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'dashboard.count_user', 'guard_name' => 'web']);

        //permission users
        Permission::create(['name' => 'users.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.delete', 'guard_name' => 'web']);
        
        //permission roles
        Permission::create(['name' => 'roles.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.delete', 'guard_name' => 'web']);

        //permission report
        Permission::create(['name' => 'reports.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'reports.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'reports.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'reports.delete', 'guard_name' => 'web']);

        //permission absensi
        Permission::create(['name' => 'absensis.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'absensis.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'absensis.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'absensis.delete', 'guard_name' => 'web']);
        Permission::create(['name' => 'absensis.master', 'guard_name' => 'web']);

        //permission cuti
        Permission::create(['name' => 'cutis.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'cutis.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'cutis.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'cutis.delete', 'guard_name' => 'web']);

        

        //permission permissions
        Permission::create(['name' => 'permissions.index', 'guard_name' => 'web']);
    }
}
