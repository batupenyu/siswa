<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anak;

class AnakSeeder extends Seeder
{
    public function run()
    {
        Anak::factory()->count(10)->create();
    }
}
