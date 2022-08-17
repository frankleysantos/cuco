<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Tests\TestCase;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class ClientTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    /** @test */
    public function can_get_all_clients()
    {
        $token = $this->user_login();
        $response = $this->json('POST', 'api/auth/client/show',['id' => 18], [   
                            'Accept' => 'application/json',
                            'AUTHORIZATION' => 'Bearer ' . $token
                        ])
                        ->assertStatus(200)
                        ->assertJsonStructure([
                            [
                                'full_name', 'cpf', 'birth_date', 'phone'
                            ],
                        ]);
        // $response = $response->json();
        // return $response;
    }

    /** @test */
    public function can_create_client()
    {
        $token = $this->user_login();
        $client = [
            'full_name'     =>  'Carlos Roberto dos Teste',
            'cpf'           =>  '098.198.726.30',
            'birth_date'    =>  '16/07/1989',
            'phone'         =>  '(33)98861-4189'
        ];
        $response = $this->json('POST', 'api/auth/client/store', $client , [   
                            'Accept' => 'application/json',
                            'AUTHORIZATION' => 'Bearer ' . $token
                        ])
                        ->assertStatus(200);
    }

    //função somente para pegar token jwt
    public function user_login()
    {
        $userData = [
            "email" => "frankley@gmail.com",
            "password" => "12345678",
        ];

        $response = $this->json('POST', 'api/auth/login', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "user" => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ],
                "access_token",
            ]);
        return $response['access_token'];
    }
}
