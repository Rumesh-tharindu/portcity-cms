<?php

namespace App\Http\Controllers\Admin\MediaRoom;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MediaRoom\Publication\StoreRequest;
use App\Http\Requests\Admin\MediaRoom\Publication\UpdateRequest;
use App\Models\Category;
use App\Models\Publication;
use App\Repositories\MediaRoom\CategoryRepository;
use App\Repositories\MediaRoom\PublicationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use RahulHaque\Filepond\Facades\Filepond;

class PublicationController extends Controller
{
    public function __construct(Publication $model, Category $category)
    {
        $this->model = new PublicationRepository($model);
        $this->category = new CategoryRepository($category);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->model->dataTable();
        }

        return view('backend.media-room.publication.index');
    }

    public function create()
    {

        return view('backend.media-room.publication.create', ['categories' => $this->category->active()->pluck('name', 'id')]);
    }

    public function store(StoreRequest $request)
    {
        if ($request->ajax()) {
            try {
                $data = $request->all();

                $data['status'] = $request->status ? true : false;

                $data['featured'] = $request->featured ? true : false;

                if ($model = $this->model->create($data)) {
                    if ($request->has('featured_image')) {
                        $this->model->addMedia($model->id, $data['featured_image'], 'featured_image');
                    }
                    if ($request->has('slider_images')) {
                        $fileInfo = Filepond::field($request->slider_images)->getFile();

                        foreach ($fileInfo as $key => $img) {
                            $customProperties['sort'] = $key;
                            $this->model->addMedia($model->id, $img, 'slider_images', $customProperties);
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
        return view('backend.media-room.publication.edit', [
            'model' => $this->model->show($id),
            'categories' => $this->category->all()->pluck('name', 'id'),
        ]);
    }

    public function update(UpdateRequest $request, $id)
    {
        if ($request->ajax()) {
            try {
                $data = $request->all();

                $data['status'] = $request->status ? true : false;

                $data['featured'] = $request->featured ? true : false;

                if ($this->model->update($data, $id)) {
                    if ($request->has('featured_image')) {
                        $this->model->addMedia($id, $data['featured_image'], 'featured_image');
                    }

                    if ($request->has('slider_images')) {
                        $fileInfo = Filepond::field($request->slider_images)->getFile();

                        foreach ($fileInfo as $key => $img) {
                            $customProperties['sort'] = $key;
                            $this->model->addMedia($id, $img, 'slider_images', $customProperties);
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
