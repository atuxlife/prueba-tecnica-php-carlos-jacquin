<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [[
            'id'                =>  1,
            'name'              =>  'ADMINISTRADOR',
            'status'            =>  1,
            'user_create_id'    =>  1,
            'ip_create'         =>  '127.0.0.1',
            'created_at'        =>  Carbon::now(),
        ],[
            'id'                =>  2,
            'name'              =>  'USUARIO',
            'status'            =>  1,
            'user_create_id'    =>  1,
            'ip_create'         =>  '127.0.0.1',
            'created_at'        =>  Carbon::now(),
        ]];

        DB::table('roles')->insert($data);
    }
}
