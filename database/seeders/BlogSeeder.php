<?php

namespace Database\Seeders;

use App\Models\blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        blog::factory(200)->create();
    }
}
