<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <?php include APPPATH.'views/admin/include/header-assets.php'; ?>
    </head>

    <body class="skin-default fixed-layout">
        <!-- Preloader -->
        <?php //include APPPATH.'views/admin/include/preloader.php'; ?>

        <!-- Main wrapper - style you can find in pages.scss -->
        <div id="main-wrapper">
            <!-- Topbar header - style you can find in pages.scss -->
            <?php include APPPATH.'views/admin/include/top-navbar.php'; ?>

            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <?php include APPPATH.'views/admin/include/menu.php'; ?>

            <!-- Page wrapper  -->
            <div class="page-wrapper">
                <!-- Container fluid  -->
                <div class="container-fluid">
                    <div style="padding-bottom: 10px;"></div>

                    <?php if (!empty($this->session->flashdata('message'))): ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Success!</strong> <?= $this->session->flashdata('message') ?>
                        </div>                    	
                    <?php endif ?>

                    <?php if (!empty($this->session->flashdata('error'))): ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Oops!</strong> <?= $this->session->flashdata('error') ?>
                        </div>                    	
                    <?php endif ?>

                    <!-- Start Page Content -->
                    <div class="card">            
    			        <div class="custom-card-header">
    			            <div class="row">
    			                <div class="col-md-6"><h4 class="custom-card-title"><?= $title.' ('.$menuInfo->menu_name.')' ?></h4></div>
    			                <div class="col-md-6 text-right">
				                	<a class="btn btn-outline-info btn-lg" href="<?= base_url($goBackLink) ?>">
				                		<i class="fa fa-arrow-circle-left"></i> Go Back
				                	</a>
			                        <a style="font-size: 16px;" class="btn btn-outline-info btn-lg" href="<?= base_url($addButtonLink) ?>">
			                            <i class="fa fa-plus-circle"></i> Add New
			                        </a>
    			                </div>
    			            </div>
    			        </div>

					    <div class="card-body">
					        <div class="table-responsive">
					            <table id="dataTable" class="table table-bordered table-striped"  name="areaTable">
					                <thead>
					                    <tr>
					                        <th width="20px">SL</th>
					                        <th>Name</th>
                                            <th>Action Type</th>
					                        <th>Parent</th>
					                        <th>Link</th>
					                        <th width="20px">Order</th>
					                        <th width="20px">Status</th>
					                        <th width="50px">Action</th>
					                    </tr>
					                </thead>
					                <tbody id="">
					                	<?php $sl = 1; ?>
					                	<?php foreach ($menuActionsList as $menuAction): ?>
					                		<tr class="row_<?= $menuAction->id ?>">
					                			<td><?= $sl++ ?></td>
					                			<td><?= $menuAction->action_name ?></td>
                                                <td><?= $menuAction->actionTypeName ?></td>
					                			<td><?= $menuAction->parentMenuName ?></td>
					                            <td><?= $menuAction->action_link ?></td>
					                            <td><?= $menuAction->order_by ?></td>
					                			<td>
				                                    <span class="switchery-demo m-b-30" onclick="statusChange(<?= $menuAction->id ?>)">
				                                        <input type="checkbox" <?= $menuAction->status ? 'checked':'' ?> class="js-switch" data-color="#00c292" data-switchery="true" style="display: none;" >
				                                    </span>
					                			</td>
					                			<td>
				                                    <a href="<?= base_url('menu_action/edit/'.$menuAction->id) ?>" data-toggle="tooltip" data-original-title="Edit" data-id="<?= $menuAction->id ?>"> 
				                                    	<i class="fas fa-edit text-inverse m-r-10"></i> 
				                                    </a>

				                                    <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Delete" data-id="<?= $menuAction->id ?>"> 
				                                    	<i class="fa fa-trash text-danger"></i> 
				                                    </a>
					                			</td>
					                		</tr>					                		
					                	<?php endforeach ?>
					                </tbody>
					            </table>
					        </div>
					    </div>
                    </div>
                    <!-- End PAge Content -->

                    <!-- Right sidebar -->
                    <?php include APPPATH.'views/admin/include/right-sidebar.php'; ?>
                </div>
            </div>

            <!-- footer -->
            <?php include APPPATH.'views/admin/include/footer.php'; ?>
        </div>
        <?php include APPPATH.'views/admin/include/footer-assets.php'; ?>
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
    </body>
</html>