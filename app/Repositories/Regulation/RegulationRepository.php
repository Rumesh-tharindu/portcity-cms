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

    public function active($status = true)
    {
        return $this->getModel()::active($status)->orderBy('sort')->orderBy('title')
            ->get();
    }

}
