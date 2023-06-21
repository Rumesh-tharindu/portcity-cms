<?php

namespace App\Http\Controllers\Admin\PublicRegistry;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PublicRegistry\Type\StoreRequest;
use App\Http\Requests\Admin\PublicRegistry\Type\UpdateRequest;
use App\Models\Category;
use App\Repositories\PublicRegistry\TypeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PublicRegistryTypeController extends Controller
{
    public function __construct(Category $model)
    {
        $this->model = new TypeRepository($model);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->model->dataTable();
        }

        return view('backend.public-registry.type.index');
    }

    public function create()
    {
        return view('backend.public-registry.type.create');
    }

    public function store(StoreRequest $request)
    {
        if ($request->ajax()) {
            try {
                $data = $request->all();

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
        return view('backend.public-registry.type.edit', ['model' => $this->model->show($id)]);
    }

    public function update(UpdateRequest $request, $id)
    {
        if ($request->ajax()) {
            try {
                $data = $request->all();

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
