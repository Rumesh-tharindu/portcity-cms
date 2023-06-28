<?php

namespace App\Http\Controllers\Admin\MasterPlan;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MasterPlan\Plot\StoreRequest;
use App\Http\Requests\Admin\MasterPlan\Plot\UpdateRequest;
use App\Models\Plan;
use App\Models\Plot;
use App\Repositories\MasterPlan\PlanRepository;
use App\Repositories\MasterPlan\PlotRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PlotController extends Controller
{

    public function __construct(Plan $plan, Plot $model)
    {
        $this->plan = new PlanRepository($plan);
        $this->model = new PlotRepository($model);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->model->dataTable();
        }

        return view('backend.master-plan.plot.index');
    }

    public function create()
    {
        $data['plans'] = $this->plan->active()->pluck('title', 'id');

        return view('backend.master-plan.plot.create', $data);
    }

    public function store(StoreRequest $request)
    {
        if ($request->ajax()) {
            try {
                $data = $request->all();

                $data['status'] = $request->status ? true : false;

                if ($model = $this->model->create($data)) {

                    if ($request->has('map_image')) {
                        $this->model->addMedia($model->id, $data['map_image'], 'map_image');
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
        $data['plans'] = $this->plan->active()->pluck('title', 'id');
        $data['model'] = $this->model->show($id);

        return view('backend.master-plan.plot.edit', $data);
    }

    public function update(UpdateRequest $request, $id)
    {
        if ($request->ajax()) {
            try {
                $data = $request->all();

                $data['status'] = $request->status ? true : false;

                if ($this->model->update($data, $id)) {

                    if ($request->has('map_image')) {
                        $this->model->addMedia($id, $data['map_image'], 'map_image');
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
