<?php

namespace App\Repositories\Regulation;

use App\Repositories\Repository;
use Yajra\DataTables\DataTables;

class RegulationRepository extends Repository
{
    public function dataTable()
    {
        return DataTables::of($this->model::all())
            ->editColumn('status', function ($model) {
                return view('backend.regulation.includes.table-status', ['model' => $model]);
            })
            ->addColumn('action', function ($model) {
                return view('backend.regulation.includes.table-actions', ['model' => $model]);
            })->toJson();
    }

    public function filter($status = true)
    {
        return $this->getModel()::active($status)->with(['media'])->when(request('search'), function ($q) {
            $q->where(function ($q) {
                $q->where('title', 'REGEXP', request('search'))
                ->orWhere('description', 'REGEXP', request('search'));
            });
        })
        ->when(request('featured'), function ($q) {
            $q
            ->whereFeatured(request('featured'));
        })
            ->orderBy('sort')->get();
    }

}
