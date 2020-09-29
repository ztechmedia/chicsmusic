<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>Chics Musics - Admin Panel</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="<?=base_url('assets/images/no_image200.jpg')?>" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="<?=base_url('assets/joli/css/theme-default.css')?>"/>
        <link rel="stylesheet" type="text/css" href="<?=base_url('assets/custom/css/style.css')?>"/>
        <!-- EOF CSS INCLUDE -->                                     
    </head>
    <body>
        <?php $this->load->view($view)?>
        <script type="text/javascript" src="<?=base_url("assets/joli/js/jquery/jquery.min.js")?>"></script>
        <script type="text/javascript" src="<?=base_url("assets/custom/js/ajax/ajaxRequest.js")?>"></script>
        <script type="text/javascript" src="<?=base_url("assets/custom/js/actions/authActions.js")?>"></script>
    </body>
</html>