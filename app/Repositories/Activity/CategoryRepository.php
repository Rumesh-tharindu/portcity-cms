<?php

namespace App\Repositories\Activity;

use App\Repositories\Repository;
use Yajra\DataTables\DataTables;

class CategoryRepository extends Repository
{
    public function dataTable()
    {
        return DataTables::of($this->model::wherePageId(3)->whereSection('activity')->get())
            ->editColumn('status', function ($model) {
                return view('backend.activity.category.includes.table-status', ['model' => $model]);
            })
            ->addColumn('action', function ($model) {
                return view('backend.activity.category.includes.table-actions', ['model' => $model]);
            })->toJson();
    }

    public function active($status = true)
    {
        return $this->getModel()::wherePageId(3)->whereSection('activity')
            ->active($status)->orderBy('sort')
            ->get();
    }

}
