<?php

namespace App\Repositories\CustomTable;

use App\Repositories\Repository;
use Yajra\DataTables\DataTables;

class CustomTableRepository extends Repository
{
    public function dataTable()
    {
        return DataTables::of($this->model::get())
            ->editColumn('status', function ($model) {
                return view('backend.custom-table.includes.table-status', ['model' => $model]);
            })
            ->addColumn('action', function ($model) {
                return view('backend.custom-table.includes.table-actions', ['model' => $model]);
            })->toJson();
    }

}
