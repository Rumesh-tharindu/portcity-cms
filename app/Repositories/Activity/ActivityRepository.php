<?php

namespace App\Repositories\Activity;

use App\Repositories\Repository;
use Yajra\DataTables\DataTables;

class ActivityRepository extends Repository
{
    public function dataTable()
    {
        return DataTables::of($this->model::with('category')->has('category')->get())
            ->editColumn('status', function ($model) {
                return view('backend.activity.includes.table-status', ['model' => $model]);
            })
            ->addColumn('action', function ($model) {
                return view('backend.activity.includes.table-actions', ['model' => $model]);
            })->toJson();
    }

    public function active($status = true)
    {
        return $this->getModel()::active($status)->orderBy('sort')->orderBy('title')
            ->get();
    }

}
