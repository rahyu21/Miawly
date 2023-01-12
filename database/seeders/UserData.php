<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'level' => 'admin',
            ],
            [
                'name' => 'Gudang',
                'email' => 'gudang@gmail.com',
                'password' => Hash::make('gudang'),
                'level' => 'gudang',
            ],

        ];
        foreach($user as $kay => $value){
            User::create($value);
        }
        // DB::table('users')->insert([
        //     'name' => 'Admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('admin'),
        //     'level' => 'admin',
        // ]);
        // DB::table('users')->insert([
        //     'name' => 'Gudang',
        //     'email' => 'gudang@gmail.com',
        //     'password' => Hash::make('gudang'),
        //     'level' => 'gudang',
        // ]);
    }
}