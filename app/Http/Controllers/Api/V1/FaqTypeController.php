<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\FaqType\FaqTypeCollection;
use App\Models\FaqType;
use App\Repositories\About\FaqTypeRepository;

class FaqTypeController extends Controller
{

    public function __construct(FaqType $model)
    {
        $this->model = new FaqTypeRepository($model);
    }

    public function __invoke()
    {
      return new FaqTypeCollection($this->model->filter());
    }

}
