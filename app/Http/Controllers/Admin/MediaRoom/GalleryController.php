<?php

namespace App\Http\Controllers\Admin\MediaRoom;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MediaRoom\Gallery\StoreRequest;
use App\Http\Requests\Admin\MediaRoom\Gallery\UpdateRequest;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Publication;
use App\Repositories\MediaRoom\CategoryRepository;
use App\Repositories\MediaRoom\GalleryRepository;
use App\Repositories\MediaRoom\PublicationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RahulHaque\Filepond\Facades\Filepond;

class GalleryController extends Controller
{
    public function __construct(Gallery $model)
    {
        $this->model = new GalleryRepository($model);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->model->dataTable();
        }

        return view('backend.media-room.gallery.index');
    }

    public function create()
    {

        return view('backend.media-room.gallery.create');
    }

    public function store(StoreRequest $request)
    {
        if ($request->ajax()) {
            try {
                $data = $request->all();

                $data['status'] = $request->status ? true : false;

                if ($model = $this->model->create($data)) {

                    if ($request->has('gallery')) {
                        foreach ($data['gallery'] as $item) {
                            if (isset($item['image'])) {
                            $fileInfo = Filepond::field($item['image'])->getFile();
                            $customProperties['sort'] = $item['sort'];
                            $customProperties['video_url'] = $item['video_url'];
                            $this->model->addMedia($model->id, $fileInfo, 'images', $customProperties);
                            }
                        }
                    }

                    $request->session()->flash('success', 'Success!');

                    return response()->json(['message' => 'Success!']);
                }

                return response()->json(['message' => 'Not Found!'], 404);
            } catch (\Exception $e) {
                Log::error($e->getMessage());

                return response()->json(['message' => 'Error!'], 400);
            }
        }

        return abort(400);
    }

    public function edit($id)
    {
        return view('backend.media-room.gallery.edit', [
            'model' => $this->model->show($id),
        ]);
    }

    public function update(UpdateRequest $request, $id)
    {
        if ($request->ajax()) {
            try {
                $data = $request->all();

                $data['status'] = $request->status ? true : false;

                if ($this->model->update($data, $id)) {

                    if ($request->has('gallery')) {

                        $medias = $this->model->getMedia('images');

                        $medias_ids = $medias->pluck('id');

                        foreach ($data['gallery'] as $item) {

                            $customProperties['sort'] = $item['sort'];
                            $customProperties['video_url'] = $item['video_url'];

                            if(isset($item['image'])){
                                $fileInfo = Filepond::field($item['image'])->getFile();

                                $this->model->addMedia($id, $fileInfo, 'images', $customProperties);

                                if(isset($item['media_id'])){
                                    foreach ($medias as $media) {
                                        if ($media->id == $item['media_id']) {
                                            $media->delete();
                                        }
                                    }
                                }

                            }elseif(isset($item['media_id']) && !isset($item['image'])) {
                                foreach($medias as $media){
                                    if($media->id == $item['media_id']){
                                      $media->custom_properties = $customProperties;
                                      $media->save();
                                    }
                                }
                            }

                        }
                    }

                    $request->session()->flash('success', 'Success!');

                    return response()->json(['message' => 'Success!']);
                }

                return response()->json(['message' => 'Not Found!'], 404);
            } catch (\Exception $e) {
                Log::error($e->getMessage());

                return response()->json(['message' => 'Error!'], 400);
            }
        }

        return abort(400);
    }

    public function destroy($id)
    {
        try {
            if ($this->model->delete($id)) {
                return redirect()->back()->withSuccess('Success!');
            }

            return redirect()->back()->withFail('Failed!');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return redirect()->back()->withFail('Failed!');
        }
    }
}
