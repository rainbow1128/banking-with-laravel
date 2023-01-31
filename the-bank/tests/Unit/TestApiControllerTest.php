<?php

namespace Tests\Unit;

use App\Http\Controllers\TestApiController;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\TestCase;

class TestApiControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    // public function testIndex()
    // {

    //     // $expected = Http::fake([
    //     //     'https://swapi.dev/api/people/1/' => Http::response([
    //     //         'name' => 'aidan'
    //     //     ])
    //     // ]);
    //     $expected = 'hello';
    //     $response = $this->action('GET', 'TestApiController@index');
    //     $this->assertEquals($expected, $response);
    // }
    // public function testAPI()
    // {
    //     $client = new Client();
    //     $response = $client->get('https://swapi.dev/api/people/1/');
    //     $data = json_decode($response->getBody());
    //     $this->assertEquals('hello world', $data->message);
    // }
}
