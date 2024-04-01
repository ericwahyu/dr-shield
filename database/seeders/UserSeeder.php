<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $ewa = User::create([
            'name'     => 'EWA',
            'email'    => 'erickwahyu19@gmail.com',
            'password' => Hash::make('123'),
            'status'   => 'active'
        ]);

        $ewa->assignRole('master-admin');

        $super_admin = User::create([
            'name'     => 'Super Admin',
            'email'    => 'superadmin@gmail.com',
            'password' => Hash::make(123),
            'status'   => 'active'
        ]);

        $super_admin->assignRole('super-admin');

        $admin = User::create([
            'name' => 'Admin',
            'email'     => 'admin@gmail.com',
            'password'  => Hash::make(123),
            'status'    => 'active'
        ]);

        $admin->assignRole('admin');
    }
}
