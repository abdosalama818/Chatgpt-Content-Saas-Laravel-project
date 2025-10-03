<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Slider::create([
            'title' => 'Welcome to Our Website',
            'description' => 'Discover amazing content and features.',
            'image' => 'upload/slider/slider1.png',
        ]);
    }
}
