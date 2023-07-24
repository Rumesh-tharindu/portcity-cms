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

    public function filter($status = true)
    {
        return $this->getModel()::active($status)->with(['media' => function ($q) {
            $q->when(request('category') == "video", function ($q) {
                $q->whereCollectionName('images')->whereNotNull('custom_properties->video_url');
            })
                ->when(request('category') == "images", function ($q) {
                    $q->whereCollectionName('images')->whereNull('custom_properties->video_url');
                });
        }])
        ->when(request('year'), function ($q) {
            $q->where('year', request('year'));
        })
        ->when(request('category') == "video", function ($q) {
            $q->whereRelation('media', function ($q) {
                $q->whereCollectionName('images')->whereNotNull('custom_properties->video_url');
            });
        })
        ->when(request('category') == "images", function ($q) {
            $q->whereRelation('media', function ($q) {
                $q->whereCollectionName('images')->whereNull('custom_properties->video_url');
            });
        })
        ->latest('year')
        ->paginate(request('per_page'));
    }

 }
