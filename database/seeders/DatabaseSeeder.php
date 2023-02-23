<?php

namespace Database\Seeders;

use App\Models\Supplier;
use App\Models\User;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(3)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Category::create([
            'name' => 'MINYAK GORENG'


        ]);
        Category::create([
            'name' => 'TERIGU'


        ]);
        Category::create([
            'name' => 'BERAS'
        ]);


        Category::create([
            'name' => 'SABUN CUCI'
        ]);
        Customer::factory(20)->create();
        Supplier::factory(3)->create();
        User::factory(1)->create();
    }
}
