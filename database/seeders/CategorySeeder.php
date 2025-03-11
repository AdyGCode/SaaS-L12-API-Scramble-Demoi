<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'Unknown',
                'description' => 'No category assigned'
            ],
            [
                'id' => 100, 'name' => 'dad',
                'description' => 'Dad Jokes'
            ],
            ['name' => 'programmer', 'description' => null],
            ['name' => 'lightbulb', 'description' => null],
            ['name' => 'one-liner', 'description' => null],
            ['name' => 'mum', 'description' => null],
            [
                'name' => 'explicit',
                'description' => "Not for under 18 year olds"
            ],
        ];

        DB::beginTransaction();
        foreach ($categories as $category) {
            Category::create($category);
        }
        DB::commit();
    }
}
