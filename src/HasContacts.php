<?php

namespace StarfolkSoftware\Ally;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection as BaseCollection;

trait HasContacts
{
    /**
     * Define a polymorphic many-to-many relationship.
     *
     * @param string $related
     * @param string $name
     * @param string $table
     * @param string $foreignPivotKey
     * @param string $relatedPivotKey
     * @param string $parentKey
     * @param string $relatedKey
     * @param bool   $inverse
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    abstract public function morphToMany(
        $related,
        $name,
        $table = null,
        $foreignPivotKey = null,
        $relatedPivotKey = null,
        $parentKey = null,
        $relatedKey = null,
        $inverse = false
    );

    /**
     * Get all attached contacts to the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function contacts(): MorphToMany
    {
        return $this->morphToMany(
            Ally::$contactModel,
            'contactable',
            'contactables',
            'contactable_id',
            'contact_id'
        )->withTimestamps();
    }

    /**
     * Scope query to a given type.
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }

    /**
     * Scope query with all the given contacts.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param mixed $contacts
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithAllContacts(Builder $builder, $contacts): Builder
    {
        $contacts = $this->prepareContactIds($contacts);

        collect($contacts)->each(function ($contact) use ($builder) {
            $builder->whereHas('contacts', function (Builder $builder) use ($contact) {
                return $builder->where('contacts.id', $contact);
            });
        });

        return $builder;
    }

    /**
     * Scope query with any of the given contacts.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param mixed $contacts
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithAnyContacts(Builder $builder, $contacts): Builder
    {
        $contacts = $this->prepareContactIds($contacts);

        return $builder->whereHas('contacts', function (Builder $builder) use ($contacts) {
            $builder->whereIn('contacts.id', $contacts);
        });
    }

    /**
     * Scope query without any of the given contacts.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param mixed $contacts
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithoutContacts(Builder $builder, $contacts): Builder
    {
        $contacts = $this->prepareContactIds($contacts);

        return $builder->whereDoesntHave('contacts', function (Builder $builder) use ($contacts) {
            $builder->whereIn('contacts.id', $contacts);
        });
    }

    /**
     * Scope query without any contacts.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithoutAnyContacts(Builder $builder): Builder
    {
        return $builder->doesntHave('contacts');
    }

    /**
     * Determine if the model has any of the given contacts.
     *
     * @param mixed $contacts
     * @return bool
     */
    public function hasContacts($contacts): bool
    {
        $contacts = $this->prepareContactIds($contacts);

        return ! $this->contacts->pluck('id')->intersect($contacts)->isEmpty();
    }

    /**
     * Determine if the model has all of the given contacts.
     *
     * @param mixed $contacts
     * @return bool
     */
    public function hasAllContacts($contacts): bool
    {
        $contacts = $this->prepareContactIds($contacts);

        return collect($contacts)->diff($this->contacts->pluck('id'))->isEmpty();
    }

    /**
     * Sync model contacts.
     *
     * @param mixed $contacts
     * @param bool  $detaching
     * @return $this
     */
    public function syncContacts($contacts, bool $detaching = true)
    {
        // Find contacts
        $contacts = $this->prepareContactIds($contacts);

        // Sync model contacts
        $this->contacts()->sync($contacts, $detaching);

        return $this;
    }

    /**
     * Attach model contacts.
     *
     * @param mixed $contacts
     * @return $this
     */
    public function attachContacts($contacts)
    {
        return $this->syncContacts($contacts, false);
    }

    /**
     * Detach model contacts.
     *
     * @param mixed $contacts
     * @return $this
     */
    public function detachContacts($contacts = null)
    {
        $contacts = ! is_null($contacts) ? $this->prepareContactIds($contacts) : null;

        // Sync model contacts
        $this->contacts()->detach($contacts);

        return $this;
    }

    /**
     * Prepare contact IDs.
     *
     * @param mixed $contacts
     * @return array
     */
    protected function prepareContactIds($contacts): array
    {
        // Convert collection to plain array
        if ($contacts instanceof BaseCollection && is_string($contacts->first())) {
            $contacts = $contacts->toArray();
        }

        // Find contacts by their ids
        if (is_numeric($contacts) || (is_array($contacts) && is_numeric(Arr::first($contacts)))) {
            return array_map('intval', (array) $contacts);
        }

        if ($contacts instanceof Model) {
            return [$contacts->getKey()];
        }

        if ($contacts instanceof Collection) {
            return $contacts->modelKeys();
        }

        if ($contacts instanceof BaseCollection) {
            return $contacts->toArray();
        }

        return (array) $contacts;
    }
}
