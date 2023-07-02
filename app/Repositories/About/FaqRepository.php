<?php

namespace App\Repositories\About;

use App\Repositories\Repository;
use Yajra\DataTables\DataTables;

class FaqRepository extends Repository
{
    public function dataTable()
    {
        return DataTables::of($this->model->orderBy('sort')->get())
            ->editColumn('status', function ($model) {
                return view('backend.about.faq.includes.table-status', ['model' => $model]);
            })
            ->addColumn('action', function ($model) {
                return view('backend.about.faq.includes.table-actions', ['model' => $model]);
            })->toJson();
    }

    public function filter($status = true)
    {
        return $this->getModel()::active($status)->when(request('search'), function ($q) {
            $q->where(function ($q) {
                $q->where('question', 'REGEXP', request('search'))
                ->orWhere('answer', 'REGEXP', request('search'));
            });
        })->orderBy('sort')->get();
    }

}
