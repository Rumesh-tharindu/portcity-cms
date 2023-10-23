<div class="btn-group">
    @can('admin.about.faq.faq.edit')
    {!! dtEditButton(route('admin.about.faq.faq.edit',$model)) !!}
    @endcan
    @can('admin.about.faq.faq.destroy')
    {!! dtDeleteButton(['admin.about.faq.faq.destroy',$model]) !!}
    @endcan
</div>
