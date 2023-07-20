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

    function filepondInit(){
   // get a collection of elements with class filepond
    const inputElements = document.querySelectorAll('input.filepond');

    // loop over input elements
    Array.from(inputElements).forEach(inputElement => {

    // create a FilePond instance at the input element location
    FilePond.create(inputElement, {
    chunkUploads: true,
    onaddfilestart: () => $('.ajax-submit').prop('disabled', true),
    onprocessfiles: () => $('.ajax-submit').prop('disabled', false),

    });

    })
    }

    filepondInit();

</script>
