@if (!is_array($permission))
    <li>

        <input type="checkbox" name="permission[{{ $permission }}]" value="{{ $permission }}"
            {{ isset($rolePermissions) ? (in_array($permission, $rolePermissions) ? 'checked' : '') : null }}>

        {{ empty($key) ? 'index' : $key }}

    </li>
@endif

@if (is_array($permission) && count($permission) > 0)
    <li><span
            class="caret @isset($model)caret-down @endif"></span>
        @if (is_string($key))


            @if ($key == 'admin')
                <input type="checkbox">

                All Permissions
            @else
                <input type="checkbox">

                {{ str_replace(['unisharp', 'lfm'], ['file-manager', 'methods'], $key) }}
            @endif

        @endif

        <ul class="nested @isset($model)active @endif">
            @foreach ($permission as $k => $perm)
                @include('backend.role.includes.treeCheckbox', ['key' => $k, 'permission' => $perm])
            @endforeach
            </ul>

    </li>
@endif
