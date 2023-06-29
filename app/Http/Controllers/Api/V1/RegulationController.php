<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Regulation\RegulationCollection;
use App\Models\Regulation;
use App\Repositories\Regulation\RegulationRepository;

class RegulationController extends Controller
{

    public function __construct(Regulation $model)
    {
        $this->model = new RegulationRepository($model);
    }

    public function __invoke()
    {
      return new RegulationCollection($this->model->filter());
    }

}
