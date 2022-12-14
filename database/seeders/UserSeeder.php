<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
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
        DB::table('users')->insert([
            'id'                =>  1,
            'role'              =>  1,
            'firstname'         =>  'Carlos',
            'lastname'          =>  'Jacquin',
            'email'             =>  'atuxlife@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password'          =>  Hash::make('AZ92adx$!'),
            'status'            =>  1,
            'user_create_id'    =>  1,
            'ip_create'         =>  '127.0.0.1',
            'created_at'        =>  Carbon::now(),
        ]);

        User::factory(9)->create();
    }
}
