<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function Laravel\Prompts\password;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'=>'Ad Ministrator',
                'email'=>'admin@example.com',
                'email_verified_at'=>now(),
                'password'=>Hash::make('Password1'),
                'remember_token'=>Str::random(10),
            ],
        ];

        DB::beginTransaction();
        foreach ($users as $user) {
            User::create($user);
        }
        DB::commit();

    }
}
