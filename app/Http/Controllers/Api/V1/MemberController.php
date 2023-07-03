<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\Member\MemberCollection;
use App\Models\Member;
use App\Repositories\About\MemberRepository;

class MemberController extends Controller
{

    public function __construct(Member $model)
    {
        $this->model = new MemberRepository($model);
    }

    public function __invoke()
    {
      return new MemberCollection($this->model->filter());
    }

}
