<?php

namespace App\Services\Contracts;

interface VacantionInterface
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
    );

    /**
     * Get a specific vacantion by ID.
     *
     * @param  int  $id
     * @return \App\Models\Vacantion
     */
    public function getVacantion($id);

    /**
     * Get a specific vacantion by ID.
     *
     * @param  int  $id
     * @return \App\Models\Vacantion
     */
    public function createVacation(array $data);

    /**
     * Update an existing vacantion
     *
     * @param  int  $id
     * @param  array  $data
     * @return \App\Models\Vacantion
     */
    public function updateVacantion($id, array $data);

    /**
     * Delete vacantion by ID.
     *
     * @param  int  $id
     * @return bool|null
     */
    public function deleteVacantion($id);
}
