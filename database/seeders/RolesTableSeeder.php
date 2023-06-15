<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        \Schema::disableForeignKeyConstraints();
        Role::truncate();
        \DB::table('role_has_permissions')->truncate();
        \Schema::enableForeignKeyConstraints();

        $role = Role::create(['name' => 'Super Admin']);
    }
}
