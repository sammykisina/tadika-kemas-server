<?php

declare(strict_types=1);

namespace Database\Seeders;

use Domains\Shared\Models\Role;
use Domains\Shared\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UsersSeeder extends Seeder {
    public function run() {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        $adminRole = Role::query()->where('slug', 'admin')->first();
        User::create([
            'email' => 'admin@admin.com',
            'name' => 'admin',
            'password' => Hash::make('admin'),
            'role_id' => $adminRole->id,
        ]);
    }
}
