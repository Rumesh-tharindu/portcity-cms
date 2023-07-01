<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Category\CategoryCollection;
use App\Http\Resources\V1\Category\CategoryResource;
use App\Http\Resources\V1\PublicRegistry\PublicRegistryCollection;
use App\Http\Resources\V1\PublicRegistry\PublicRegistryResource;
use App\Models\Category;
use App\Models\PublicRegistry;
use App\Repositories\PublicRegistry\TypeRepository;
use App\Repositories\PublicRegistry\PublicRegistryRepository;

class PublicRegistryController extends Controller
{

    public function __construct(Category $type, PublicRegistry $model)
    {
        $this->type = new TypeRepository($type);
        $this->model = new PublicRegistryRepository($model);
    }

    public function index()
    {
        $collection = $this->model->filter();

        return new PublicRegistryCollection($collection);
    }

    public function show($slug)
    {

        return new PublicRegistryResource($this->model->getBySlug($slug)->loadMissing('category'));
    }


    public function types()
    {

        $collection = $this->type->active();
        return new CategoryCollection($collection);
    }
}
