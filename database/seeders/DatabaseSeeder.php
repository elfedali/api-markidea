<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Shop;
use Illuminate\Database\Seeder;
use Database\Factories\ShopFactory;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // delete folder storage/app/public
        Storage::deleteDirectory('public');






        \App\Models\User::factory()->create([
            'email' => "contact@markidea.ma",
            'role' => \App\Models\User::ROLE_SUPER_ADMIN,
            'first_name' => 'Abdessamad',
            'last_name' => 'EL FEDALI',
            'phone_number' => '0627018957',
            'address' => 'hay salam',
            'city' => 'casablanca',
            'zip_code' => '20250',
            'country' => 'maroc',
            //'avatar' => 'https://lh3.googleusercontent.com/a/AAcHTtdnjIRxOJbVY7jQn8e4aqwb_cs-2_OUIE5_MqgR=s96-c',
            'is_enabled' => true,
            'email_verified_at' => now(),
            'phone_number_verified_at' => now(),


        ]);

        \App\Models\User::factory(3)->create();


        $this->call([
            CategorySeeder::class,
        ]);

        \App\Models\Shop::factory()->count(5)->create();
    }
}
