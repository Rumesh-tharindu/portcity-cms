<?php

namespace App\Repositories\MediaRoom;

use App\Repositories\Repository;
use Yajra\DataTables\DataTables;

class GalleryRepository extends Repository
{
    public function dataTable()
    {
        return DataTables::of($this->model::orderBy('year')->get())
            ->editColumn('status', function ($model) {
                return view('backend.media-room.gallery.includes.table-status', ['model' => $model]);
            })
            ->addColumn('action', function ($model) {
                return view('backend.media-room.gallery.includes.table-actions', ['model' => $model]);
            })->toJson();
    }

 }
