<script type="text/javascript" src="<?php echo e(asset('public/backEnd/js/main.js')); ?>"></script>
<div class="container-fluid">

    <div class="row">

        <div class="col-md-9">
            <h3><?php echo e($news->news_title); ?></h3>
            <h6 >Category: <?php echo e($news->news_category); ?></h6>
            <p class="mt-3"><?php echo e($news->news_body); ?></p>
        </div>
        <div class="col-md-3">
            <img src="<?php echo e(asset($news->image)); ?>" width="100px" height="100px">
        </div>
    </div>
