<?php

namespace Ally\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ally\Tests\Mocks\TestProduct;

class TestProductFactory extends Factory
{
    protected $model = TestProduct::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}