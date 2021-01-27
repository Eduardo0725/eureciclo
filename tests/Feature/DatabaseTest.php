<?php

namespace Tests\Feature;

use App\Models\Sale;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    /**
     * The test must create data for the database.
     *
     * @return void
     */
    public function test_create_data()
    {
        $number = 5;

        $sales = Sale::factory()->count($number)->make();

        $this->assertTrue($sales->count() === $number);
    }
}
