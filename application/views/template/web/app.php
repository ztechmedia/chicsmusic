<!DOCTYPE html>
<html lang="zxx" class="no-js">

<?php include("head.php") ?>

<body>

    <?php include("header.php") ?>

    <?php $this->load->view($view); ?>

    <?php include("footer.php") ?>
    
    <?php if(isset($script)) $this->load->view($script) ?>
</body>

</html>