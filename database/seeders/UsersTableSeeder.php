<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        \Schema::disableForeignKeyConstraints();
        User::truncate();
        \DB::table('model_has_roles')->truncate();
        \Schema::enableForeignKeyConstraints();

        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'email_verified_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'password' => bcrypt('pcecc@2023'),
        ]);

        $user->assignRole('Super Admin');

    }
}
