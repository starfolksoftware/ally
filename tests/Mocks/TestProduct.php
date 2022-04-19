<?php

namespace StarfolkSoftware\Ally\Tests\Mocks;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use StarfolkSoftware\Ally\HasContacts;

class TestProduct extends Model
{
    use HasFactory;
    use HasContacts;

    protected $table = 'products';
}
