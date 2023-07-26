<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Gallery\MediaCollection;
use App\Repositories\MediaRoom\GalleryRepository;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class GalleryController extends Controller
{

    public function __construct(Media $model)
    {
        $this->model = new GalleryRepository($model);
    }

    public function __invoke()
    {
      return new MediaCollection($this->model->filter());
    }

}
