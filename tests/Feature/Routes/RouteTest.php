<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\TestResponse;

it('is up', function () {
   $response = $this->getJson('/up');
   expect($response->content())
       ->toBeSuccessful();
});

//it('has a working response for all routes', function () {
//    // Retrieve all routes
//    $routes = collect(Route::getRoutes())->map(function ($route) {
//        return [
//            'uri' => $route->uri(),
//            'methods' => $route->methods(),
//        ];
//    });
//
//    // Iterate over each route
//    foreach ($routes as $route) {
//        foreach ($route['methods'] as $method) {
//            $response = $this->call($method, $route['uri']);
//
//            // Check if the response is successful
//            $response->assertStatus(200);
//        }
//    }
//});
