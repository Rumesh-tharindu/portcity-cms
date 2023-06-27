<div class="btn-group">
    @can('admin.about.faq.edit')
    {!! dtEditButton(route('admin.about.faq.edit',$model)) !!}
    @endcan
    @can('admin.about.faq.destroy')
    {!! dtDeleteButton(['admin.about.faq.destroy',$model]) !!}
    @endcan
</div>
