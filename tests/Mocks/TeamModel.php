<?php

namespace Ally\Tests\Mocks;

use Illuminate\Database\Eloquent\Model;
use Ally\TeamHasContacts;

class TeamModel extends Model
{
    use TeamHasContacts;

    protected $table = 'teams';
}
