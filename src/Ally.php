<?php

namespace Ally;

use Ally\Contracts\CreatesContacts;
use Ally\Contracts\DeletesContacts;
use Ally\Contracts\UpdatesContacts;

final class Ally
{
    /**
     * Indicates if Ally routes will be registered.
     *
     * @var bool
     */
    public static $registersRoutes = true;

    /**
     * Indicates if Ally migrations should be ran.
     *
     * @var bool
     */
    public static $runsMigrations = true;

    /**
     * The contact model that should be used by Ally.
     *
     * @var string
     */
    public static $contactModel = 'App\\Models\\Contact';

    /**
     * Indicates if Ally should support teams.
     *
     * @var bool
     */
    public static $supportsTeams = false;

    /**
     * The team model that should be used by Ally.
     *
     * @var string
     */
    public static $teamModel;

    /**
     * Get the name of the contact model used by the application.
     *
     * @return string
     */
    public static function teamModel()
    {
        return static::$teamModel;
    }

    /**
     * Specify the team model that should be used by Ally.
     *
     * @param  string  $model
     * @return static
     */
    public static function useTeamModel(string $model)
    {
        static::$teamModel = $model;

        return new static();
    }

    /**
     * Get a new instance of the team model.
     *
     * @return mixed
     */
    public static function newTeamModel()
    {
        $model = static::teamModel();

        return new $model();
    }

    /**
     * Find a team instance by the given ID.
     *
     * @param  mixed  $id
     * @return mixed
     */
    public static function findTeamByIdOrFail($id)
    {
        return static::newTeamModel()->whereId($id)->firstOrFail();
    }

    /**
     * Get the name of the contact model used by the application.
     *
     * @return string
     */
    public static function contactModel()
    {
        return static::$contactModel;
    }

    /**
     * Get a new instance of the contact model.
     *
     * @return mixed
     */
    public static function newContactModel()
    {
        $model = static::contactModel();

        return new $model();
    }

    /**
     * Specify the contact model that should be used by Ally.
     *
     * @param  string  $model
     * @return static
     */
    public static function useContactModel(string $model)
    {
        static::$contactModel = $model;

        return new static();
    }

    /**
     * Register a class / callback that should be used to create Contacts.
     *
     * @param  string  $class
     * @return void
     */
    public static function createContactsUsing(string $class)
    {
        app()->singleton(CreatesContacts::class, $class);
    }

    /**
     * Register a class / callback that should be used to update Contacts.
     *
     * @param  string  $class
     * @return void
     */
    public static function updateContactsUsing(string $class)
    {
        app()->singleton(UpdatesContacts::class, $class);
    }

    /**
     * Register a class / callback that should be used to delete Contacts.
     *
     * @param  string  $class
     * @return void
     */
    public static function deleteContactsUsing(string $class)
    {
        app()->singleton(DeletesContacts::class, $class);
    }

    /**
     * Configure Ally to not register its routes.
     *
     * @return static
     */
    public static function ignoreRoutes()
    {
        static::$registersRoutes = false;

        return new static();
    }

    /**
     * Configure Ally to not run its migrations.
     *
     * @return static
     */
    public static function ignoreMigrations()
    {
        static::$runsMigrations = false;

        return new static();
    }

    /**
     * Configure Ally to support multiple teams.
     *
     * @param  bool  $value
     * @return static
     */
    public static function supportsTeams(bool $value = true)
    {
        static::$supportsTeams = $value;

        return new static();
    }

    /**
     * Get a completion redirect path for a specific feature.
     *
     * @param  string  $redirect
     * @return string
     */
    public static function redirects(string $redirect, $default = null)
    {
        return config('ally.redirects.' . $redirect) ?? $default ?? '/';
    }
}
