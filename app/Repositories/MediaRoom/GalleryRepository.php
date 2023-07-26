<?php

namespace App\Repositories\MediaRoom;

use App\Models\Gallery;
use App\Repositories\Repository;
use Illuminate\Contracts\Database\Eloquent\Builder;
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

        return $this->getModel()::with(['model' =>function ($q) use($status){
            $q->active($status)->when(request('year'), function ($q) {
                $q->where('year', request('year'));
            });
        }])->whereCollectionName('images')->whereHasMorph(
            'model',
            [Gallery::class],
            function ($q) {
                $q->active()->when(request('year'), function ($q) {
                    $q->where('year', request('year'));
                });
            }
        )
            ->when(request('category') == "video", function ($q) {
                $q->whereNotNull('custom_properties->video_url');
            })
            ->when(request('category') == "images", function ($q) {
                $q->whereNull('custom_properties->video_url');
            })
            ->orderBy('custom_properties->sort')
            ->paginate(request('per_page'));

    }

 }
