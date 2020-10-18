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
    			    <form class="form-horizontal" action="<?= base_url($formLink) ?>" id="formAddEdit" method="POST" enctype="multipart/form-data" name="form">
    				    <div class="card">
    				        <div class="custom-card-header">
    				            <div class="row">
    				                <div class="col-md-6"><h4 class="custom-card-title"><?= $title.' ('.$menuInfo->menu_name.')' ?></h4></div>
    				                <div class="col-md-6 text-right">
    				                	<a class="btn btn-outline-info btn-lg" href="<?= base_url($goBackLink) ?>">
    				                		<i class="fa fa-arrow-circle-left"></i> Go Back
    				                	</a>
    				                	<button type="submit" class="btn btn-outline-info btn-lg waves-effect buttonAddEdit" name="buttonAddEdit" value="Save"><i class="fa fa-save"></i> <?= $buttonName ?></button>
    				                </div>
    				            </div>
    				        </div>

						    <div class="card-body">
				                <div class="row">
				                    <div class="col-md-6">
				                        <input class="form-control" type="hidden" name="menuActionId" value="<?= $menuActionInfo->id ?>">
				                    </div>
				                    <div class="col-md-6">
				                        <input class="form-control" type="hidden" name="parentMenuId" value="<?= $menuActionInfo->parent_menu_id ?>">
				                    </div>
				                </div>

				                <div class="row">
				                    <div class="col-md-6">
				                        <label for="Menu-type">Action Type</label>
				                        <div class="form-group {{ $errors->has('actionTypeId') ? ' has-danger' : '' }}">
				                            <select class="form-control select2" name="actionTypeId">
				                                <option value=" ">Select Action Type</option>
				                                <?php foreach ($menuActionTypes as $menuActionType): ?>
				                                	<?php
				                                		if ($menuActionType->action_id == $menuActionInfo->menu_type) {
				                                			$select = 'selected';
				                                		} else {
				                                			$select = '';
				                                		}				                                		
				                                	?>
				                                    <option value="<?= $menuActionType->action_id ?>" <?= $select ?>><?= $menuActionType->name ?></option>
				                                <?php endforeach ?>
				                            </select>
				                        </div>
				                    </div>
				                    <div class="col-md-6">
				                        <label for="name">Name</label>
				                        <div class="form-group">
				                            <input type="text" class="form-control form-control-danger" placeholder="Add" name="actionName" value="<?= $menuActionInfo->action_name ?>" required>
				                        </div>
				                    </div>
				                </div>

				                <div class="row">
				                    <div class="col-md-6">
				                        <label for="link">Link</label>
				                        <div class="form-group">
				                            <input type="text" class="form-control form-control-danger" placeholder="menu/add" name="actionLink" value="<?= $menuActionInfo->action_link ?>" required>
				                        </div>
				                    </div>
				                    <div class="col-md-6">
				                        <label for="order-by">Order By</label>
				                        <div class="form-group">
				                            <input type="number" class="form-control form-control-danger" placeholder="order by" name="orderBy" value="<?= $menuActionInfo->order_by ?>" required>
				                        </div>
				                    </div>
				                </div>
						    </div>

    				        <div class="custom-card-footer">
    				            <div class="row">
    				                <div class="col-md-12 text-right">
    				                	<button type="submit" class="btn btn-outline-info btn-lg waves-effect buttonAddEdit" name="buttonAddEdit" value="<?= $buttonName ?>"><i class="fa fa-save"></i> <?= $buttonName ?></button>
    				                </div>
    				            </div>	        	
    				        </div>
    				    </div>
    				</form>
                    <!-- End PAge Content -->

                    <!-- Right sidebar -->
                    <?php include APPPATH.'views/admin/include/right-sidebar.php'; ?>
                </div>
            </div>

            <!-- footer -->
            <?php include APPPATH.'views/admin/include/footer.php'; ?>
        </div>
        <?php include APPPATH.'views/admin/include/footer-assets.php'; ?>
    </body>
</html>