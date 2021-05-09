<?php

namespace Tests\Unit;

use Tests\TestCase;

class ApiIntegrationCreateTest extends TestCase
{
    public function test_can_create_integration()
    {
        $data = [
            'marketplace' => $this->faker->name(),
            'username' => $this->faker->userName,
            'password' => '12345678',
        ];
        $this->post(route('integration.store'), $data, [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->response->access_token
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
