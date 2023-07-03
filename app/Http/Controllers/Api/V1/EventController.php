<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Event\EventCollection;
use App\Http\Resources\V1\Event\EventResource;
use App\Models\Event;
use App\Models\Faq;
use App\Repositories\Event\EventRepository;

class EventController extends Controller
{

    public function __construct(Event $model)
    {
        $this->model = new EventRepository($model);
    }

    public function index()
    {
      return new EventCollection($this->model->filter());
    }

    public function show($slug)
    {
        $model = $this->model->getBySlug($slug);

        return new EventResource($model);
    }

}
