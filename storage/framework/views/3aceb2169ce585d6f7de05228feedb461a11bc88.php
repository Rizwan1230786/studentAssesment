<script type="text/javascript" src="<?php echo e(asset('public/backEnd/js/main.js')); ?>"></script>
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">
            <h1><?php echo e($course->title); ?></h1>
            <img src="<?php echo e(asset($course->image)); ?>" class="mt-3 mr-3" style="float: left">
            <h3 class="mt-3">Overview: </h3>
            <p><?php echo e($course->overview); ?></p>
            <h3 class="mt-3">Outline: </h3>
            <p><?php echo e($course->outline); ?></p>
            <h3 class="mt-3">Prerequisites: </h3>
            <p><?php echo e($course->prerequisites); ?></p>
            <h3 class="mt-3">Resources: </h3>
            <p><?php echo e($course->resources); ?></p>
            <h3 class="mt-3">Stats: </h3>
            <p><?php echo e($course->stats); ?></p>
        </div>
    </div>

