<?php

namespace StarfolkSoftware\Ally\Contracts;

interface CreatesContacts
{
    /**
     * Create a new tax.
     *
     * @param  mixed  $user
     * @param  array  $data
     * @param  mixed  $teamId
     * @return \StarfolkSoftware\Ally\Contact
     */
    public function __invoke($user, array $data, $teamId = null);
}
