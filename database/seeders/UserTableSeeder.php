<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create user
        $user = User::create([
            'name'      => 'Super Admin',
            'email'     => 'superadmin@gmail.com',
            'password'  => bcrypt('password'),
        ]);

        $user = User::create([
            'name'      => 'Pegawai',
            'email'     => 'pegawai@gmail.com',
            'password'  => bcrypt('12345'),
        ]);

        //get all permission
        $permission = Permission::all();

        //get role (admin)
        $role = Role::find(1);

        //assign permission to role
        $role->syncPermissions($permission);

        //assign role to user
        $user->assignRole($role);
    }
}
