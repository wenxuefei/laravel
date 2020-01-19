<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456')
        ]);
        $user = User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => bcrypt('123456')
        ]);


        $adminRole = Role::findByName('admin');
        $userRole = Role::findByName('user');

        $admin->assignRole($adminRole);
        $user->assignRole($userRole);

    }
}
