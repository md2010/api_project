<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTest extends TestCase
{
    public function test_if_user_created_successfully() {
    
        $data = [
            'name' => 'john smith',
            'email' => 'johns@example.com',          
            'password' => Hash::make('password5555'),
            'type' => 'normal'
        ];
        $this->json('post', 'api/register', $data)
             ->assertStatus(200)
             ->assertJson([ 
                'message' => 'You are registred! Please confirm on your mail.',
                null => null                  
        ]);
        $this->assertDatabaseHas('users', $data);
    }
}
