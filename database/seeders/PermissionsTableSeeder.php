<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        \Schema::disableForeignKeyConstraints();
        Permission::truncate();
        \Schema::enableForeignKeyConstraints();

        Artisan::call('permission:create-permission-routes');
    }
}
