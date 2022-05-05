<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CurrencyControllerTest extends TestCase
{
    public function test_success_convert()
    {
        $response = $this->postJson(
            '/api/currency-convert',
            ['source' => 'TWD', 'target' => 'USD', 'amount' => 1000]
        );

        $response->assertOk();
        $response->assertJsonStructure(['dollars']);
    }

    public function test_error_source()
    {
        $response = $this->postJson(
            '/api/currency-convert',
            ['source' => 'TW', 'target' => 'USD', 'amount' => 1000]
        );

        $response->assertUnprocessable();
        $response->assertInvalid(['source' => 'The selected source is invalid.']);
    }

    public function test_error_target()
    {
        $response = $this->postJson(
            '/api/currency-convert',
            ['source' => 'TWD', 'target' => 'US', 'amount' => 1000]
        );
        $response->assertUnprocessable();
        $response->assertInvalid(['target' => 'The selected target is invalid.']);
    }

    public function test_error_amount()
    {
        $response = $this->postJson(
            '/api/currency-convert',
            ['source' => 'TWD', 'target' => 'USD', 'amount' => 'a']
        );
        $response->assertUnprocessable();
        $response->assertInvalid(['amount' => 'The amount must be a number.']);
    }

    public function test_blank_source()
    {
        $response = $this->postJson(
            '/api/currency-convert',
            ['source' => '', 'target' => 'USD', 'amount' => 1000]
        );

        $response->assertUnprocessable();
        $response->assertInvalid(['source' => 'The source field is required.']);
    }

    public function test_blank_target()
    {
        $response = $this->postJson(
            '/api/currency-convert',
            ['source' => 'TWD', 'target' => '', 'amount' => 1000]
        );

        $response->assertUnprocessable();
        $response->assertInvalid(['target' => 'The target field is required.']);
    }

    public function test_blank_amount()
    {
        $response = $this->postJson(
            '/api/currency-convert',
            ['source' => 'TWD', 'target' => 'USD', 'amount' => '']
        );

        $response->assertUnprocessable();
        $response->assertInvalid(['amount' => 'The amount field is required.']);
    }
}
