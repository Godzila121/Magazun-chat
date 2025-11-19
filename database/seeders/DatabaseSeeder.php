<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
public function run(): void
{
    // Створення адміна
    User::factory()->create([
        'name' => 'Власник Магазину',
        'email' => 'admin@shop.com',
        'password' => bcrypt('password'), // пароль: password
        'is_admin' => true, // <--- ВАЖЛИВО
    ]);

    // Тут можна викликати і ProductSeeder
    $this->call(ProductSeeder::class);
}

}
