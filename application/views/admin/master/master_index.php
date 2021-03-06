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

        <?= empty($this->customCss) ? '' : $this->customCss ?>
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
    			                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><h4 class="custom-card-title"><?= $title ?></h4></div>
    			                <div class="col-lg-6 col-md-6 col-sm-12 text-right">
			                        <!-- <a style="font-size: 16px;" class="btn btn-outline-info btn-lg" href="<?= base_url($addButtonLink) ?>">
			                            <i class="fa fa-plus-circle"></i> Add New
			                        </a> -->
                                    <?= $this->Link_model->add_link(); ?>
    			                </div>
    			            </div>
    			        </div>

                        <div class="card-body">
                            <?= empty($this->cardBodyContent) ? 'Body Content Here' : $this->cardBodyContent ?>
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
        <?php include APPPATH.'views/admin/include/status-and-delete.php'; ?>

        <?= empty($this->customJs) ? '' : $this->customJs ?>
    </body>
</html>