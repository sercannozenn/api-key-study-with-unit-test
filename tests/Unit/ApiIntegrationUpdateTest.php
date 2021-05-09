<?php

namespace Tests\Unit;

use App\Models\Integration;
use Tests\TestCase;

class ApiIntegrationUpdateTest extends TestCase
{
    public function test_can_update_integration()
    {
        $data = [
            'marketplace' => $this->faker->name(),
            'username' => $this->faker->userName,
            'password' => '12345678',
        ];
        $integration = Integration::first();
        $this->put(route('integration.update', $integration->id), $data, [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->response->access_token
        ])->json([
            'marketplace' => $data['marketplace'],
            'username' => $data['username'],
            'password' => $data['password']
        ]);
    }

    public function test_can_update_integration_required_control()
    {
        $data = [];
        $integration = Integration::first();
        $this->put(route('integration.update', $integration->id), $data, [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->response->access_token
        ])
            ->assertStatus(422)
            ->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'marketplace' => ['The marketplace field is required'],
                    'username' => ['The username field is required'],
                    'password' => ['The password field is required'],
                ]
            ]);
    }

    public function test_can_update_integration_for_command()
    {
        $this->artisan('update:integration --id=-1 ')
            ->assertExitCode(0);

        $integration = Integration::orderByDesc('id')->first();
        $this->artisan('update:integration --id='.$integration->id . ' --marketplace=sercan')
            ->assertExitCode(1);
    }
}
