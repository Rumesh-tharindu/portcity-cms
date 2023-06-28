<div class="btn-group">
    @can('admin.master-plan.plot.edit')
    {!! dtEditButton(route('admin.master-plan.plot.edit',$model)) !!}
    @endcan
    @can('admin.master-plan.plot.destroy')
    {!! dtDeleteButton(['admin.master-plan.plot.destroy',$model]) !!}
    @endcan
</div>
