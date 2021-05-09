<?php

namespace Tests\Unit;

use App\Models\Integration;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ApiIntegrationCreateTest extends TestCase
{

    /**
     * @throws \Throwable
     */
    public function test_can_create_integration()
    {
        $loginData = [
            'email' => 'test@test.com',
            'password' => '12345678'
        ];

        $login = $this->post(route('api.login'), $loginData, [
            'Accept' => 'application/json',
        ])
            ->assertStatus(200)
            ->assertJsonStructure(['access_token'])
            ->decodeResponseJson();
        $response = (object)$login->json();

        $data = [
            'marketplace' => $this->faker->name(),
            'username' => $this->faker->userName,
            'password' => '12345678',
        ];
        $this->post(route('integration.store'), $data, [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $response->access_token
        ])->json([
            'marketplace' => $data['marketplace'],
            'username' => $data['username'],
            'password' => $data['password']
        ]);
    }

    public function test_can_create_integration_for_command()
    {
        $this->artisan('create:integration --marketplace= --username= --password=')
            ->assertExitCode(0);

        $this->artisan('create:integration --marketplace=test --username=testuser --password=test')
            ->assertExitCode(1);
    }


}
