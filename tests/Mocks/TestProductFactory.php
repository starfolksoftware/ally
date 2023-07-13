<?php

namespace Ally\Tests\Mocks;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestProductFactory extends Factory
{
    protected $model = TestProduct::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
