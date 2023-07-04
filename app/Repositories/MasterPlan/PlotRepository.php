<?php

namespace App\Repositories\MasterPlan;

use App\Repositories\Repository;
use Yajra\DataTables\DataTables;

class PlotRepository extends Repository
{
    public function dataTable()
    {
        return DataTables::of($this->model::with('plan')->get())
            ->editColumn('status', function ($model) {
                return view('backend.master-plan.plot.includes.table-status', ['model' => $model]);
            })
            ->addColumn('action', function ($model) {
                return view('backend.master-plan.plot.includes.table-actions', ['model' => $model]);
            })->toJson();
    }

    public function filter($status = true)
    {
        return $this->getModel()::active($status)->with(['plan', 'media'])->when(request('search'), function ($q) {
            $q->where(function ($q) {
                $q->where('title', 'REGEXP', request('search'))
                ->orWhere('description', 'REGEXP', request('search'))
                ->orWhere('plot_number', 'REGEXP', request('search'));
            });
        })
            ->orderBy('title')
            ->get();
    }

    public function getBySlug($slug = null)
    {
        return $this->getModel()->active(true)->whereSlug($slug)->firstOrFail();
    }

}
