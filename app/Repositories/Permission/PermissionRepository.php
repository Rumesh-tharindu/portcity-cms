<?php

namespace App\Repositories\Permission;

use App\Repositories\Repository;
use Yajra\DataTables\DataTables;

class PermissionRepository extends Repository
{
    public function dataTable()
    {
        return DataTables::of($this->model)
            ->addColumn('action', function ($model) {
                return view('backend.permission.includes.table-actions', ['model' => $model]);
            })->toJson();
    }
}
