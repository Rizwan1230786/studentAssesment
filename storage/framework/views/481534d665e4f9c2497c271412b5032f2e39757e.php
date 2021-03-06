<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.system_settings'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.system_settings'); ?></a>
                <a href="<?php echo e(route('role')); ?>"><?php echo app('translator')->getFromJson('lang.role'); ?></a>
                <a href="<?php echo e(route('assign_permission', [$role->id])); ?>"><?php echo app('translator')->getFromJson('lang.assign_permission'); ?></a>
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
                                <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.assign_permission'); ?> (<?php echo e($role->name); ?>)</h3>
                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'role_permission_store', 'method' => 'POST'])); ?>

                    <input type="hidden" name="role_id" value="<?php echo e($role->id); ?>">
                    <div class="row">
                        <div class="col-lg-12 base-setup role-permission">
                            <table id="school-table-style" class="display school-table-style" cellspacing="0" width="100%">
                                <thead>
                                    <?php if(session()->has('message-danger') != ""): ?>
                                    <tr>
                                        <td colspan="9">
                                            <?php if(session()->has('message-danger')): ?>
                                            <div class="alert alert-danger">
                                                <?php echo e(session()->get('message-danger')); ?>

                                            </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <th><?php echo app('translator')->getFromJson('lang.module'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.module_link'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.permission'); ?></th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <tr>
                                    <td colspan="3" class="pr-0">
                                        <div id="accordion" role="tablist">
                                            <?php $i = 0; ?>
                                            <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <div class="card">
                                                <div class="card-header d-flex justify-content-between" id="headingOne">
                                                    <div class="row w-100 align-items-center">
                                                        <div class="col-lg-6">
                                                            <div>
                                                                <p class="mt-05 mb-0">
                                                                    <?php echo e($module->name); ?>

                                                                </p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <?php $module_links = $module->moduleLink; ?>
                                                <div id="collapseOne" class="show" aria-labelledby="headingOne" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <?php $__currentLoopData = $module_links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module_link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="row py-3 border-bottom align-items-center">
                                                            <div class="offset-lg-3 col-lg-5"><?php echo e($module_link->name); ?></div>
                                                            <div class="col-lg-4">
                                                                <div class="">
                                                                    <input type="checkbox" id="permissions<?php echo e($module_link->id); ?>" class="common-checkbox" name="permissions[]" value="<?php echo e($module_link->id); ?>" <?php echo e(in_array($module_link->id, $already_assigned)? 'checked':''); ?>>
                                                                    <label for="permissions<?php echo e($module_link->id); ?>"></label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>






                                                    </div>
                                                </div>
                                            </div>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                        </div>
                                    </td>
                                    <td></td>
                                    <td> </td>
                                </tr>


                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div class="col-lg-12 mt-20 text-right">
                                                <button type="submit" class="primary-btn fix-gr-bg">
                                                    <span class="ti-check"></span>
                                                    <?php echo app('translator')->getFromJson('lang.save'); ?>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </section>
            


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>