<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'?>

<body>
    <!-- START PAGE CONTAINER -->
    <div class="page-container">

        <!-- START PAGE SIDEBAR -->
        <div class="page-sidebar page-sidebar-fixed">
            <!-- START X-NAVIGATION -->
            <ul class="x-navigation nav-customx">
                <li class="xn-logo">
                    <a>Click's Music</a>
                    <a class="x-navigation-control">
                    </a>
                </li>
                <?php 
                    include 'profile.php';
                    include 'sidebar.php';?>
            </ul>
            <!-- END X-NAVIGATION -->
        </div>
        <!-- END PAGE SIDEBAR -->

        <!-- PAGE CONTENT -->
        <div class="page-content">
            <?php include 'navbar.php';?>
            <div class="content"></div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
    <!-- END PAGE CONTAINER -->

    <script type="text/javascript" src="<?=base_url("assets/joli/js/jquery/jquery.min.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("assets/joli/js/jquery/jquery-ui.min.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("assets/joli/js/bootstrap/bootstrap.min.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("assets/joli/js/bootstrap/bootstrap-select.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("assets/joli/js/mcustomscrollbar/jquery.mCustomScrollbar.min.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("assets/datatables/datatables.min.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("assets/sweetalert/sweetalert.min.js")?>"></script>

    <script type="text/javascript" src="<?=base_url("assets/joli/js/validationengine/languages/jquery.validationEngine-id.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("assets/joli/js/validationengine/jquery.validationEngine.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("assets/joli/js/validationengine/jquery.validationEngine.js")?>"></script>

    <script type="text/javascript" src="<?=base_url("assets/joli/js/plugins.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("assets/joli/js/actions.js")?>"></script>

    <!-- CUSTOM SCRIPT -->
    <script type="text/javascript" src="<?=base_url("assets/custom/js/jquery.maskMoney.min.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("assets/custom/js/validation/forms.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("assets/custom/js/ajax/ajaxRequest.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("assets/custom/js/ajax/datatables/datatables.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("assets/custom/js/loader/sidebar.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("assets/custom/js/loader/viewLoader.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("assets/custom/js/actions/formResponse.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("assets/custom/js/actions/authActions.js")?>"></script>
    <script type="text/javascript" src="<?=base_url("assets/custom/js/actions/formActions.js")?>"></script>

    <script>
        setSidebarOnLoad();
        setCurrentNav("<?=base_url("dashboard")?>");
    </script>
</body>

</html>