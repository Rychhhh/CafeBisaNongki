<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'name' => 'Rayhan',
                'email' => 'rayhancoding1603@gmail.com',
                'password' => Hash::make('Password'),
                'provider_id' => '',
                'role' => 'admin',
                'image' => 'bruce-mars.jpg',
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('Password'),
                'provider_id' => '',
                'role' => 'admin',
                'image' => 'bruce-mars.jpg',
            ],
            [
                'name' => 'Kasir',
                'email' => 'kasir@gmail.com',
                'password' => Hash::make('Password'),
                'provider_id' => '',
                'role' => 'kasir',
                'image' => 'bruce-mars.jpg',
            ],
            [
                'name' => 'Manager',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('Password'),
                'provider_id' => '',
                'role' => 'manager',
                'image' => 'bruce-mars.jpg',
            ],
           
           
        ];

        foreach($data as $key => $value) {
            User::insert($value);
        }
    }
}
