<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI -->
<script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Moment -->
<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
<!-- Ekko Lightbox -->
<script src="{{ asset('backend/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- Codemirror -->
<script src="{{ asset('backend/plugins/codemirror/codemirror.js') }}"></script>
<script src="{{ asset('backend/plugins/codemirror/mode/javascript/javascript.js') }}"></script>
<!-- Bootstrap-switch -->
<script src="{{ asset('backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<!-- Daterangepicker -->
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Bootstrap 4 custom file input -->
<script src="{{ asset('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- Bootstrap Duallistbox -->
<script src="{{ asset('backend/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- JS Cookie -->
<script src="{{ asset('backend/plugins/js-cookie/js.cookie.min.js') }}"></script>
<!-- Filepond -->
<script src="{{ asset('backend/plugins/filepond/filepond.min.js') }}"></script>
<script src="{{ asset('backend/plugins/filepond/filepond-plugin-file-validate-size.min.js') }}"></script>
<script src="{{ asset('backend/plugins/filepond/filepond-plugin-file-validate-type.min.js') }}"></script>
<script src="{{ asset('backend/plugins/filepond/filepond-plugin-image-exif-orientation.min.js') }}"></script>
<script src="{{ asset('backend/plugins/filepond/filepond-plugin-image-preview.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
<script>
    bsCustomFileInput.init();
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox({
        selectorMinimalHeight: 300,
    })

    $("input[data-bootstrap-switch]").each(function() {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2();


    })

    /*DATATABLE GLOBAL FUNCTION*/
    function drawDataTable(selector, route, columns) {

        $(selector).DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: route,
            },
            columns: columns,
            pageLength: 10,
            autoWidth: !1,

        });

    }

    $(function() {

        if ($('textarea.external-scripts')[0]) {
            // CodeMirror
            CodeMirror.fromTextArea($('textarea.external-scripts')[0], {
                mode: "javascript",
                theme: "monokai"
            });
        }

    })

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-right',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        iconColor: 'white',
        customClass: {
            popup: 'colored-toast'
        },
    });

    @if (session()->has('success'))
        $(function() {
            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}",
            })
        })
    @endif

    @if (session()->has('fail'))
        $(function() {
            Toast.fire({
                icon: 'error',
                title: "{{ session('fail') }}"
            })
        })
    @endif

    //@if ($errors->any())
    //    $(function() {
    //        Toast.fire({
    //            icon: 'error',
    //           title: "Request error!"
    //       })
    //   })
    //@endif


    $("input[type=submit]:not(.ajax-submit)").on("click", function(e) {

        e.preventDefault();
        var form = $(this).closest('form');

        submitForm(form);

    });

    $("button[type=submit]:not(.ajax-submit)").on("click", function(e) {

        e.preventDefault();
        var form = $(this).closest('form');

        submitForm(form);

    });

    function submitForm(form) {
        Swal.fire({
            title: 'Are you sure?',
            //text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!',
        }).then(function(isConfirm) {

            if (isConfirm.value === true) {
                if ($('.overlay').length > 0) {
                    $('.overlay').show();
                }
                form.submit();

            } else if (isConfirm.dismiss === "cancel") {
                return false;
            }
        });
    }

    $(".image-gallery").on("click", function(e) {
        e.preventDefault();
        openImageGallery(this);
    });

    function openImageGallery(preview) {
        $(preview).ekkoLightbox();
    }
</script>
<script>
    if ($('.overlay').length > 0) {
        $('.overlay').hide();
    }
</script>
@stack('scripts')
