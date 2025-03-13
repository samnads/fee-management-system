<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::factory()->create([
            'name' => 'PHP / Codeigniter',
            'duration' => 3,
            'fee_per_month' => 500
        ]);
        Course::factory()->create([
            'name' => 'PHP / Laravel',
            'duration' => 6,
            'fee_per_month' => 900
        ]);
        Course::factory()->create([
            'name' => 'JS Basics',
            'duration' => 3,
            'fee_per_month' => 1000
        ]);
        Course::factory()->create([
            'name' => 'MEAN Full Stack',
            'duration' => 12,
            'fee_per_month' => 2000
        ]);
        Course::factory()->create([
            'name' => 'MERN Full Stack',
            'duration' => 10,
            'fee_per_month' => 1800
        ]);
        Course::factory()->create([
            'name' => 'CSS Advanced',
            'duration' => 6,
            'fee_per_month' => 600
        ]);
        Course::factory()->create([
            'name' => 'English',
            'duration' => 4,
            'fee_per_month' => 500
        ]);
    }
}
