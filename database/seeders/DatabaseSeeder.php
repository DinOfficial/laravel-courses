<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Course;
use App\Models\Platform;
use App\Models\Series;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $series = ['PHP', 'Javascript', 'WordPress', 'Laravel'];

        foreach ($series as $item) {
            Series::create([
                'name' => $item,
            ]);
        }

        $topic = ['Eloquent', 'Reflectoring', 'Testing', 'Authentication'];
        foreach ($topic as $item) {
            Topic::create([
                'name' => $item,
            ]);
        }

        $plateforms = ['laracast', 'laravel.io', 'larajobs', 'laravel News', 'laracat forum'];
        foreach ($plateforms as $items) {
            Platform::create([
                'name' => $item,
            ]);
        }
        $authors = ['Din Islam', 'Shahjahan', 'Kefayet'];
        foreach ($authors as $items) {
            Author::create([
                'name' => $item,
            ]);
        }

        // user factory create
        User::factory(50)->create();

        // course factory crate
        Course::factory(100)->create();

        $courses = Course::all();
        foreach ($courses as $course) {
            $topic = Topic::all()->random(rand(1, 4))->pluck('id')->toArray();
            $course->topics()->attach($topic);

            $authors = Author::all()->random(rand(1, 3))->pluck('id')->toArray();
            $course->authors()->attach($authors);

            $series = Series::all()->random(rand(1, 4))->pluck('id')->toArray();
            $course->series()->attach($series);
        }
    }
}
