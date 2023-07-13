<?php

namespace Ally\Tests\Mocks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ally\HasContacts;

class TestProduct extends Model
{
    use HasFactory;
    use HasContacts;

    protected $table = 'products';
}
