<?php

namespace Database\Seeders;

use App\Models\Clarifi;
use App\Models\Connect;
use App\Models\Slider;
use App\Models\Usability;
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

           Clarifi::create([
            'title' => 'Welcome to Our Website clarifi',
            'description' => 'clarifi clarifi clarifi ',
            'image' => 'upload/slider/slider1.png',
        ]);
           Usability::create([
            'title' => 'Welcome to Our Website clarifi',
            'description' => 'clarifi clarifi clarifi ',
            'image' => 'upload/slider/slider1.png',
            'youtube' => 'https://www.youtube.com/watch?v=bXNTYXQxmmM',
            'link' => 'https://www.youtube.com/watch?v=bXNTYXQxmmM',
        ]);

        Connect::create([
            'title' => 'connect lorem3',
            'description' => 'connect lorem3 connect lorem3connect lorem3connect lorem3',
        ]);
    }
}
