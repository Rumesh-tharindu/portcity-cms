<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Gallery\GalleryCollection;
use App\Models\Faq;
use App\Models\Gallery;
use App\Repositories\MediaRoom\GalleryRepository;

class GalleryController extends Controller
{

    public function __construct(Gallery $model)
    {
        $this->model = new GalleryRepository($model);
    }

    public function __invoke()
    {
      return new GalleryCollection($this->model->filter());
    }

}
