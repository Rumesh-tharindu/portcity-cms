<?php

namespace App\Repositories\PublicRegistry;

use App\Repositories\Repository;
use Yajra\DataTables\DataTables;

class TypeRepository extends Repository
{
    public function dataTable()
    {
        return DataTables::of($this->model::wherePageId(2)->whereSection('public-registry')->get())
            ->editColumn('status', function ($model) {
                return view('backend.public-registry.type.includes.table-status', ['model' => $model]);
            })
            ->addColumn('action', function ($model) {
                return view('backend.public-registry.type.includes.table-actions', ['model' => $model]);
            })->toJson();
    }

    public function active($status = true)
    {
        return $this->getModel()::wherePageId(2)->whereSection('public-registry')
            ->active($status)->orderBy('sort')->orderBy('name')
            ->get();
    }

}
