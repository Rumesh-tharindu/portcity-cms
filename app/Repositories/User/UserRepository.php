<?php

namespace App\Repositories\User;

use App\Repositories\Repository;
use Yajra\DataTables\DataTables;

class UserRepository extends Repository
{
    public function dataTable()
    {
        return DataTables::of($this->model->with('roles')->get())
            ->editColumn('roles', function ($model) {
                return view('backend.user.includes.table-roles', ['model' => $model]);
            })
            ->addColumn('action', function ($model) {
                return view('backend.user.includes.table-actions', ['model' => $model]);
            })->toJson();
    }
}
