<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.student_promote'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.student_information'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.student_promote'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.select_criteria'); ?> </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                        <?php if(session()->has('message-success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session()->get('message-success')); ?>

                        </div>
                        <?php elseif(session()->has('message-danger')): ?>
                        <div class="alert alert-danger">
                            <?php echo e(session()->get('message-danger')); ?>

                        </div>
                        <?php endif; ?>
                    <div class="white-box">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'student-current-search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_promoteA'])); ?>

                            <div class="row">
                                <div class="col-lg-6">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('current_session') ? ' is-invalid' : ''); ?>" name="current_session" id="current_session">
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select_current_session'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_current_session'); ?> *</option>
                                        <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($session->id); ?>" <?php echo e(isset($current_session)? ($current_session == $session->id? 'selected':''):''); ?>><?php echo e($session->session); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('current_session')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('current_session')); ?></strong>
                                    </span>
                                    <?php endif; ?>                                  
                                </div>
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="col-lg-6 mt-30-md">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('current_class') ? ' is-invalid' : ''); ?>" id="select_class_student_promote" name="current_class">
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select_current_class'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_current_class'); ?> *</option>
                                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($class->id); ?>" <?php echo e(isset($current_class)? ($current_class == $class->id? 'selected':''):''); ?>><?php echo e($class->class_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                     <?php if($errors->has('current_class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('current_class')); ?></strong>
                                    </span>
                                    <?php endif; ?> 
                                </div>
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg" id="search_promote">
                                        <span class="ti-search pr-2"></span>
                                        <?php echo app('translator')->getFromJson('lang.search'); ?>
                                    </button>
                                </div>
                            </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php if(isset($students)): ?>
    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.promote_student_in_next_session'); ?></h3>
                            </div>
                        </div>
                    </div>

                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'student-promote-store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'student_promote_submit'])); ?>

                    <input type="hidden" name="current_session" value="<?php echo e($current_session); ?>">
                    <input type="hidden" name="current_class" value="<?php echo e($current_class); ?>">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="display school-table school-table-style" cellspacing="0" width="100%">
                                <thead>
                                    <?php if(session()->has('message-danger-table') != "" || session()->has('message-success') != ""): ?>
                                    <tr>
                                        <td colspan="5">
                                            <?php if(session()->has('message-danger-table')): ?>
                                            <div class="alert alert-danger">
                                                <?php echo e(session()->get('message-danger-table')); ?>

                                            </div>
                                            <?php else: ?>
                                            <div class="alert alert-success">
                                                <?php echo e(session()->get('message-success')); ?>

                                            </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <th><?php echo app('translator')->getFromJson('lang.admission'); ?> <?php echo app('translator')->getFromJson('lang.no'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.class'); ?>/<?php echo app('translator')->getFromJson('lang.section'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.name'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.information'); ?></th>
                                        <th><?php echo app('translator')->getFromJson('lang.current'); ?> <?php echo app('translator')->getFromJson('lang.result'); ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($student->admission_no); ?></td>
                                        <input type="hidden" name="id[]" value="<?php echo e($student->id); ?>">
                                        <td><?php echo e($student->className !=""?$student->className->class_name:""); ?></td>
                                        <td><?php echo e($student->first_name.' '.$student->last_name); ?></td>
                                        <td> 

                                            <a href="<?php echo e(url('view-academic-performance')); ?>/<?php echo e($student->id); ?>" class="primary-btn  tr-bg  modalLink bord-rad" data-modal-size="modal-lg" title="<?php echo app('translator')->getFromJson('lang.view_academic_performance'); ?>"><?php echo app('translator')->getFromJson('lang.view_academic_performance'); ?>  </a>
                                            <!-- iamrashed -->
                                        </td>
                                        <td>
                                            <div class="mr-30">
                                                <input type="radio" name="result[<?php echo e($student->id); ?>]" id="radioP<?php echo e($student->id); ?>" class="common-radio" value="P" checked />
                                                <label for="radioP<?php echo e($student->id); ?>"><?php echo app('translator')->getFromJson('lang.pass'); ?> &nbsp;</label>
                                            </div>
                                            <div>                
                                                <input type="radio" name="result[<?php echo e($student->id); ?>]" id="radioF<?php echo e($student->id); ?>" class="common-radio" value="F" />
                                                <label for="radioF<?php echo e($student->id); ?>"><?php echo app('translator')->getFromJson('lang.fail'); ?></label>
                                            </div>               
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td colspan="5">
                                            <div class="row mt-30">
                                                <div class="col-lg-4">
                                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('promote_session') ? ' is-invalid' : ''); ?>" name="promote_session" id="promote_session">
                                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select_promote_session'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_promote_session'); ?> *</option>
                                                        <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($session->id); ?>" <?php echo e(( old("promote_session") == $session->id ? "selected":"")); ?>><?php echo e($session->session); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    
                                                    <span class="text-danger d-none" role="alert" id="promote_session_error">
                                                        <strong><?php echo app('translator')->getFromJson('lang.the_session_is_required'); ?></strong>
                                                    </span>
                                                </div>

                                                <div class="col-lg-4">
                                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('promote_class') ? ' is-invalid' : ''); ?>" name="promote_class" id="promote_class">
                                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select_promote_class'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_promote_class'); ?> *</option>
                                                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($class->id); ?>" <?php echo e(( old("promote_class") == $class->id ? "selected":"")); ?>><?php echo e($class->class_name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                    <span class="text-danger d-none" role="alert" id="promote_class_error">
                                                        <strong><?php echo app('translator')->getFromJson('lang.the_class_is_required'); ?></strong>
                                                    </span>
                                                </div>
                                                <div class="col-lg-4 text-center">
                                                    <button type="submit" class="primary-btn fix-gr-bg" id="student_promote_submit">
                                                        <span class="ti-check"></span>
                                                        <?php echo app('translator')->getFromJson('lang.promote'); ?>
                                                    </button>
                                                </div>
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
<?php endif; ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>