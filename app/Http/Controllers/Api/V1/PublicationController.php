<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Publication\PublicationCollection;
use App\Http\Resources\V1\Publication\PublicationResource;
use App\Models\Publication;
use App\Repositories\MediaRoom\PublicationRepository;

class PublicationController extends Controller
{

    public function __construct(Publication $model)
    {
        $this->model = new PublicationRepository($model);
    }

    public function index()
    {
        return new PublicationCollection($this->model->filter());
    }

    public function show($slug)
    {

        return new PublicationResource($this->model->getBySlug($slug)->loadMissing('category'));
    }

}
