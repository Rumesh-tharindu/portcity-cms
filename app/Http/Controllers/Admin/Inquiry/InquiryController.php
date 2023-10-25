<?php

namespace App\Http\Controllers\Admin\Inquiry;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Repositories\Inquiry\InquiryRepository;
use Illuminate\Http\Request;

class InquiryController extends Controller
{

    public function __construct(Inquiry $model)
    {
        $this->model = new InquiryRepository($model);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->model->dataTable();
        }

        return view('backend.inquiry.index');
    }

    public function show($id)
    {
        $data['inquiry'] =  $this->model->show($id);

        return view('backend.inquiry.show', $data);
    }

}
