<?php

namespace App\Repositories\Role;

use App\Repositories\Repository;
use Yajra\DataTables\DataTables;

class RoleRepository extends Repository
{
    public function dataTable()
    {
        return DataTables::of($this->model->with('permissions')->get())
            ->editColumn('permissions', function ($model) {
                return view('backend.role.includes.table-permissions', ['model' => $model]);
            })
            ->addColumn('action', function ($model) {
                return view('backend.role.includes.table-actions', ['model' => $model]);
            })->toJson();
    }
}
