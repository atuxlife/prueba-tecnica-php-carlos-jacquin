<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserTest extends TestCase
{
    public function test_login_success()
    {
        User::factory()->create([
            'role'              =>  'A',
            'firstname'         =>  'Carlos',
            'lastname'          =>  'Jacquin',
            'email'             =>  'atuxlife@fakemail.com',
            'email_verified_at' =>  Carbon::now(),
            'password'          =>  Hash::make('AZ92adx$!'),
            'status'            =>  1,
            'user_create_id'    =>  1,
            'ip_create'         =>  '127.0.0.1',
            'created_at'        =>  Carbon::now(),
        ]);

        $response = $this->post('/api/login', [
            'email'     => 'atuxlife@fakemail.com',
            'password'  => 'AZ92adx$!'
        ]);
        $response->assertStatus(302);
    }

    public function test_login_fail()
    {
        User::factory()->create([
            'role'              =>  'A',
            'firstname'         =>  'Carlos',
            'lastname'          =>  'Jacquin',
            'email'             =>  'atuxlife@yahoo.com',
            'email_verified_at' =>  Carbon::now(),
            'password'          =>  Hash::make('AZ92adx$!'),
            'status'            =>  1,
            'user_create_id'    =>  1,
            'ip_create'         =>  '127.0.0.1',
            'created_at'        =>  Carbon::now(),
        ]);

        $response = $this->post('/api/login', [
            'email'     => 'atuxlife@yahoo.com',
            'password'  => 'WrongPassword'
        ]);
        $response->assertStatus(302);
    }

    public function test_create_user()
    {
        $hash = Hash::make('password', [
            'memory'    => 1024,
            'time'      => 2,
            'threads'   => 2,
        ]);

        $userData =[
            'role'              =>  'U',
            'firstname'         =>  'Any',
            'lastname'          =>  'User',
            'email'             =>  'anyuser@yahoo.com',
            'email_verified_at' =>  Carbon::now(),
            'password'          =>  $hash,
            'status'            =>  1,
            'user_create_id'    =>  1,
            'ip_create'         =>  '127.0.0.1',
            'created_at'        =>  Carbon::now(),
        ];

        $response = $this->post('/api/create-user',$userData);
        $response->assertStatus(302);
    }
}
