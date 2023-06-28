<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PublicationCollection;
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

        return PublicationCollection::collection($this->model->filter());
    }

    public function show($slug)
    {

        return PublicationCollection::collection($this->model->getBySlug($slug));
    }

}
