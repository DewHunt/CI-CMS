
        <script>
            $(document).ready(function() {
                var updateThis ;       

                //ajax delete code
                $('#dataTable tbody').on( 'click', 'i.fa-trash', function () {
                    id = $(this).parent().data('id');
                    var tableRow = this;
                    swal({   
                        title: "Are you sure?",   
                        text: "You will not be able to recover this information!",   
                        type: "warning",   
                        showCancelButton: true,   
                        confirmButtonColor: "#DD6B55",   
                        confirmButtonText: "Yes, delete it!",   
                        cancelButtonText: "No, cancel plx!",   
                        closeOnConfirm: false,   
                        closeOnCancel: false 
                    },
                    function(isConfirm){   
                        if (isConfirm) {
                            $.ajax({
                                type: "POST",
                                url : "<?= base_url($deleteLink); ?>",
                                data : {id:id},
                               
                                success: function(response) {
                                    swal({
                                        title: "<small class='text-success'>Success!</small>", 
                                        type: "success",
                                        text: "Deleted Successfully!",
                                        timer: 1000,
                                        html: true,
                                    });
                                    $('.row_'+id).remove();
                                },
                                error: function(response) {
                                    error = "Failed.";
                                    swal({
                                        title: "<small class='text-danger'>Error!</small>", 
                                        type: "error",
                                        text: error,
                                        timer: 1000,
                                        html: true,
                                    });
                                }
                            });    
                        }
                        else
                        { 
                            swal({
                                title: "Cancelled", 
                                type: "error",
                                text: "Data Is Safe :)",
                                timer: 1000,
                                html: true,
                            });    
                        } 
                    });
                });
            });
                    
            //ajax status change code
            function statusChange(id) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: "<?= base_url($statusLink); ?>",
                    data: {id:id},
                    success: function(response) {
                        swal({
                            title: "<small class='text-success'>Success!</small>", 
                            type: "success",
                            text: "Status Successfully Updated!",
                            timer: 1000,
                            html: true,
                        });
                    },
                    error: function(response) {
                        error = "Failed.";
                        swal({
                            title: "<small class='text-danger'>Error!</small>", 
                            type: "error",
                            text: error,
                            timer: 2000,
                            html: true,
                        });
                    }
                });
            }
        </script>