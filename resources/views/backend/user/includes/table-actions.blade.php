<div class="btn-group">
    {!! dtEditButton(route('admin.users.edit',$model)) !!}
    @if ($model->id != auth()->id())
    {!! dtDeleteButton(['admin.users.destroy',$model]) !!}
    @endif

    @if (is_null($model->email_verified_at) && Route::has('admin.users.sendEmailVerificationNotification'))
    {!! dtEmailButton(['admin.users.sendEmailVerificationNotification',$model]) !!}
    @endif

</div>
