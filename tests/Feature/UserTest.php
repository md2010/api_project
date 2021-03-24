<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserTest extends TestCase
{
    /* public function test_if_user_created_successfully() 
    {    
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
 
    public function test_email_sending_time_with_queue()  //0.28s
    {
        $user = User::findOrFail(1);
        $this->actingAs($user, 'api');

        $this->json('get', 'api/user/export-csv')
             ->assertStatus(200)
             ->assertJson([ 
                'message' => 'File has been sent to your email!',
                null => null                  
        ]);
    }
 */
    public function test_email_sending_time_with_mail_to()
    {
        $user = User::findOrFail(1);
        $this->actingAs($user, 'api');

        $this->json('get', 'api/user/export-csv')
             ->assertStatus(200)
             ->assertJson([ 
                'message' => 'File has been sent to your email!',
                null => null                  
        ]);
    }
        
}
