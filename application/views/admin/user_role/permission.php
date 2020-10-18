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

	    <style type="text/css">
	        .parentMenuBlock{
	            border: 1px solid #d4c8c8;
	            padding: 10px 0px;
	            margin-bottom: 10px;
	        }
	    </style>
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
    				                <div class="col-md-6"><h4 class="custom-card-title"><?= $title ?></h4></div>
    				                <div class="col-md-6 text-right">
    				                	<a class="btn btn-outline-info btn-lg" href="<?= base_url($goBackLink) ?>">
    				                		<i class="fa fa-arrow-circle-left"></i> Go Back
    				                	</a>
    				                	<button type="submit" class="btn btn-outline-info btn-lg waves-effect buttonAddEdit" name="buttonAddEdit" value="Save"><i class="fa fa-save"></i> <?= $buttonName ?></button>
    				                </div>
    				            </div>
    				        </div>

						    <div class="card-body">
						    	<?php $userRoles = $userRoles; ?>
						        <input type="hidden" name="userroleId" value="<?= $userRoles->id ?>">

						        <div class="row">
						            <div class="col-md-10">
						            	<input type="checkbox" class="select_all" name="select_all"> Select All
						            </div>
						        </div>

						        <div style="padding-bottom: 10px;"></div>
						        <?php foreach ($userMenus as $rootMenu): ?>
						        	<?php
							            $rolePermission = explode(',', $userRoles->permission);
							            if (in_array($rootMenu->id, $rolePermission))
							            {
							                $checked = "checked";
							            }
							            else
							            {
							                $checked = "";
							            }
						                $countUserMenuAction = $this->HelperModel->GetUserMenuActionCount($rootMenu->id);
						        	?>

						           	<?php if ($rootMenu->parent_menu == NULL): ?>
						                <?php if ($countUserMenuAction->count == 0): ?>
						                	<?php
						                		$parentMenus = $this->HelperModel->GetAllMenus($rootMenu->id);
						                	?>

						                    <div class="row parentMenuBlock">
						                        <div class="col-md-12">
						                        	<input class="parentMenu_<?= $rootMenu->parent_menu ?> menu" type="checkbox" name="usermenu[]" value="<?= $rootMenu->id ?>" <?= $checked ?>  data-id="<?= $rootMenu->id ?>" <?php if ($rootMenu->id == 1): ?>onclick="return false" checked<?php endif ?>>
						                            <span><?= $rootMenu->menu_name ?></span>
						                          
						                            <div class="row" style="padding-left: 30px;">
						                                <?php foreach ($parentMenus as $parentMenu): ?>
						                                	<?php
						                                        $userMenuAction = $this->HelperModel->GetUserMenuAction($parentMenu->id);
						                                        $rolePermission = explode(',', $userRoles->permission);
						                                        if (in_array($parentMenu->id, $rolePermission))
						                                        {
						                                            $checked = "checked";
						                                        }
						                                        else
						                                        {
						                                            $checked = "";
						                                        }
						                                	?>

						                                    <div class="col-md-3">
						                                        <input class="parentMenu_<?= $parentMenu->parent_menu ?> menu" type="checkbox" name="usermenu[]" value="<?= $parentMenu->id ?>" <?= $checked ?>  data-id="<?= $parentMenu->id ?>">
						                                        <span><?= $parentMenu->menu_name ?></span>
						                                        <div style="margin-left: 26px;margin-top: 3px;">
						                                            <?php foreach ($userMenuAction as $action): ?>
						                                            	<?php
						                                                    $actionPermission = explode(',', $userRoles->action_permission);
						                                                    if (in_array($action->id, $actionPermission))
						                                                    {
						                                                        $actionChecked = "checked";
						                                                    }
						                                                    else
						                                                    {
						                                                        $actionChecked = "";
						                                                    }
						                                            	?>
						                                                <input class="childMenu_<?= $action->parent_menu_id ?>" type="checkbox" name="usermenuAction[]" value="<?= $action->id ?>" style="margin-bottom: 8px;" <?= $actionChecked ?>> <?= $action->action_name ?> <br>
						                                            <?php endforeach ?>
						                                        </div>
						                          
						                                        <div class="row" style="padding-left: 30px;">
						                                        	<?php
						                                        		$subMenus = $this->HelperModel->GetAllMenus($parentMenu->id);
						                                        	?>
						                                            <?php foreach ($subMenus as $subMenu): ?>
						                                            	<?php
						                                                    $userMenuAction = $this->HelperModel->GetUserMenuAction($subMenu->id);
						                                                    $rolePermission = explode(',', $userRoles->permission);
						                                                    if (in_array($subMenu->id, $rolePermission))
						                                                    {
						                                                        $checked = "checked";
						                                                    }
						                                                    else
						                                                    {
						                                                        $checked = "";
						                                                    }
						                                            	?>

						                                                <div class="col-sm-12">
						                                                    <input class="parentMenu_<?= $subMenu->parent_menu ?> menu" type="checkbox" name="usermenu[]" value="<?= $subMenu->id ?>" <?= $checked ?> data-id="<?= $subMenu->id ?>">
						                                                    <span><?= $subMenu->menu_name ?></span>
						                                                    <div style="margin-left: 26px;margin-top: 3px;">
						                                                        <?php foreach ($userMenuAction as $action): ?>
						                                                        	<?php
						                                                                $actionPermission = explode(',', $userRoles->action_permission);
						                                                                if (in_array($action->id, $actionPermission))
						                                                                {
						                                                                    $actionChecked = "checked";
						                                                                }
						                                                                else
						                                                                {
						                                                                    $actionChecked = "";
						                                                                }
						                                                            ?>
						                                                            <input class="childMenu_<?= $action->parent_menu_id ?>" type="checkbox" name="usermenuAction[]" value="<?= $action->id ?>" style="margin-bottom: 8px;" <?= $actionChecked ?>> <?= $action->action_name ?> <br>
						                                                        <?php endforeach ?>
						                                                    </div>
						                                                </div>
						                                            <?php endforeach ?>
						                                        </div>
						                                    </div>
						                                <?php endforeach ?>
						                            </div>
						                        </div>
						                    </div>
						                <?php else: ?>
						                    <div class="row parentMenuBlock">
						                    	<?php
						                            $userMenuAction = $this->HelperModel->GetUserMenuAction($rootMenu->id);
						                            $rolePermission = explode(',', $userRoles->permission);
						                            if (in_array($rootMenu->id, $rolePermission))
						                            {
						                                $checked = "checked";
						                            }
						                            else
						                            {
						                                $checked = "";
						                            }
						                        ?>

						                        <div class="col-md-12">
						                            <input class="parentMenu_<?= $rootMenu->parent_menu ?> menu" type="checkbox" name="usermenu[]" value="<?= $rootMenu->id ?>" <?= $checked ?> data-id="<?= $rootMenu->id ?>">
						                            <span><?= $rootMenu->menu_name ?></span>
						                            <div style="margin-left: 26px;margin-top: 3px;">
						                                <?php foreach ($userMenuAction as $action): ?>
						                                	<?php
						                                        $actionPermission = explode(',', $userRoles->action_permission);
						                                        if (in_array($action->id, $actionPermission))
						                                        {
						                                            $actionChecked = "checked";
						                                        }
						                                        else
						                                        {
						                                            $actionChecked = "";
						                                        }
															?>
						                                    <input class="childMenu_<?= $action->parent_menu_id ?>" type="checkbox" name="usermenuAction[]" value="<?= $action->id ?>" style="margin-bottom: 8px;" <?= $actionChecked ?>> <?= $action->action_name ?> <br>
						                                <?php endforeach ?>
						                            </div>
						                        </div>
						                    </div>
						                <?php endif ?>
						            <?php endif ?>
						        <?php endforeach ?>
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

	    <script type="text/javascript">
	        $(document).ready(function(){
	            $('.select_all').click(function(event){
	                if(this.checked)
	                {
	                    // Iterate each checkbox
	                    $(':checkbox').each(function(){
	                        this.checked = true;
	                    });
	                }
	                else
	                {
	                    $(':checkbox').each(function(){
	                        this.checked = false;
	                    });
	                }
	            });

	            $('.menu').click(function(event){
	                var menuId = $(this).data('id');
	                if(this.checked)
	                {
	                    $('.parentMenu_'+menuId).each(function()
	                    {
	                        this.checked = true;
	                    });

	                    $('.childMenu_'+menuId).each(function(){
	                        this.checked = true;
	                    });
	                }
	                else
	                {
	                    $('.parentMenu_'+menuId).each(function()
	                    {
	                        this.checked = false;
	                    });

	                    $('.childMenu_'+menuId).each(function(){
	                        this.checked = false;
	                    });
	                }
	            });
	        });
	    </script>
    </body>
</html>