<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.user_log'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.reports'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.user_log'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            

            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.user_log'); ?> <?php echo app('translator')->getFromJson('lang.report'); ?></h3>
                            </div>
                        </div>
                    </div>

                

                    <!-- <div class="d-flex justify-content-between mb-20"> -->
                        <!-- <button type="submit" class="primary-btn fix-gr-bg mr-20" onclick="javascript: form.action='<?php echo e(url('student-attendance-holiday')); ?>'">
                            <span class="ti-hand-point-right pr"></span>
                            mark as holiday
                        </button> -->

                        
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->getFromJson('lang.user'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.role'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.ip'); ?> <?php echo app('translator')->getFromJson('lang.address'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.login_time'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.user_agent'); ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $user_logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($user_log->user!=""?$user_log->user->username:""); ?></td>
                                        <td><?php echo e($user_log->role!=""?$user_log->role->name:""); ?></td>
                                        <td><?php echo e($user_log->ip_address); ?></td>
                                        <td><?php echo e(date('jS M, Y H:i A', strtotime($user_log->created_at))); ?></td>
                                        <td><?php echo e($user_log->user_agent); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


    </div>
</section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>