<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestApiController extends Controller
{
    public function index()
    {
        Http::fake([
            'https://swapi.dev/api/people/1/' => Http::response([
                'name' => 'aidan'
            ])
        ]);
        $response = Http::get('https://swapi.dev/api/people/1/');
        return $response;
    }
}
