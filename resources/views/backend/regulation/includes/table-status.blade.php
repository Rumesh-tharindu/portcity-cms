@if ($model->featured)
<span class="badge badge-primary">featured</span>
@endif
@if ($model->status)
<span class="badge badge-success">active</span>
@else
<span class="badge badge-warning">in-active</span>
@endif
