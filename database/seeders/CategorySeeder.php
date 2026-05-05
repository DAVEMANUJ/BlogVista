<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Admit Card',  'color' => '#3b82f6'],
            ['name' => 'Result',      'color' => '#10b981'],
            ['name' => 'Job Alert',   'color' => '#f59e0b'],
            ['name' => 'Syllabus',    'color' => '#8b5cf6'],
            ['name' => 'Answer Key',  'color' => '#ef4444'],
            ['name' => 'Recruitment', 'color' => '#06b6d4'],
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name'  => $cat['name'],
                'slug'  => Str::slug($cat['name']),
                'color' => $cat['color'],
            ]);
        }
    }
}