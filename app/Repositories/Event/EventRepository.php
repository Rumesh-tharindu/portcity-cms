<?php

namespace App\Repositories\Event;

use App\Repositories\Repository;
use Yajra\DataTables\DataTables;

class EventRepository extends Repository
{
    public function dataTable()
    {
        return DataTables::of($this->model::with(['media'])->get())
            ->editColumn('status', function ($model) {
                return view('backend.event.includes.table-status', ['model' => $model]);
            })
            ->addColumn('action', function ($model) {
                return view('backend.event.includes.table-actions', ['model' => $model]);
            })->toJson();
    }

    public function filter($status = true)
    {
        return $this->getModel()::active($status)->with(['media' ])
        ->when(request('search'), function ($q) {
                $q->where(function($q){
                    $q->where('title', 'REGEXP', request('search'))
                    ->orWhere('description', 'REGEXP', request('search'))
                    ->orWhere('location', 'REGEXP', request('search'))
                    ->orWhere('ticket', 'REGEXP', request('search'));
                });

            })
        ->latest()->paginate(request('per_page'));
    }

    public function getBySlug($slug = null)
    {
        return $this->getModel()->active(true)->whereSlug($slug)->firstOrFail();
    }

}