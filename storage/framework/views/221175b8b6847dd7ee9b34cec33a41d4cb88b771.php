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
                <h1><?php echo app('translator')->getFromJson('lang.add_news'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->getFromJson('lang.news'); ?></a>
                    <a href="#"><?php echo app('translator')->getFromJson('lang.add_news'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            <?php if(isset($add_news)): ?>
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="<?php echo e(url('news')); ?>" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30"><?php if(isset($add_news)): ?>
                                    <?php echo app('translator')->getFromJson('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->getFromJson('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->getFromJson('lang.news'); ?>
                            </h3>
                        </div>
                        <?php if(isset($add_news)): ?>
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update_news',
                            'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'add-income-update'])); ?>

                        <?php else: ?>
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'store_news',
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
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                                    <input
                                                        class="primary-input form-control<?php echo e($errors->has('title') ? ' is-invalid' : ''); ?>"
                                                        type="text" name="title" autocomplete="off"
                                                        value="<?php echo e(isset($add_news)? $add_news->news_title: old('title')); ?>">
                                                    <input type="hidden" name="id" value="<?php echo e(isset($add_news)? $add_news->id: ''); ?>">
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
                                        <div class="row mt-25">
                                            <div class="col-lg-12">
                                                <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4"
                                                      name="description"><?php echo e(isset($add_news)? $add_news->news_body: old('news_body')); ?></textarea>
                                                    <label><?php echo app('translator')->getFromJson('lang.description'); ?> <span></span></label>
                                                    <span class="focus-border textarea"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <select
                                                    class="niceSelect w-100 bb form-control<?php echo e($errors->has('accounts') ? ' is-invalid' : ''); ?>"
                                                    name="category_id">
                                                    <?php $__currentLoopData = $news_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option data-display="<?php echo e($value->category_name); ?> *" value="<?php echo e($value->id); ?>"><?php echo e($value->category_name); ?> *</option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php if($errors->has('accounts')): ?>
                                                    <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('accounts')); ?></strong>
                                        </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="row no-gutters input-right-icon mt-20">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input
                                                        class="primary-input date form-control<?php echo e($errors->has('date') ? ' is-invalid' : ''); ?>"
                                                        id="startDate" type="text" placeholder="<?php echo app('translator')->getFromJson('lang.date'); ?> *"
                                                        name="date"
                                                        value="<?php echo e(isset($add_news)? date('m/d/Y', strtotime($add_news->publish_date)): date('m/d/Y')); ?>">
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('date')): ?>
                                                        <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('date')); ?></strong>
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
                                        <div class="row no-gutters input-right-icon mt-20">
                                            <div class="col">
                                                <div class="row no-gutters input-right-icon">
                                                    <div class="col">
                                                        <div class="input-effect">
                                                            <input class="primary-input" type="text" id="placeholderFileOneName"
                                                                   placeholder="<?php echo e(isset($add_news)? ($add_news->image !="") ? showPicName($add_news->image) :'image' :'image'); ?>"
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
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg">
                                            <span class="ti-check"></span>
                                            <?php if(isset($add_news)): ?>
                                                <?php echo app('translator')->getFromJson('lang.edit'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->getFromJson('lang.add'); ?>
                                            <?php endif; ?>
                                            <?php echo app('translator')->getFromJson('lang.news'); ?>
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
                            <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.news_list'); ?></h3>
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
                                    <td colspan="7">
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
                                <th><?php echo app('translator')->getFromJson('lang.publication_date'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.category'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.image'); ?></th>
                                <th><?php echo app('translator')->getFromJson('lang.action'); ?></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($value->news_title); ?></td>
                                    <td><?php echo e(date('jS M, Y', strtotime($value->publish_date))); ?></td>
                                    <td><?php echo e($value->category !=""?$value->category->category_name:""); ?></td>
                                    <td><img src="<?php echo e(asset($value->image)); ?>" width="60px" height="50px"></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->getFromJson('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="<?php echo e(url('newsDetails/'.$value->id)); ?>" class="dropdown-item small fix-gr-bg modalLink" title="News Details" data-modal-size="modal-lg">
                                                    <?php echo app('translator')->getFromJson('lang.view'); ?>
                                                </a>
                                                <a class="dropdown-item" href="<?php echo e(url('edit-news/'.$value->id)); ?>"><?php echo app('translator')->getFromJson('lang.edit'); ?></a>
                                                <a href="<?php echo e(url('for-delete-news/'.$value->id)); ?>" class="dropdown-item small fix-gr-bg modalLink" title="Delete News" data-modal-size="modal-md">
                                                    <?php echo app('translator')->getFromJson('lang.delete'); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>