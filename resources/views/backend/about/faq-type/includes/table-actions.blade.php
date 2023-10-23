<div class="btn-group">
    @can('admin.about.faq.type.edit')
    {!! dtEditButton(route('admin.about.faq.type.edit',$model)) !!}
    @endcan
    @can('admin.about.faq.destroy')
    {!! dtDeleteButton(['admin.about.faq.type.destroy',$model]) !!}
    @endcan
</div>
