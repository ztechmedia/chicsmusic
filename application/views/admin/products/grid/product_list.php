<div class="row">
    <div class="col-md-12">
        <ul class="pagination pagination-sm pull-right">
            <?php if(array_key_exists("prev", $pagination)) {?>
                <li onclick="changePage('<?=$pagination['prev']['page']?>')"
                    data-secondary="yes"><a>«</a></li>
            <?php } else{ ?>
                <li class="disabled"><a>«</a></li>
            <?php } ?>
            
            <li><a href="#"><?= "Halaman $page - $totalPage | Data $start - $end"?></a></li>      

            <?php if(array_key_exists("next", $pagination)) {  ?>
                <li onclick="changePage('<?=$pagination['next']['page']?>')"
                    data-secondary="yes"><a>»</a></li>
            <?php } else{ ?>
                <li class="disabled"><a>»</a></li>
            <?php } ?>
        </ul>  
    </div>
    <hr>
    <?php foreach($products as $product) { 
        $covers = unserialize($product->cover);
        if(count($covers) > 0) {
            $image = "assets/images/products/$covers[0]";
        }else{
            $image = "assets/images/no_image200.jpg";
        }
    ?>

        <div class="col-md-3 col-sm-4 col-xs-6">
            <div class="panel panel-default">
                <div class="panel-body panel-body-image">
                    <img class="img" src="<?=$image?>" alt="No Picrutes" />
                    <a class="panel-body-inform link-to-with-prev" data-to="<?=base_url("admin/products/$product->id/edit")?>">
                        <span class="fa fa-pencil"></span>
                    </a>
                </div>
                <div class="panel-body" style="height: 79px">
                    <h5><?=max_length($product->name, 30)?></h5>
                    <h6><?=toRp($product->price)?></h6>
                </div>
                <div class="panel-footer" style="height: 45px;text-align:center;">
                    <span class="fa fa-sign-out"></span> 114
                    |
                    <span class="fa fa-inbox"></span> 36
                </div>
            </div>
        </div>

    <?php } ?>
</div>
