<?php

namespace App\Services;

use App\Services\Contracts\RequestFilterInterface;
use Illuminate\Database\Eloquent\Builder;

class RequestFilterService implements RequestFilterInterface
{
    /**
     * The list of tokens to apply to query
     * based on their wording.
     *
     * @var array
     */
    protected static $tokens = [
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
        'lte' => '<=',
        'gte' => '>=',
    ];

    /**
     * Filter the given query with the array of filters.
     *
     * @param  array  $filters
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function filterForQuery(array $filters, Builder $builder)
    {
        foreach ($filters as $field => $conditions) {
            foreach ($conditions as $operator => $value) {
                $builder = $builder->where(
                    column: $field,
                    operator: static::$tokens[$operator] ?? '=',
                    value: $value,
                );
            }
        }

        return $builder;
    }
}
