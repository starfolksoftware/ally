<?php

namespace StarfolkSoftware\Ally\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use StarfolkSoftware\Ally\Contact;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'type' => $this->faker->word,
            'meta' => [
                [
                    'label' => 'Email',
                    'value' => $this->faker->email,
                ],
                [
                    'label' => 'Phone',
                    'value' => $this->faker->phoneNumber,
                ],
            ],
        ];
    }
}
