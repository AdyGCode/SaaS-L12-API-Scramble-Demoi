<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;



test('Create a new category', function(){

    $user = User::factory()->create(); // First we create a user

    $categoryData = [
        'name' => 'A New Post',
        'description' => 'Content of the new post',
    ];

    // This stimulates authentication when creating the new post
    $this->actingAs($user)
        ->post('/categories', $categoryData);

    $this->assertDatabaseHas('categories', [
        'user_id' => $user->id,
        'title' => 'A New Post',
        'content' => 'Content of the new post',
    ]);

});
