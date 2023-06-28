<?php

namespace App\Repositories\MasterPlan;

use App\Repositories\Repository;
use Yajra\DataTables\DataTables;

class PlanRepository extends Repository
{
    public function dataTable()
    {
        return DataTables::of($this->model::all())
            ->editColumn('status', function ($model) {
                return view('backend.master-plan.plan.includes.table-status', ['model' => $model]);
            })
            ->addColumn('action', function ($model) {
                return view('backend.master-plan.plan.includes.table-actions', ['model' => $model]);
            })->toJson();
    }

    public function active($status = true)
    {
        return $this->getModel()::active($status)->orderBy('sort')->orderBy('title')
            ->get();
    }

}
