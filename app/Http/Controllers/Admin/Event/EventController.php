<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Event\StoreRequest;
use App\Http\Requests\Admin\Event\UpdateRequest;
use App\Models\Event;
use App\Repositories\Event\EventRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use RahulHaque\Filepond\Facades\Filepond;

class EventController extends Controller
{

    public function __construct(Event $model)
    {
        $this->model = new EventRepository($model);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->model->dataTable();
        }

        return view('backend.event.index');
    }

    public function create()
    {

        return view('backend.event.create');
    }

    public function store(StoreRequest $request)
    {
        if ($request->ajax()) {
            try {
                $data = $request->all();

                $data['status'] = $request->status ? true : false;

                if(Carbon::parse($request->date_from)->eq(Carbon::parse($request->date_to))){
                    $data['one_day'] = true;

                 }else{
                    $data['one_day'] = false;

                 }

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
        $data['model'] = $this->model->show($id);

        return view('backend.event.edit', $data);
    }

    public function update(UpdateRequest $request, $id)
    {
        if ($request->ajax()) {
            try {
                $data = $request->all();

                $data['status'] = $request->status ? true : false;

                if(Carbon::parse($request->date_from)->eq(Carbon::parse($request->date_to))){
                    $data['one_day'] = true;

                 }else{
                    $data['one_day'] = false;

                 }

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
