<?php

namespace App\Repositories\Event;

use App\Repositories\Repository;
use Yajra\DataTables\DataTables;

class EventRepository extends Repository
{
    public function dataTable()
    {
        return DataTables::of($this->model::with(['media'])->get())
        ->editColumn('time_from', function ($model) {
            return \Carbon\Carbon::parse($model->time_from)->format('h:i A');
        })
        ->editColumn('time_to', function ($model) {
            return \Carbon\Carbon::parse($model->time_to)->format('h:i A');
        })
            ->editColumn('status', function ($model) {
                return view('backend.event.includes.table-status', ['model' => $model]);
            })
            ->editColumn('one_day', function ($model) {
                return view('backend.event.includes.table-days', ['model' => $model]);
            })
            ->addColumn('action', function ($model) {
                return view('backend.event.includes.table-actions', ['model' => $model]);
            })
            ->toJson();
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
