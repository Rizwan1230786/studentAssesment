<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.staff_attendance'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.human_resource'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.staff_attendance'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.select_criteria'); ?></h3>
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
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'staff-attendance-search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_studentA'])); ?>

                            <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="col-lg-6 mt-30-md">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('role') ? ' is-invalid' : ''); ?>" id="select_class" name="role">
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select_role'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select_role'); ?> *</option>
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($role->id); ?>" <?php echo e(isset($role_id)? ($role->id == $role_id? 'selected':''):''); ?>><?php echo e($role->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                     <?php if($errors->has('role')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('role')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-6 mt-30-md">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date form-control<?php echo e($errors->has('attendance_date') ? ' is-invalid' : ''); ?> <?php echo e(isset($date)? 'read-only-input': ''); ?>" id="startDate" type="text"
                                                    name="attendance_date" autocomplete="off" value="<?php echo e(isset($date)? $date: date('m/d/Y')); ?>">
                                                <label for="startDate"><?php echo app('translator')->getFromJson('lang.attendance'); ?> <?php echo app('translator')->getFromJson('lang.date'); ?>*</label>
                                                <span class="focus-border"></span>
                                                
                                                <?php if($errors->has('attendance_date')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('attendance_date')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        <?php echo app('translator')->getFromJson('lang.search'); ?>
                                    </button>
                                </div>
                            </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
<?php if(isset($already_assigned_staffs)): ?>

<?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>


            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.staff_attendance'); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 no-gutters">
                            <?php if($attendance_type != "" && $attendance_type == "H"): ?>
                            <div class="alert alert-warning"><?php echo app('translator')->getFromJson('lang.attendance_already_submitted_as_holiday'); ?></div>
                            <?php elseif($attendance_type != "" && $attendance_type != "H"): ?>
                            <div class="alert alert-success"><?php echo app('translator')->getFromJson('lang.attendance_already_submitted'); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6  col-md-6 no-gutters text-md-left mark-holiday">
                            <button type="button" class="primary-btn fix-gr-bg mb-20">
                            <input type="checkbox" id="mark_holiday" class="common-checkbox form-control" name="mark_holiday" value="1" <?php echo e($attendance_type == "H"? 'checked':''); ?>>
                            <label for="mark_holiday"><?php echo app('translator')->getFromJson('lang.mark_holiday'); ?></label>
                        </button>
                        </div>
                        <div class="col-lg-6 col-md-6 text-md-right">
                            <button type="submit" class="primary-btn fix-gr-bg mb-20" onclick="javascript: form.action='<?php echo e(url('staff-attendance-store')); ?>'">
                            <span class="ti-save pr"></span>
                                <?php echo app('translator')->getFromJson('lang.save'); ?> <?php echo app('translator')->getFromJson('lang.attendance'); ?>
                            </button>
                        </div>
                    </div>

                   

                    <input type="hidden" name="date" value="<?php echo e(isset($date)? $date: ''); ?>">

                        
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id_table" class="display school-table" cellspacing="0" width="100%">
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
                                        <th width="15%"><?php echo app('translator')->getFromJson('lang.staff'); ?> <?php echo app('translator')->getFromJson('lang.no'); ?></th>
                                        <th width="15%"><?php echo app('translator')->getFromJson('lang.staff'); ?> <?php echo app('translator')->getFromJson('lang.name'); ?></th>
                                        <th width="12%"><?php echo app('translator')->getFromJson('lang.role'); ?></th>
                                        <th width="35%"><?php echo app('translator')->getFromJson('lang.attendance'); ?></th>
                                        <th width="20%"><?php echo app('translator')->getFromJson('lang.note'); ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $already_assigned_staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $already_assigned_staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($already_assigned_staff->StaffInfo->staff_no); ?><input type="hidden" name="id[]" value="<?php echo e($already_assigned_staff->StaffInfo->id); ?>"></td>
                                        <td>
                                            <?php if($already_assigned_staff->StaffInfo!=""): ?>
                                            <?php echo e($already_assigned_staff->StaffInfo->first_name.' '.$already_assigned_staff->StaffInfo->last_name); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($already_assigned_staff->StaffInfo!="" && $already_assigned_staff->StaffInfo->roles!=""): ?>
                                            <?php echo e($already_assigned_staff->StaffInfo->roles->name); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="d-flex radio-btn-flex">
                                                <div class="mr-20">
                                                    <input type="radio" name="attendance[<?php echo e($already_assigned_staff->StaffInfo->id); ?>]" id="attendanceP<?php echo e($already_assigned_staff->StaffInfo->id); ?>" value="P" class="common-radio attendanceP" <?php echo e($already_assigned_staff->attendence_type == "P"? 'checked':''); ?>>
                                                    <label for="attendanceP<?php echo e($already_assigned_staff->StaffInfo->id); ?>"><?php echo app('translator')->getFromJson('lang.present'); ?></label>
                                                </div>
                                                <div class="mr-20">
                                                    <input type="radio" name="attendance[<?php echo e($already_assigned_staff->StaffInfo->id); ?>]" id="attendanceL<?php echo e($already_assigned_staff->StaffInfo->id); ?>" value="L" class="common-radio" <?php echo e($already_assigned_staff->attendence_type == "L"? 'checked':''); ?>>
                                                    <label for="attendanceL<?php echo e($already_assigned_staff->StaffInfo->id); ?>"><?php echo app('translator')->getFromJson('lang.late'); ?></label>
                                                </div>
                                                <div class="mr-20">
                                                    <input type="radio" name="attendance[<?php echo e($already_assigned_staff->StaffInfo->id); ?>]" id="attendanceA<?php echo e($already_assigned_staff->StaffInfo->id); ?>" value="A" class="common-radio" <?php echo e($already_assigned_staff->attendence_type == "A"? 'checked':''); ?>>
                                                    <label for="attendanceA<?php echo e($already_assigned_staff->StaffInfo->id); ?>"><?php echo app('translator')->getFromJson('lang.absent'); ?></label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="attendance[<?php echo e($already_assigned_staff->StaffInfo->id); ?>]" id="attendanceH<?php echo e($already_assigned_staff->StaffInfo->id); ?>" value="F" class="common-radio" <?php echo e($already_assigned_staff->attendence_type == "F"? 'checked':''); ?>>
                                                    <label for="attendanceH<?php echo e($already_assigned_staff->StaffInfo->id); ?>"><?php echo app('translator')->getFromJson('lang.holiday'); ?></label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-effect">
                                                <textarea class="primary-input form-control" cols="0" rows="2" name="note[<?php echo e($already_assigned_staff->StaffInfo->id); ?>]" id=""><?php echo e($already_assigned_staff->notes); ?></textarea>
                                                <label><?php echo app('translator')->getFromJson('lang.add_note_here'); ?></label>
                                                <span class="focus-border textarea"></span>
                                                <span class="invalid-feedback">
                                                    <strong><?php echo app('translator')->getFromJson('lang.error'); ?></strong>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $new_staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($staff->staff_no); ?><input type="hidden" name="id[]" value="<?php echo e($staff->id); ?>"></td>
                                        <td><?php echo e($staff->first_name.' '.$staff->last_name); ?></td>
                                        <td><?php echo e($staff->roles !=""?$staff->roles->name:""); ?></td>
                                        <td>
                                            <div class="d-flex radio-btn-flex">
                                                <div class="mr-20">
                                                    <input type="radio" name="attendance[<?php echo e($staff->id); ?>]" id="attendanceP<?php echo e($staff->id); ?>" value="P" class="common-radio attendanceP" checked>
                                                    <label for="attendanceP<?php echo e($staff->id); ?>"><?php echo app('translator')->getFromJson('lang.present'); ?></label>
                                                </div>
                                                <div class="mr-20">
                                                    <input type="radio" name="attendance[<?php echo e($staff->id); ?>]" id="attendanceL<?php echo e($staff->id); ?>" value="L" class="common-radio">
                                                    <label for="attendanceL<?php echo e($staff->id); ?>"><?php echo app('translator')->getFromJson('lang.late'); ?></label>
                                                </div>
                                                <div class="mr-20">
                                                    <input type="radio" name="attendance[<?php echo e($staff->id); ?>]" id="attendanceA<?php echo e($staff->id); ?>" value="A" class="common-radio">
                                                    <label for="attendanceA<?php echo e($staff->id); ?>"><?php echo app('translator')->getFromJson('lang.absent'); ?></label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="attendance[<?php echo e($staff->id); ?>]" id="attendanceH<?php echo e($staff->id); ?>" value="F" class="common-radio">
                                                    <label for="attendanceH<?php echo e($staff->id); ?>"><?php echo app('translator')->getFromJson('lang.holiday'); ?></label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-effect">
                                                <textarea class="primary-input form-control" cols="0" rows="2" name="note[<?php echo e($staff->id); ?>]" id=""></textarea>
                                                <label><?php echo app('translator')->getFromJson('lang.add_note_here'); ?></label>
                                                <span class="focus-border textarea"></span>
                                                <span class="invalid-feedback">
                                                    <strong><?php echo app('translator')->getFromJson('lang.error'); ?></strong>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
<?php endif; ?>

    </div>
</section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>