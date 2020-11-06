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
                    <?= empty($this->cardContent) ? 'Body Content Here' : $this->cardContent ?>
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