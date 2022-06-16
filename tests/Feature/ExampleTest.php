<?php

namespace Tests\Feature;

use App\Models\CPU;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        // $response = $this->get('/');
        // php artisan make:test exampleTest --unit
        // php artisan test
        // php artisan test --testsuite=Feature
        // ./vendor/bin/phpunit
        

        // $cpu = [
        //     'CPUModel' => 'TestCPU',
        //     'Score' => '100',
        //     'Speed' => '1.0',
        //     'idCPUBrand' => '2'
        // ];

        // $this->json('POST', route('http://localhost/apirest-comparator/public/store-cpu'), $cpu)->assertStatus(200);

        // $response = $this->post('store-cpu', [
        //     'CPUModel' => 'TestCPU',
        //     'Score' => '100',
        //     'Speed' => '1.0',
        //     'idCPUBrand' => '2'
        // ]);

        // dd($response);

        $response = $this->get('/model');
        $response->assertStatus(200);
    }
}
