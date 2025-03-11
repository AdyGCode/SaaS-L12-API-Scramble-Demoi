<?php

use App\Models\Category;


test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('API returns category list', function(){

   $category = Category::create(['name'=>"dummy"]);

   $results = $this->getJson('/api/v1/categories')
       ->assertJson([$category->toArray()]);

   expect($results->content())
       ->json()
       ->toHaveCount(9);
});
