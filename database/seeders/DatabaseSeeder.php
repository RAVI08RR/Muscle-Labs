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
        // 1. Users & Admin Staff
        $this->call(UserSeeder::class);

        // 2. Seed Lunar custom product attributes
        $this->call(LunarAttributeSeeder::class);

        // 3. Seed static content pages
        $this->call(PageSeeder::class);

        // 4. Seed FAQs
        $this->call(FaqSeeder::class);

        // 5. Seed Products, Currencies, Collections, Tiered Prices, and COAs
        $this->call(ProductSeeder::class);

        // 6. Seed Research Blog Articles
        $this->call(ArticleSeeder::class);
    }
}
