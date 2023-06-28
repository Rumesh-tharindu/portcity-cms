<?php

namespace App\Repositories\MediaRoom;

use App\Repositories\Repository;
use Yajra\DataTables\DataTables;

class PublicationRepository extends Repository
{
    public function dataTable()
    {
        return DataTables::of($this->model::with('category')->has('category')->get())
            ->editColumn('status', function ($model) {
                return view('backend.media-room.publication.includes.table-status', ['model' => $model]);
            })
            ->addColumn('action', function ($model) {
                return view('backend.media-room.publication.includes.table-actions', ['model' => $model]);
            })->toJson();
    }

    public function filter($status = true)
    {
        return $this->getModel()::with('category')->active($status)
        ->when(request('category'), function($q){
            $q->whereRelation('category', function($q){
                $q->active(true)->whereSlug(request('category'));
            });
        })
        ->when(request('search'), function ($q) {
                $q
                ->where('title', 'REGEXP', request('search'))
                ->orWhere('source', 'REGEXP', request('search'))
                ->orWhere('summary', 'REGEXP', request('search'))
                ->orWhere('description', 'REGEXP', request('search'));
            })
        ->when(request('sort'), function ($q) {
                $q->orderBy('sort', request('sort'));
            })
        ->get();
    }

    public function getBySlug($slug = null)
    {
        return $this->getModel()->active(true)->whereSlug($slug)->firstOrFail();
    }

 }
