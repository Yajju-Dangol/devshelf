<?php

namespace Database\Seeders;

use App\Models\Resource;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Seed 12 realistic developer resources.
     */
    public function run(): void
    {
        Resource::factory()->count(12)->create();
    }
}
