<script>
    $(document).ready(function() {

        $('.summernote').summernote({
            callbacks: {
                onPaste: function (e) {
                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

                e.preventDefault();

                // Firefox fix
                setTimeout(function () {
                document.execCommand('insertText', false, bufferText);
                }, 10);
                }
                },
            toolbar: [
                ['table', ['table']],
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