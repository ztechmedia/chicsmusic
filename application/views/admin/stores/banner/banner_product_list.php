<div class="row">
    <div class="col-md-12">
        <ul class="pagination pagination-sm pull-right">
            <input id="page" value="<?=$page?>" style="display: none" />
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
                    <div class="banner-list-overlay">
                        <h5><?=max_length($product->name, 30)?></h5>
                    </div>
                    <a onclick="setBanner('<?=$product->id?>')" class="panel-body-inform" style="background-color: #ccc">
                        <span class="fa fa-caret-square-o-right"></span>
                    </a>
                </div>
                <div class="panel-body">
                    <h6><?=toRp($product->price)?></h6>
                </div>
            </div>
        </div>

    <?php } ?>
</div>