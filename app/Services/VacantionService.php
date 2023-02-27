<?php

namespace App\Services;

use App\Models\Vacantion;
use App\Services\Contracts\VacantionInterface;
use Illuminate\Database\Eloquent\Builder;

class VacantionService implements VacantionInterface
{
    /**
     * Get all vacantions.
     *
     * @param  array  $pagination
     * @param  callable|null  $filtersCallback
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllVacantions(
        array $pagination = [],
        callable $filtersCallback = null,
    ) {
        return Vacantion::query()
            ->limit($pagination['limit'] ?? 20)
            ->offset($pagination['offset'] ?? 0)
            ->when($filtersCallback, function (Builder $builder, $callback) {
                return $callback($builder);
            })
            ->get();
    }

    /**
     * Get a specific vacantion by ID.
     *
     * @param  int  $id
     * @return \App\Models\Vacantion
     */
    public function getVacantion($id)
    {
        return Vacantion::findOrFail($id);
    }

    /**
     * Create a new vacantion.
     *
     * @param  array  $data
     * @return \App\Models\Vacantion
     */
    public function createVacation(array $data)
    {
        return Vacantion::create($data);
    }

    /**
     * Update an existing vacantion
     *
     * @param  int  $id
     * @param  array  $data
     * @return \App\Models\Vacantion
     */
    public function updateVacantion($id, array $data)
    {
        $vacantion = $this->getVacantion($id);

        $vacantion->update($data);

        return $vacantion;
    }

    /**
     * Delete vacantion by ID.
     *
     * @param  int  $id
     * @return bool|null
     */
    public function deleteVacantion($id)
    {
        return $this->getVacantion($id)->delete();
    }
}
