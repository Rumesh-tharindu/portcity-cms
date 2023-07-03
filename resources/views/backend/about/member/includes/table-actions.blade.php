<div class="btn-group">
    @can('admin.about.member.edit')
    {!! dtEditButton(route('admin.about.member.edit',$model)) !!}
    @endcan
    @can('admin.about.member.destroy')
    {!! dtDeleteButton(['admin.about.member.destroy',$model]) !!}
    @endcan
</div>
