<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Use the new business content seeder for realistic enterprise data
        $this->call([
            BusinessContentSeeder::class,
        ]);
    }
}
