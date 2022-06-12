<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.update_system'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.system_settings'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.update_system'); ?></a>

            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <?php if(isset($edit_languages)): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(url('marks-grade')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->getFromJson('lang.add'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.System_Status'); ?> </h3>
                        </div> 
                        <div class="row">
                            <table class="display school-table school-table-style" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>  <?php echo app('translator')->getFromJson('lang.Existing'); ?> <?php echo app('translator')->getFromJson('lang.Version'); ?></th>
                                        <th>  <?php echo app('translator')->getFromJson('lang.Available'); ?> <?php echo app('translator')->getFromJson('lang.Version'); ?></th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo e($existing->system_version); ?></td>
                                        <td><?php echo e($version_number); ?></td>
                                    </tr>
                                </tbody>
                            </table>  
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.Version'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">  

                        <table class="display school-table school-table-style" cellspacing="0" width="100%">


                            <thead>
                                <?php if(session()->has('message-success') != "" ||
                                session()->get('message-danger-delete') != ""): ?>
                                <tr>
                                    <td colspan="3">
                                        <?php if(session()->has('message-success')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(session()->get('message-success')); ?>

                                        </div> 
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <tr>  
                                    <th> <?php echo app('translator')->getFromJson('lang.Available'); ?> <?php echo app('translator')->getFromJson('lang.Version'); ?> </th>  
                                    <th><?php echo app('translator')->getFromJson('lang.New_Features'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.Alert'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i=0; ?>  

                                <tr> 
                                    <td rowspan="<?php echo e(count($versions)); ?>"><?php echo e($version_number); ?></td> 
                                    <td>
                                        <?php $__currentLoopData = $versions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $version): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($version->features); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>   
                                    <td>
                                        <?php $__currentLoopData = $versions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $version): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(!empty($version->note)): ?>
                                                <li><?php echo e($version->note); ?></li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>    
                                </tr>  

                                    
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3">
                                        
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'upgrade-settings', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                    <input type="hidden" name="version" value="<?php echo e($version_number); ?>"> 

                        <div class="row mt-40">
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="primary-btn fix-gr-bg isDisabled"  data-toggle="tooltip" title="Disabled for demo version"> 
                                    <span class="ti-check"></span>
                                    <?php echo app('translator')->getFromJson('lang.Upgrade'); ?> 
                                </button>
                            </div>
                        </div>

                    <?php echo e(Form::close()); ?>


                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>