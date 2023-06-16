@if ($model->status)
<span class="badge badge-success">active</span>
@else
<span class="badge badge-warning">in-active</span>
@endif
@if ($model->is_key_fact)
<span class="badge badge-info">key fact document</span>
@endif