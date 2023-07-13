<?php

namespace Ally\Tests\Mocks;

use Ally\Ally;
use Illuminate\Database\Eloquent\Factories\Factory;

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
