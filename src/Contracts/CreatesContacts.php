<?php

namespace Ally\Contracts;

interface CreatesContacts
{
    /**
     * Create a new tax.
     *
     * @param  mixed  $user
     * @param  array  $data
     * @param  mixed  $teamId
     * @return mixed
     */
    public function __invoke($user, array $data, $teamId = null);
}
