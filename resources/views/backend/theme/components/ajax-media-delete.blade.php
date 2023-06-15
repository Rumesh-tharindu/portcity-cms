<script>
    $(document).ready(function() {
        $('.ajax-media-delete').on('click', function(e) {

            e.preventDefault();
            var submitTxt = $(".ajax-media-delete", this).text();
            var that = this;
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

                    $(".ajax-media-delete", that).text('Deleting...').attr("disabled", true);
                    $('.overlay').show();

                    $.ajax({
                        url: $(that).attr('href'),
                        type: 'DELETE',
                        dataType: 'JSON',
                        data: {
                            'id': $(that).data("id"),
                            '_token': $("meta[name='csrf-token']").attr("content"),
                        },
                        success: function(response) {

                            window.location.href = "{{ url()->current() }}";

                        },
                        error: function(response) {

                            Toast.fire({
                                icon: 'error',
                                title: response.responseJSON.message ??
                                    "Failed!"
                            })

                        },
                        complete: function() {
                            $('.overlay').hide();
                            $(".ajax-media-delete", that).text(submitTxt).attr(
                                "disabled",
                                false);

                        }
                    });
                } else if (isConfirm.dismiss === "cancel") {
                    return false;
                }
            });

        });
    });
</script>
