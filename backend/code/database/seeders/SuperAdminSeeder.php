<?php

namespace Database\Seeders;

use App\Dictionaries\UserRolesDictionary;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::query()->truncate();
        Role::query()->delete();
        Schema::enableForeignKeyConstraints();

        $role_admin = Role::create(['name' => UserRolesDictionary::ROLE_SUPERADMIN]);

        $super_admin = User::create([
            'name' => 'Lucas P',
            'email' => 'l.przezdziek@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $super_admin->assignRole([$role_admin->id]);
    }
}
