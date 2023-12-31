<?php

namespace App\Repositories\About;

use App\Repositories\Repository;
use Yajra\DataTables\DataTables;

class MemberRepository extends Repository
{
    public function dataTable()
    {
        return DataTables::of($this->model->orderBy('sort')->get())
            ->editColumn('status', function ($model) {
                return view('backend.about.member.includes.table-status', ['model' => $model]);
            })
            ->addColumn('action', function ($model) {
                return view('backend.about.member.includes.table-actions', ['model' => $model]);
            })->toJson();
    }

    public function filter($status = true)
    {
        return $this->getModel()::active($status)->when(request('search'), function ($q) {
            $q->where(function ($q) {
                $q->where('name', 'REGEXP', request('search'))
                ->orWhere('designation', 'REGEXP', request('search'));
            });
        })
        ->orderBy('sort')
        ->paginate(request('per_page'));
    }

}
