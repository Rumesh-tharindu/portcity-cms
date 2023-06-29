<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Activity\ActivityCollection;
use App\Http\Resources\V1\Activity\ActivityResource;
use App\Models\Activity;
use App\Repositories\Activity\ActivityRepository;

class ActivityController extends Controller
{

    public function __construct(Activity $model)
    {
        $this->model = new ActivityRepository($model);
    }

    public function index()
    {
        return new ActivityCollection($this->model->filter());
    }

    public function show($slug)
    {

        return new ActivityResource($this->model->getBySlug($slug)->loadMissing('category'));
    }

}
