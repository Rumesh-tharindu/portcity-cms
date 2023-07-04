<?php

namespace App\Http\Controllers\Admin\CustomTable;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CustomTable\StoreRequest;
use App\Http\Requests\Admin\CustomTable\UpdateRequest;
use App\Models\CustomTable;
use App\Models\CustomTableSummary;
use App\Models\Plot;
use App\Repositories\CustomTable\CustomTableSummaryRepository;
use App\Repositories\CustomTable\CustomTableRepository;
use App\Repositories\MasterPlan\PlotRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomTableController extends Controller
{

    public function __construct(CustomTable $customTable, CustomTableSummary $model, Plot $plot)
    {
        $this->model = new CustomTableSummaryRepository($model);
        $this->customTable = new CustomTableRepository($customTable);
        $this->plot = new PlotRepository($plot);

    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->model->dataTable();
        }

        return view('backend.custom-table.index');
    }

    public function create(Request $request)
    {

        if ($request->has('product_id')) {
            $product = $this->plot->show($request->get('product_id'));

            return view('backend.custom-table.create', [
                'product' => $product,
            ]);
        }
        abort('404');

    }

    public function store(StoreRequest $request)
    {
        if ($request->ajax()) {
            try {
                $data = $request->all();

                //$data['status'] = $request->status ? true : false;

                if ($customTable = $this->customTable->create($data)) {

                    $customTableRows = [];

                    foreach ($data['custom_table_rows'] as $item) {

                        $customTableRows[] = new CustomTableSummary($item);
                    }

                    $customTable->customTableSummary()->saveMany($customTableRows);

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

        return view('backend.custom-table.edit');
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
