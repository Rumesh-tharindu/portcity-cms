<div class="btn-group">
    @can('admin.master-plan.plan.edit')
    {!! dtEditButton(route('admin.master-plan.plan.edit',$model)) !!}
    @endcan
    @can('admin.master-plan.plan.destroy')
    {!! dtDeleteButton(['admin.master-plan.plan.destroy',$model]) !!}
    @endcan
</div>
