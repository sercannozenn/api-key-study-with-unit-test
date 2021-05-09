<?php

namespace Tests\Unit;

use App\Models\Integration;
use Tests\TestCase;

class ApiIntegrationDestroyTest extends TestCase
{
    /**
     * @throws \Throwable
     */
    public function test_can_destroy_integration()
    {
        $integration = Integration::first();
        $this->delete(route('integration.destroy', $integration->id), [], [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $this->response->access_token
        ])
            ->assertStatus(200)
            ->decodeResponseJson()
            ->json([
                'id' => $integration->id
            ]);
    }

    public function test_can_destroy_integration_command()
    {
        $this->artisan('delete:integration --id=-1')
            ->assertExitCode(0);

        $integration = Integration::first();

        $this->artisan('delete:integration --id='.$integration->id)
            ->assertExitCode(1);
    }
}
