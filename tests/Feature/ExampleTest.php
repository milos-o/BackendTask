<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Hotel;
use App\Models\Location;

class ExampleTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testHotelPostRequest(){
        $this->withoutExceptionHandling();

        $response = $this->post('/add-hotel', [
            'name' => 'pORTO NOVIIII',
            "rating" => 4,
            "category" => "hotel",
            "image" => "http://backend.test/hotel.png",
            "reputation" => 12,
            "price" => 222,
            "availability" => 12
        ]);

        $this->assertCount(1, Hotel::all());
    }

    public function testLocationPostRequest(){
        $this->withoutExceptionHandling();

        $response = $this->post('/add-location', [
            'city' => 'Podgorica',
            'state' => 'Srbija',
            'country' => 'Crna Gora',
            'adress' => "Luke Gojnica",
            'zipcode' => 23232,
            'hotel_id' => 1
        ]);

        $this->assertCount(1, Location::all());
    }

  
     
    public function testDeletingLocation(){
        $this->withoutExceptionHandling();

        $this->post('/add-location', $this->data());

        $location = Location::first();
        $this->assertCount(1, Location::all());

        $response = $this->delete('/delete-location/'.$location->id);

        $this->assertCount(0, Location::all());
    }

    public function testUpdatingLocation(){
        $this->withoutExceptionHandling();
        $this->post('/add-location', $this->data());

        $location = Location::first();
        $city = $location->city;

        $response = $this->post('/change-location/'.$location->id, [
            'city' => 'Niksic',
            'state' => 'Crna Gora',
            'country' => 'Crna Gora',
            'adress' => "Luke Gojnica",
            'zipcode' => 23232,
            'hotel_id' => 1
        ]);

        $this->assertEquals('Niksic', Location::first()->city);
    }

    private function data()
    {
        return [
            'city' => 'Podgorica',
            'state' => 'Crna Gora',
            'country' => 'Crna Gora',
            'adress' => "Luke Gojnica",
            'zipcode' => 23232,
            'hotel_id' => 1
        ];
    }
}
