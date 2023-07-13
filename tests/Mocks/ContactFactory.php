<?php

namespace Ally\Tests\Mocks;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ally\Ally;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        $defs = [
            'name' => $this->faker->name,
            'type' => $this->faker->randomElement(['customer', 'vendor']),
            'meta' => [
                'email' => $this->faker->email(),
            ],
        ];

        if (Ally::$supportsTeams) {
            $defs['team_id'] = 1;
        }

        return $defs;
    }
}