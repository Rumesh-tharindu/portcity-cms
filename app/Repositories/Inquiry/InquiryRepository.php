<?php

namespace App\Repositories\Inquiry;

use App\Repositories\Repository;
use Yajra\DataTables\DataTables;

class InquiryRepository extends Repository
{
    public function dataTable()
    {
        return DataTables::of($this->model::with('inquiry')->latest())
            ->editColumn('created_at', function ($model) {
                return $model->created_at->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function ($model) {
                return view('backend.inquiry.includes.table-actions', ['model' => $model]);
            })->toJson();
    }

}
