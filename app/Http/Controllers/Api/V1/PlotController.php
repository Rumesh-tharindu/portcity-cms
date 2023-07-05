<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\MasterPlan\PlotCollection;
use App\Http\Resources\V1\MasterPlan\PlotResource;
use App\Models\Plan;
use App\Models\Plot;
use App\Repositories\MasterPlan\PlotRepository;

class PlotController extends Controller
{

    public function __construct(Plot $model)
    {
        $this->model = new PlotRepository($model);
    }

    public function index()
    {
        return new PlotCollection($this->model->filter());
    }

    public function show($slug)
    {

        return new PlotResource($this->model->getBySlug($slug)->loadMissing(['plan', 'customTables']));
    }

}
