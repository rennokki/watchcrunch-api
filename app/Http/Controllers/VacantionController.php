<?php

namespace App\Http\Controllers;

use App\Services\Contracts\RequestFilterInterface;
use App\Services\Contracts\VacantionInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class VacantionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  VacantionInterface  $vacantionService
     * @param  RequestFilterInterface  $requestFilterService
     * @return \Illuminate\Http\Response
     */
    public function index(
        Request $request,
        VacantionInterface $vacantionService,
        RequestFilterInterface $requestFilterService,
    ) {
        $paginationData = $request->validate([
            'limit' => ['nullable', 'numeric', 'min:20', 'max:100'],
            'offset' => ['nullable', 'numeric', 'min:0'],
        ]);

        $dataWithFilters = array_merge($request->query(), $paginationData);
        $pagination = Arr::pluck($dataWithFilters, array_keys($paginationData));

        return $vacantionService->getAllVacantions(
            pagination: $pagination,
            filtersCallback: function (Builder $builder) use ($requestFilterService, $dataWithFilters) {
                return $requestFilterService->filterForQuery($dataWithFilters, $builder);
            },
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  VacantionInterface  $vacantionService
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, VacantionInterface $vacantionService)
    {
        $data = $request->validate([
            'start' => ['required', 'date'],
            'end' => ['required', 'date', 'after:start'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        return $vacantionService->createVacation($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  VacantionInterface  $vacantionService
     * @return \Illuminate\Http\Response
     */
    public function show($id, VacantionInterface $vacantionService)
    {
        return $vacantionService->getVacantion($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  VacantionInterface  $vacantionService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, VacantionInterface $vacantionService)
    {
        $data = $request->validate([
            'start' => ['required', 'date'],
            'end' => ['required', 'date', 'after:start'],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        return $vacantionService->updateVacantion($id, $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  VacantionInterface  $vacantionService
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, VacantionInterface $vacantionService)
    {
        return $vacantionService->deleteVacantion($id);
    }
}
