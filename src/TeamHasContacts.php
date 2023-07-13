<?php

namespace Ally;

trait TeamHasContacts
{
    /**
     * Get the contacts associated with the team.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts()
    {
        return $this->hasMany(Ally::$contactModel, 'team_id');
    }
}
