<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/')}}public/uploads/admin_logo/logo_small.png">
        <link rel="icon" type="image/png" sizes="20x20" href="{{asset('/')}}public/uploads/admin_logo/logo_small.png">

        @include('admin.partials.header-assets')

        <style type="text/css">
            .card-pad{
                padding-bottom: 10px;
            }
        </style>
        @yield('custom_css')
    </head>

    <body class="skin-default fixed-layout">
        <!-- Preloader - style you can find in spinners.css -->
        @include('admin.partials.preloader')

        <!-- Main wrapper - style you can find in pages.scss -->
        <div id="main-wrapper">
            <!-- Topbar header - style you can find in pages.scss -->
            <header class="topbar">
                @include('admin.partials.top-navbar')
            </header>
            <!-- End Topbar header -->

            <!-- Left Sidebar - style you can find in sidebar.scss  -->  
            @include('admin.partials.menu')
            <!-- End Left Sidebar - style you can find in sidebar.scss  -->

            <!-- Page wrapper  -->
            <div class="page-wrapper">
                <!-- Container fluid  -->
                <div class="container-fluid">
    	            <!-- Bread crumb and right sidebar toggle -->
    	            @yield('bread-crumb')
    	            <!-- End Bread crumb and right sidebar toggle -->

    			    <div style="padding-bottom: 10px;"></div>

    			    @php
    			        $message = Session::get('msg');
    			    @endphp

    			    @if (isset($message))
    					<div class="alert alert-success alert-dismissible">
    						<button type="button" class="close" data-dismiss="alert">&times;</button>
    						<strong>Success!</strong> {{ $message }}
    					</div>
    			    @endif

    			    @php
    			        Session::forget('msg');
    			    @endphp

                    <div class="card">            
    			        <div class="custom-card-header">
    			            <div class="row">
    			                <div class="col-md-6"><h4 class="custom-card-title">{{ $title }}</h4></div>
    			                <div class="col-md-6 text-right">
			                        <a style="font-size: 16px;" class="btn btn-outline-info btn-lg" href="{{ route($addNewLink) }}">
			                            <i class="fa fa-plus-circle"></i> Add New
			                        </a>                  
    			                </div>
    			            </div>
    			        </div>

    	                <!-- Card Body Content -->
    	                @yield('card_body')
    	                <!-- End Card Body Content -->
                    </div>

                    <!-- Right sidebar -->
                    @include('admin.partials.right-sidebar')
                    <!-- End Right sidebar -->
                </div>
                <!-- End Container fluid  -->
            </div>
            <!-- End Page wrapper  -->

            <!-- footer -->
            @include('admin.partials.footer')
            <!-- End footer -->

        </div>
        <!-- End Wrapper -->

        @include('admin.partials.footer-assets')

        <script>
            $(document).ready(function() {
                var updateThis ;       

                //ajax delete code
                $('#dataTable tbody').on( 'click', 'i.fa-trash', function () {
                    $.ajaxSetup({
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                    });

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
                                url : "{{ route($deleteLink) }}",
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
                                text: "This Data Is Safe :)",
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
                    url: "{{ route($statusLink) }}",
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

        <!-- This page plugins -->
        @yield('custom-js')

    </body>
</html>