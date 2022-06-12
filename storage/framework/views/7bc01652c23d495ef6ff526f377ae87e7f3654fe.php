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
                <h1>Add Course</h1>
                <div class="bc-pages">
                    <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                    <a href="#">Course</a>
                    <a href="#">Add Course</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            <?php if(isset($add_course)): ?>
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="<?php echo e(url('course-list')); ?>" class="primary-btn small fix-gr-bg">
                            <span class="ti-plus pr-2"></span>
                            <?php echo app('translator')->getFromJson('lang.add'); ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php if(isset($add_course)): ?>
                                    <?php echo app('translator')->getFromJson('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->getFromJson('lang.add'); ?>
                                <?php endif; ?>
                               Course
                            </h3>
                        </div>
                        <?php if(isset($add_course)): ?>
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update_course',
                            'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'add-income-update'])); ?>

                        <?php else: ?>
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'store_course',
                            'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'add-income'])); ?>

                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php if(session()->has('message-success')): ?>
                                            <div class="alert alert-success">
                                                <?php echo e(session()->get('message-success')); ?>

                                            </div>
                                        <?php elseif(session()->has('message-danger')): ?>
                                            <div class="alert alert-danger">
                                                <?php echo e(session()->get('message-danger')); ?>

                                            </div>
                                        <?php endif; ?>
                                        <?php if($errors->any()): ?>
                                            <div class="error text-danger">
                                                <strong><?php echo e('Please fill up the required fields'); ?></strong></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-lg-12">
                                            <div class="input-effect">
                                                <input
                                                    class="primary-input form-control<?php echo e($errors->has('title') ? ' is-invalid' : ''); ?>"
                                                    type="text" name="title" autocomplete="off"
                                                    value="<?php echo e(isset($add_course)? $add_course->title: old('title')); ?>">
                                                <input type="hidden" name="id" value="<?php echo e(isset($add_course)? $add_course->id: ''); ?>">
                                                <label><?php echo app('translator')->getFromJson('lang.title'); ?> <span>*</span></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('title')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('title')); ?></strong>
                                            </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mt-25">
                                                    <div class="col-lg-12">
                                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4"
                                                      name="overview"><?php echo e(isset($add_course)? $add_course->overview: old('overview')); ?></textarea>
                                                            <label>Overview <span></span></label>
                                                            <span class="focus-border textarea"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-25">
                                                    <div class="col-lg-12">
                                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4"
                                                      name="outline"><?php echo e(isset($add_course)? $add_course->outline: old('outline')); ?></textarea>
                                                            <label>Outline <span></span></label>
                                                            <span class="focus-border textarea"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-25">
                                                    <div class="col-lg-12">
                                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4"
                                                      name="prerequisites"><?php echo e(isset($add_course)? $add_course->prerequisites: old('prerequisites')); ?></textarea>
                                                            <label>Prerequisites <span></span></label>
                                                            <span class="focus-border textarea"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row mt-25">
                                                    <div class="col-lg-12">
                                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4"
                                                      name="resources"><?php echo e(isset($add_course)? $add_course->resources: old('resources')); ?></textarea>
                                                            <label>resources<span></span></label>
                                                            <span class="focus-border textarea"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4"
                                                      name="stats"><?php echo e(isset($add_course)? $add_course->stats: old('stats')); ?></textarea>
                                                            <label>stats <span></span></label>
                                                            <span class="focus-border textarea"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row no-gutters input-right-icon mt-50">
                                                    <div class="col">
                                                        <div class="row no-gutters input-right-icon">
                                                            <div class="col">
                                                                <div class="input-effect">
                                                                    <input class="primary-input" type="text" id="placeholderFileOneName"
                                                                           placeholder="<?php echo e(isset($add_course)? ($add_course->image !="") ? showPicName($add_course->image) :'image' :'image'); ?>"
                                                                           readonly
                                                                    >
                                                                    <span class="focus-border"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <button class="primary-btn-small-input" type="button">
                                                                    <label class="primary-btn small fix-gr-bg"
                                                                           for="document_file_1"><?php echo app('translator')->getFromJson('lang.browse'); ?></label>
                                                                    <input type="file" class="d-none" name="image" id="document_file_1">
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg">
                                            <span class="ti-check"></span>
                                            <?php if(isset($add_course)): ?>
                                                <?php echo app('translator')->getFromJson('lang.edit'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->getFromJson('lang.add'); ?>
                                            <?php endif; ?>
                                            Course
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-5">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0">Course List</h3>
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
                                    <td colspan="4">
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
                                <th><?php echo app('translator')->getFromJson('lang.title'); ?></th>
                                <th>overview</th>
                                <th><?php echo app('translator')->getFromJson('lang.image'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.action'); ?></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php if(isset($course)): ?>
                            <?php $__currentLoopData = $course; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($value->title); ?></td>
                                    <td><?php echo substr($value->overview, 0, 50); ?></td>
                                    <td><img src="<?php echo e(asset($value->image)); ?>" width="60px" height="50px"></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->getFromJson('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="<?php echo e(url('course-Details-admin/'.$value->id)); ?>" class="dropdown-item small fix-gr-bg modalLink" title="Course Details" data-modal-size="full-width-modal">
                                                    <?php echo app('translator')->getFromJson('lang.view'); ?>
                                                </a>
                                                <a class="dropdown-item" href="<?php echo e(url('edit-course/'.$value->id)); ?>"><?php echo app('translator')->getFromJson('lang.edit'); ?></a>
                                                <a href="<?php echo e(url('for-delete-course/'.$value->id)); ?>" class="dropdown-item small fix-gr-bg modalLink" title="Delete Course" data-modal-size="modal-md">
                                                    <?php echo app('translator')->getFromJson('lang.delete'); ?>
                                                </a>
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
    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>