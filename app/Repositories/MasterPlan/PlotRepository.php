<?php

namespace App\Repositories\MasterPlan;

use App\Repositories\Repository;
use Yajra\DataTables\DataTables;

class PlotRepository extends Repository
{
    public function dataTable()
    {
        return DataTables::of($this->model::with('plan')->get())
            ->editColumn('status', function ($model) {
                return view('backend.master-plan.plot.includes.table-status', ['model' => $model]);
            })
            ->addColumn('action', function ($model) {
                return view('backend.master-plan.plot.includes.table-actions', ['model' => $model]);
            })->toJson();
    }

    public function active($status = true)
    {
        return $this->getModel()::active($status)->orderBy('sort')->orderBy('title')
            ->get();
    }

}
