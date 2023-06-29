<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\MasterPlan\PlanCollection;
use App\Models\Plan;
use App\Repositories\MasterPlan\PlanRepository;

class MasterPlanController extends Controller
{

    public function __construct(Plan $model)
    {
        $this->model = new PlanRepository($model);
    }

    public function index()
    {
        return new PlanCollection($this->model->filter());
    }

    public function show($slug)
    {

        return new PlanCollection($this->model->getBySlug($slug));
    }

}
