<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition(): array
    {
        return [
            'make'         => $this->faker->randomElement(['Toyota', 'Ford', 'BMW', 'Audi', 'Honda']),
            'model'        => ucfirst($this->faker->word),
            'year'         => $this->faker->year(),
            'mileage'      => $this->faker->numberBetween(0, 200_000),
            'color'        => $this->faker->safeColorName(),
            'transmission' => $this->faker->randomElement(['manual', 'automatic']),
            'fuel_type'    => $this->faker->randomElement(['petrol', 'diesel', 'electric', 'hybrid']),
            'vin'          => strtoupper(Str::random(17)),
            'image'        => $this->faker->imageUrl(640, 480, 'car', true),
            'price'        => $this->faker->numberBetween(10000, 80000),
            'category'     => $this->faker->randomElement(['Luxury', 'SUV', 'Sports', 'Sedan', 'Van', 'Performance']),
            'is_featured'  => $this->faker->boolean(30), // ~30% chance to be featured
        ];
    }
}
