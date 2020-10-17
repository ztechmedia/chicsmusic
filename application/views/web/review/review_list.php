<div class="row total_rate">
    <div class="col-6">
        <div class="box_total">
            <h5>Overall</h5>
            <h4><?=$avg?></h4>
            <h6>(<?=count($reviews)?> Reviews)</h6>
        </div>
    </div>
    <div class="col-6">
        <div class="rating_list">
            <h3>Based on 3 Reviews</h3>
            <ul class="list">
                <li><a href="#">5 Star 
                    <i class="fa fa-star star-empty"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i> <?=$five?></a></li>
                <li><a href="#">4 Star 
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i> <?=$four?></a></li>
                <li><a href="#">3 Star 
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i> <?=$three?></a></li>
                <li><a href="#">2 Star 
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i> <?=$two?></a></li>
                <li><a href="#">1 Star 
                    <i class="fa fa-star"></i> <?=$one?></a></li>
            </ul>
        </div>
    </div>
</div>

<div class="review_list">
    <?php foreach ($reviews as $review) { ?>
    <div class="review_item">
        <div class="media">
            <div class="d-flex">
                <img class="img-comment" src="<?=base_url("assets/images/no_image200.jpg")?>" alt="">
            </div>
            <div class="media-body">
                <h4><?=$review->name?></h4>
                <?php for($i=1; $i <= $review->star; $i++){ ?>
                <i class="fa fa-star"></i>
                <?php } ?>
            </div>
        </div>
        <p><?=$review->comment?></p>
    </div>
    <?php } ?>
</div>