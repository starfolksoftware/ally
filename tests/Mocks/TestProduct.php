<?php

namespace Ally\Tests\Mocks;

use Ally\HasContacts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestProduct extends Model
{
    use HasFactory;
    use HasContacts;

    protected $table = 'products';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return TestProductFactory::new();
    }
}
