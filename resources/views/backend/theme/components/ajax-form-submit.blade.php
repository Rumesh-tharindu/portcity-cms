<script>
    $(document).ready(function() {
        $('.ajax-form').on('submit', function(e) {

            e.preventDefault();
            var submitTxt = $(".ajax-submit", this).val();
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

                    $(".ajax-submit", that).val('Saving...').attr("disabled", true);
                    $('.overlay').show();
                    $("p.error").text('');
                    $.ajax({
                        url: $(that).attr('action'),
                        type: "POST",
                        data: new FormData(that),
                        processData: false,
                        contentType: false,
                        success: function(response) {

                            @if(isset($redirectUrl))
                                window.location.href = "{{ route($redirectUrl) }}";
                            @elseif (isset($redirectRoute))
                                window.location.href = "{{ $redirectRoute }}";
                            @else
                                Toast.fire({
                                    icon: 'success',
                                    title: response.responseJSON.message,
                                })

                                $(that).trigger("reset");
                            @endisset

                        },
                        error: function(response) {

                            if (response.status === 422) {
                                $.each(response.responseJSON.errors, function(i,
                                    error) {

                                    $("p." + i.replace(/\./g, "_")).text(
                                        error);
                                });
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: response.responseJSON.message ?? "Failed!"
                                })
                            }

                        },
                        complete: function() {
                            $('.overlay').hide();
                            $(".ajax-submit", that).val(submitTxt).attr("disabled",
                                false);
                            $('html, body').animate({
                                scrollTop: 0
                            }, 'slow');
                            $('#localizationTabs a[href="#custom-tabs-en"]').tab(
                                'show');
                        }
                    });
                } else if (isConfirm.dismiss === "cancel") {
                    return false;
                }
            });

        });
    });
</script>