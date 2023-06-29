<?php

namespace App\Repositories\Activity;

use App\Repositories\Repository;
use Yajra\DataTables\DataTables;

class ActivityRepository extends Repository
{
    public function dataTable()
    {
        return DataTables::of($this->model::with('category')->has('category')->get())
            ->editColumn('status', function ($model) {
                return view('backend.activity.includes.table-status', ['model' => $model]);
            })
            ->addColumn('action', function ($model) {
                return view('backend.activity.includes.table-actions', ['model' => $model]);
            })->toJson();
    }

    public function filter($status = true)
    {
        return $this->getModel()::active($status)->with(['category' , 'media' ])
        ->when(request('category'), function($q){
            $q->whereRelation('category', function($q){
                $q->active(true)->whereSlug(request('category'));
            });
        })
        ->when(request('search'), function ($q) {
                $q->where(function($q){
                    $q->where('title', 'REGEXP', request('search'))
                    ->orWhere('description', 'REGEXP', request('search'));
                });

            })
        ->latest()->paginate(request('per_page'));
    }

    public function getBySlug($slug = null)
    {
        return $this->getModel()->active(true)->whereSlug($slug)->firstOrFail();
    }

}
