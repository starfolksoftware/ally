<?php

namespace StarfolkSoftware\Ally\Tests\Mocks;

use Illuminate\Database\Eloquent\Model;
use StarfolkSoftware\Ally\TeamHasContacts;

class TeamModel extends Model
{
    use TeamHasContacts;

    protected $table = 'teams';
}