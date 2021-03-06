<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    protected $model = Lesson::class;
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $unique = $this->faker->unique()->name();

        return [
            'module_id' => Module::factory(),
            'name' => $unique,
            'video' => $unique,
            'description' => $this->faker->sentence(20),
        ];
    }
}
