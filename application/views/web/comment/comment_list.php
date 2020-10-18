<div class="comment_list">
    <?php 
    if(count($comments) > 0) {
    foreach ($comments as $comment) {
    if($comment->status === 'new'){ ?>
    <div class="review_item">
        <div class="media">
            <div class="d-flex">
                <img class="img-comment" src="<?=base_url("assets/images/no_image200.jpg")?>" alt="">
            </div>
            <div class="media-body">
                <h4><?=$comment->name?></h4>
                <h5><?=$comment->createdAt?></h5>
                <a onclick="openCommentBox('<?=$comment->id?>')" class="reply_btn" href="javascript:(0)">Balas</a>
            </div>
        </div>
        <p><?=$comment->comment?></p>
    </div>
    <div id="<?=$comment->id?>"></div>
    <?php } else { ?>
    <div class="review_item reply">
        <div class="media">
            <div class="d-flex">
                <img class="img-comment" src="<?=base_url("assets/images/no_image200.jpg")?>" alt="">
            </div>
            <div class="media-body">
                <h4><?=$comment->name?></h4>
                <h5><?=$comment->createdAt?></h5>
            </div>
        </div>
        <p><?=$comment->comment?></p>
    </div>
    <div id="<?=$comment->id?>"></div>
    <?php } } }else{?>
        <p>Belum ada komentar</p>
    <?php } ?>
</div>