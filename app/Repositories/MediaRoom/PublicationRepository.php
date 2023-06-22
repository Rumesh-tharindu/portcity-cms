<?php

namespace App\Repositories\MediaRoom;

use App\Repositories\Repository;
use Yajra\DataTables\DataTables;

class PublicationRepository extends Repository
{
    public function dataTable()
    {
        return DataTables::of($this->model::with('category')->get())
            ->editColumn('status', function ($model) {
                return view('backend.media-room.publication.includes.table-status', ['model' => $model]);
            })
            ->addColumn('action', function ($model) {
                return view('backend.media-room.publication.includes.table-actions', ['model' => $model]);
            })->toJson();
    }

 }
