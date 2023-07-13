<?php

namespace Ally\Tests\Mocks;

use Ally\TeamHasContacts;
use Illuminate\Database\Eloquent\Model;

class TeamModel extends Model
{
    use TeamHasContacts;

    protected $table = 'teams';
}
