<div class="card-body">

    {{ Form::model($model, $route) }}

    <div class="row">
        <div class="col-xs-12  col-md-6 form-group">
            {!! Form::label('role', 'Role*', ['class' => 'control-label']) !!}
            {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}

            {!! errorMessageAjax('name') !!}
        </div>

    </div>

    <label for="permissions" class="form-label">Assign Permissions*</label>

    {!! errorMessageAjax('permission') !!}

    @if (count($permissions) > 0)
        <div id="tree">
            <ul>
                @foreach ($permissions as $key => $permission)
                    @include('backend.role.includes.treeCheckbox', [
                        'key' => $key,
                        'permission' => $permission,
                    ])
                @endforeach
            </ul>
        </div>
    @endif

    {!! $model ? updateButton() : saveButton() !!}
    {!! Form::close() !!}
</div>
@push('css')
    <style>
        /* Remove default bullets */

        #tree ul {
            list-style-type: none;
            margin-left: 30px;
        }

        /* Remove margins and padding from the parent ul */
        #tree {
            margin: 0;
            padding: 0;
        }

        /* Style the caret/arrow */
        .caret {
            cursor: pointer;
            user-select: none;
            /* Prevent text selection */
        }

        /* Create the caret/arrow with a unicode, and style it */
        .caret::before {
            content: "\FF0B";
            color: black;
            display: inline-block;
            margin-right: 6px;
        }

        /* Rotate the caret/arrow icon when clicked on (using JavaScript) */
        .caret-down::before {
            content: "\FF0D";
        }

        .nested {
            display: none;
        }

        /* Show the nested list when the user clicks on the caret/arrow (with JavaScript) */
        .active {
            display: block;
        }
    </style>
@endpush
@push('scripts')
    @include('backend.theme.components.ajax-form-submit', ['redirectUrl' => 'admin.roles.index'])

    <script>
        $(document).ready(function() {
            $.extend($.expr[':'], {
                unchecked: function(obj) {
                    return ((obj.type == 'checkbox' || obj.type == 'radio') && !$(obj).is(':checked'));
                }
            });

            $("#tree input:checkbox").on('change', function() {
                $(this).next('ul').find('input:checkbox').prop('checked', $(this).prop("checked"));

                for (var i = $('#tree').find('ul').length - 1; i >= 0; i--) {
                    $('#tree').find('ul:eq(' + i + ')').prev('input:checkbox').prop('checked', function() {
                        return $(this).next('ul').find('input:unchecked').length === 0 ? true :
                            false;
                    });
                }
            });

            @isset($model)
                for (var i = $('#tree').find('ul').length - 1; i >= 0; i--) {
                    $('#tree').find('ul:eq(' + i + ')').prev('input:checkbox').prop('checked', function() {
                        return $(this).next('ul').find('input:unchecked').length === 0 ? true :
                            false;
                    });
                }
            @endisset


        });
    </script>
    <script>
        var toggler = document.getElementsByClassName("caret");
        var i;

        for (i = 0; i < toggler.length; i++) {
            toggler[i].addEventListener("click", function() {
                this.parentElement.querySelector(".nested").classList.toggle("active");
                this.classList.toggle("caret-down");
            });
        }
    </script>
@endpush
