<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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
        DB::table('users')->insert([
            'id'                =>  1,
            'role_id'           =>  1,
            'firstname'         =>  'CARLOS',
            'lastname'          =>  'JACQUIN',
            'username'          =>  'cjacquin',
            'email'             =>  'atuxlife@gmail.com',
            'password'          =>  Hash::make('AZ92adx$!'),
            'status'            =>  1,
            'user_create_id'    =>  1,
            'ip_create'         =>  '127.0.0.1',
            'created_at'        =>  Carbon::now(),
        ]);
    }
}
