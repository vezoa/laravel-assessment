<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;

class TourTest extends TestCase
{



    /**
     * testing an error
     */

    public function  testErrorGetAllTours()
    {
        $response = $this->getJson('/api/v1/tour');

        return $response->assertStatus(404);
    }

   /**
    * get all tours retun status 200  if had success
    */
    public function testGetAllTours()
    {
        $response = $this->getJson('/api/v1/tours');


        $response->assertStatus(200)
        ->decodeResponseJson();
    }

    public function testSingleTour()
    {
        $response = $this->getJson('/api/v1/tours/3',);

        $response->assertStatus(200)
        ->decodeResponseJson();
    }
    /**
     * Error create Tour
     *
     * @return void
     */

    public function testErrorCreateTour()
    {
        $payload = [
            'start' => '2022-',
            'end' => '2023-07-16',
            'price' => '99.99'
        ];
             $response = $this->postJson('/api/v1/tours', $payload);

            $response->assertStatus(422);

    }
    public function testCreateTour()
    {
        $payload = [
            'start' => '2022-02-20 09:30:00',
            'end' => '2023-07-16 06:30:00',
            'price' => '99.99'
        ];
             $response = $this->postJson('/api/v1/tours', $payload);
        $response->assertStatus(201);

    }



    public function testUpdateTour()
    {
        $payload = [
            'start' => '2022-02-20 09:30:00',
            'end' => '2023-08-16 09:30:00',
            'price' => '99.99'
        ];
        $response = $this->putJson('/api/v1/tours/1',$payload
        );

        $response->assertStatus(200);

    }
/**
 * error on delating Tour
 */
    public function testErrorDeleteTour()
    {
        $response = $this->deleteJson('/api/v1/tours/');

        $response->assertStatus(405);

    }

    public function testSuccessDeleteTour()
    {
        $response = $this->deleteJson('/api/v1/tours/4');

        $response->assertStatus(200);

    }
}
