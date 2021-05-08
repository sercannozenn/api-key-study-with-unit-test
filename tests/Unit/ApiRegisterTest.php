<?php

namespace Tests\Unit;

use Tests\TestCase;

class ApiRegisterTest extends TestCase
{
    public function test_can_register_name_email_required()
    {
        $data = [
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ];

        $this->post(route('api.register'), $data, [
            'Accept' => 'application/json'
        ])
            ->assertStatus(422)
            ->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'name' => ['The name field is required'],
                    'email' => ['The email field is required'],
                ]
            ]);
    }

    public function test_can_register_email_type_control()
    {
        $data = [
            'email' => $this->faker->name(),
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ];

        $this->post(route('api.register'), $data, [
            'Accept' => 'application/json'
        ])
            ->assertStatus(422)
            ->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'email' => ['The email must be a valid email address.'],
                ]
            ]);
    }

    public function test_can_register_password_confirmation()
    {
        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '12345678',
            'password_confirmation' => '123456789',
        ];

        $this->post(route('api.register'), $data, [
            'Accept' => 'application/json'
        ])
            ->assertStatus(422)
            ->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'password' => ['The password confirmation does not match.'],
                ]
            ]);
    }
}
