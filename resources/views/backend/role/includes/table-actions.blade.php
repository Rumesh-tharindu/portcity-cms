<div class="btn-group">

    @if ($model->name != 'Super Admin')
        {!! dtEditButton(route('admin.roles.edit', $model)) !!}
    @endif

    @unlessrole($model->name)
        {!! dtDeleteButton(['admin.roles.destroy', $model]) !!}
    @endunlessrole

</div>
