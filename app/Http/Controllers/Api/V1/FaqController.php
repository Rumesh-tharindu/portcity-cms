<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Faq\FaqCollection;
use App\Models\Faq;
use App\Repositories\About\FaqRepository;

class FaqController extends Controller
{

    public function __construct(Faq $model)
    {
        $this->model = new FaqRepository($model);
    }

    public function __invoke()
    {
      return new FaqCollection($this->model->filter());
    }

}
