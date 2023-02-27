<?php

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface RequestFilterInterface
{
    /**
     * Filter the given query with the array of filters.
     *
     * @param  array  $filters
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filterForQuery(array $filters, Builder $builder);
}
