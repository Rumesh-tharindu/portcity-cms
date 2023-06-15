<script>
    FilePond.registerPlugin(
        FilePondPluginImagePreview,
        FilePondPluginImageExifOrientation,
        FilePondPluginFileValidateSize,
        FilePondPluginFileValidateType,
    );

    FilePond.setOptions({
        server: {
            url: "{{ config('filepond.server.url') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ @csrf_token() }}",
            }
        }
    });

    // Get a reference to the file input element
    const inputElement = document.querySelector('.filepond');

    // Create a FilePond instance
    const pond = FilePond.create(inputElement, {
        chunkUploads: true,
        onaddfilestart: () => $('.ajax-submit').prop('disabled', true),
        onprocessfiles: () => $('.ajax-submit').prop('disabled', false),

    });
</script>
