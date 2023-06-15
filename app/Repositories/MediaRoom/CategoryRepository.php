<?php

namespace App\Repositories\MediaRoom;

use App\Repositories\Repository;
use Yajra\DataTables\DataTables;

class CategoryRepository extends Repository
{
    public function dataTable()
    {
        return DataTables::of($this->model::wherePageId(6)->get())
            ->editColumn('status', function ($model) {
                return view('backend.media-room.publication.category.includes.table-status', ['model' => $model]);
            })
            ->addColumn('action', function ($model) {
                return view('backend.media-room.publication.category.includes.table-actions', ['model' => $model]);
            })->toJson();
    }

    public function active($status = true)
    {
        return $this->getModel()::wherePageId(6)
            ->active($status)->orderBy('sort')
            ->get();
    }

}
