<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    

    // public function testRequiresEmailAndLogin()
    // {

    //     $this->json('POST', 'api/login')
    //         ->assertStatus(200)
    //         ->assertJson([
    //             'email' => ['The email field is required.'],
    //             'password' => ['The password field is required.'],
    //         ]);
    // }

    public function testUserLoginsSuccessfully()
    {
        // $user = factory(User::class)->create([
        //     'email' => 'john.doe@toptal.com',
        //     'password' => bcrypt('toptal123'),
        // ]);

        $payload = ['email' => 'john.doe@toptal.com', 'password' => 'toptal123'];

        $this->json('POST', 'api/login', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    'api_token',
                ],
            ]);

    }
}
