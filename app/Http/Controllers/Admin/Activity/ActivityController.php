<?php

namespace App\Http\Controllers\Admin\Activity;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Activity\StoreRequest;
use App\Http\Requests\Admin\Activity\UpdateRequest;
use App\Models\Category;
use App\Models\Activity;
use App\Repositories\Activity\ActivityRepository;
use App\Repositories\Activity\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ActivityController extends Controller
{

    public function __construct(Category $category, Activity $model)
    {
        $this->category = new CategoryRepository($category);
        $this->model = new ActivityRepository($model);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->model->dataTable();
        }

        return view('backend.activity.index');
    }

    public function create()
    {
        $data['categories'] = $this->category->active()->pluck('name', 'id');

        return view('backend.activity.create', $data);
    }

    public function store(StoreRequest $request)
    {
        if ($request->ajax()) {
            try {
                $data = $request->all();

                $data['status'] = $request->status ? true : false;

                if ($model = $this->model->create($data)) {

                    if ($request->has('featured_image')) {
                        $this->model->addMedia($model->id, $data['featured_image'], 'featured_image');
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
        $data['categories'] = $this->category->active()->pluck('name', 'id');
        $data['model'] = $this->model->show($id);

        return view('backend.activity.edit', $data);
    }

    public function update(UpdateRequest $request, $id)
    {
        if ($request->ajax()) {
            try {
                $data = $request->all();

                $data['status'] = $request->status ? true : false;

                if ($this->model->update($data, $id)) {

                    if ($request->has('featured_image')) {
                        $this->model->addMedia($id, $data['featured_image'], 'featured_image');
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
