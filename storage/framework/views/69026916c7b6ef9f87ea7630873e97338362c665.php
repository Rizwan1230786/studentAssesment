<?php $__env->startSection('mainContent'); ?>

<?php
function showPicName($data){
$name = explode('/', $data);
return $name[3];
}
?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.holiday'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.system_settings'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.holiday'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <?php if(isset($editData)): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(url('holiday')); ?>" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30"><?php if(isset($editData)): ?>
                                    <?php echo app('translator')->getFromJson('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->getFromJson('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->getFromJson('lang.holiday'); ?>
                            </h3>
                        </div>
                        <?php if(isset($editData)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'holiday/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'holiday',
                        'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <?php if(session()->has('message-success')): ?>
                                    <div class="alert alert-success">
                                        <?php echo e(session()->get('message-success')); ?>

                                    </div>
                                    <?php elseif(session()->has('message-danger')): ?>
                                    <div class="alert alert-danger">
                                        <?php echo e(session()->get('message-danger')); ?>

                                    </div>
                                    <?php endif; ?>

                                    <div class="col-lg-12 mb-20">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('holiday_title') ? ' is-invalid' : ''); ?>"
                                            type="text" name="holiday_title" autocomplete="off" value="<?php echo e(isset($editData)? $editData->holiday_title : ''); ?>">
                                            <label><?php echo app('translator')->getFromJson('lang.holiday'); ?> <?php echo app('translator')->getFromJson('lang.title'); ?> <span>*</span> </label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('holiday_title')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('holiday_title')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">

                                </div>
                                <div class="row no-gutters input-right-icon mb-30">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control<?php echo e($errors->has('from_date') ? ' is-invalid' : ''); ?>" id="event_from_date" type="text"
                                            name="from_date" value="<?php echo e(isset($editData)? date('m/d/Y', strtotime($editData->from_date)): date('m/d/Y')); ?>" autocomplete="off">
                                            <label><?php echo app('translator')->getFromJson('lang.from_date'); ?> <span></span> </label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('from_date')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('from_date')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="event_start_date"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row no-gutters input-right-icon mb-30">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control<?php echo e($errors->has('to_date') ? ' is-invalid' : ''); ?>" id="event_to_date" type="text"
                                            name="to_date" value="<?php echo e(isset($editData)? date('m/d/Y', strtotime($editData->to_date)): date('m/d/Y')); ?>" autocomplete="off">
                                            <label><?php echo app('translator')->getFromJson('lang.to_date'); ?><span></span> </label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('to_date')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('to_date')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="event_end_date"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="row mb-20">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control <?php echo e($errors->has('details') ? ' is-invalid' : ''); ?>" cols="0" rows="4" name="details"><?php echo e(isset($editData)? $editData->details: ''); ?></textarea>
                                            <label><?php echo app('translator')->getFromJson('lang.description'); ?> <span>*</span> </label>
                                            <span class="focus-border textarea"></span>
                                            <?php if($errors->has('details')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('details')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-gutters input-right-icon mb-30">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input form-control" name="upload_file_name" type="text" 
                                            placeholder="<?php echo e(isset($editData->upload_image_file) && $editData->upload_image_file != ""? showPicName($editData->upload_image_file):'Attach File'); ?>"
                                            id="placeholderHolidayFile" readonly>
                                            <span class="focus-border"></span>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="primary-btn-small-input" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="upload_holiday_image"><?php echo app('translator')->getFromJson('lang.browse'); ?></label>
                                            <input type="file" class="d-none form-control" name="upload_file_name" id="upload_holiday_image">
                                        </button>

                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg">
                                            <span class="ti-check"></span>
                                            <?php if(isset($editData)): ?>
                                                <?php echo app('translator')->getFromJson('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->getFromJson('lang.save'); ?>
                                            <?php endif; ?>
                                         </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>

            <div class="col-lg-9">
              <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.holiday'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></h3>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                        <thead>
                            <?php if(session()->has('message-success-delete') != "" ||
                                session()->get('message-danger-delete') != ""): ?>
                                <tr>
                                    <td colspan="6">
                                        <?php if(session()->has('message-success-delete')): ?>
                                        <div class="alert alert-success">
                                            <?php echo e(session()->get('message-success-delete')); ?>

                                        </div>
                                        <?php elseif(session()->has('message-danger-delete')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo e(session()->get('message-danger-delete')); ?>

                                        </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            <tr>
                            <th><?php echo app('translator')->getFromJson('lang.holiday'); ?> <?php echo app('translator')->getFromJson('lang.title'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.from_date'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.to_date'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.days'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.details'); ?></th>
                            <th><?php echo app('translator')->getFromJson('lang.action'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if(isset($holidays)): ?>
                        <?php $__currentLoopData = $holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php

                            $start = strtotime($value->from_date);
                            $end = strtotime($value->to_date);

                            $days_between = ceil(abs($end - $start) / 86400);
                            $days = $days_between + 1;

                        ?>
                        <tr>

                            <td><?php echo e($value->holiday_title); ?></td>
                            <td><?php echo e(date('jS M, Y', strtotime($value->from_date))); ?></td>
                            <td><?php echo e(date('jS M, Y', strtotime($value->to_date))); ?></td>
                            <td><?php echo e($days == 1? $days.' day':$days.' days'); ?></td>
                            <td><?php echo e(str_limit($value->details, 50)); ?></td>


                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        <?php echo app('translator')->getFromJson('lang.select'); ?>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">

                                        <a class="dropdown-item" href="<?php echo e(url('holiday/'.$value->id.'/edit')); ?>"><?php echo app('translator')->getFromJson('lang.edit'); ?></a>

                                        <a class="deleteUrl dropdown-item" data-modal-size="modal-md" title="Delete Holiday" href="<?php echo e(url('delete-holiday-view/'.$value->id)); ?>"><?php echo app('translator')->getFromJson('lang.delete'); ?></a>
                                        <?php if($value->upload_image_file != ""): ?>
                                             <a class="dropdown-item" href="<?php echo e(url('download-holiday-document/'.showPicName($value->upload_image_file))); ?>">
                                                 <?php echo app('translator')->getFromJson('lang.download'); ?> <span class="pl ti-download"></span>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </td>
                        </tr>
                
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
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