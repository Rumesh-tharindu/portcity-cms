<?php

namespace App\Repositories\PublicRegistry;

use App\Repositories\Repository;
use Yajra\DataTables\DataTables;

class PublicRegistryRepository extends Repository
{
    public function dataTable()
    {
        return DataTables::of($this->model::with('category')->has('category')->get())
            ->editColumn('status', function ($model) {
                return view('backend.public-registry.public-registry.includes.table-status', ['model' => $model]);
            })
            ->addColumn('action', function ($model) {
                return view('backend.public-registry.public-registry.includes.table-actions', ['model' => $model]);
            })->toJson();
    }

    public function active($status = 'active')
    {
        return $this->getModel()::active($status)->orderBy('sort')->orderBy('title')
            ->get();
    }

}
