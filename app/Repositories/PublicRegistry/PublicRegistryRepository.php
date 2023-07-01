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

    public function filter($status = true)
    {
        return $this->getModel()::active($status)->with(['category', 'media'])
        ->when(request('type'), function($q){
            $q->whereRelation('category', function($q){
                $q->active(true)->whereSlug(request('type'));
            });
        })
        ->when(request('status'), function($q){
            $q->whereStatus(request('status'));
        })
        ->when(request('search'), function ($q) {
            $q->where(function ($q) {
                $q->where('title', 'REGEXP', request('search'))
                ->orWhere('description', 'REGEXP', request('search'))
                ->orWhere('license_number', 'REGEXP', request('search'))
                ->orWhere('address', 'REGEXP', request('search'));
            });
        })
            ->orderBy('title')->paginate(request('per_page'));
    }

    public function getBySlug($slug = null)
    {
        return $this->getModel()->active(true)->whereSlug($slug)->firstOrFail();
    }

}
