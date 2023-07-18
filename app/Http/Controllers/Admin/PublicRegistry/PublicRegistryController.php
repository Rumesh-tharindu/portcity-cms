<?php

namespace App\Http\Controllers\Admin\PublicRegistry;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PublicRegistry\PublicRegistry\StoreRequest;
use App\Http\Requests\Admin\PublicRegistry\PublicRegistry\UpdateRequest;
use App\Models\Category;
use App\Models\PublicRegistry;
use App\Repositories\PublicRegistry\PublicRegistryRepository;
use App\Repositories\PublicRegistry\TypeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PublicRegistryController extends Controller
{

    public function __construct(Category $type, PublicRegistry $model)
    {
        $this->type = new TypeRepository($type);
        $this->model = new PublicRegistryRepository($model);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->model->dataTable();
        }

        return view('backend.public-registry.public-registry.index');
    }

    public function create()
    {
        $data['categories'] = $this->type->active()->pluck('name', 'id');

        return view('backend.public-registry.public-registry.create', $data);
    }

    public function store(StoreRequest $request)
    {
        if ($request->ajax()) {
            try {
                $data = $request->all();

                $data['status'] = $request->status ? true : false;

                if ($model = $this->model->create($data)) {

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
        $data['categories'] = $this->type->active()->pluck('name', 'id');
        $data['model'] = $this->model->show($id);

        return view('backend.public-registry.public-registry.edit', $data);
    }

    public function update(UpdateRequest $request, $id)
    {
        if ($request->ajax()) {
            try {
                $data = $request->all();

                $data['status'] = $request->status ? true : false;

                if ($this->model->update($data, $id)) {

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
