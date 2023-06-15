<script>
    $(document).ready(function() {

        var lfm = function(options, cb) {
            var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
            window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager',
                'width=900,height=600');
            window.SetUrl = cb;
        };

        var LFMButton = function(context) {
            var ui = $.summernote.ui;
            var button = ui.button({
                contents: '<i class="note-icon-picture"></i> ',
                tooltip: 'Insert image with filemanager',
                click: function() {

                    lfm({
                        type: 'image',
                        prefix: '/filemanager'
                    }, function(lfmItems, path) {
                        lfmItems.forEach(function(lfmItem) {
                            context.invoke('insertImage', lfmItem.url);
                        });
                    });

                }
            });
            return button.render();
        };

        $('.summernote').summernote({
            // height: 450,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                //['fontname', ['fontname']],
                ['color', ['color']],
                ['popovers', ['lfm']],
                ['para', ['ul', 'ol', 'paragraph']],
                // ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'video']],
                ['view', ['undo', 'redo', 'fullscreen', 'codeview']],
                ['help', ['help']]
            ],
            popover: {
                table: [
                    // ['custom', ['tableHeaders']],
                    ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight', 'toggle']],
                    ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],

                ],
            },
            buttons: {
                //lfm: LFMButton
            }
        });
    });
</script>
