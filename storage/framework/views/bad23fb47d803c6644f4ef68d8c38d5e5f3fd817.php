<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.item_category'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.inventory'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.item_category'); ?> <?php echo app('translator')->getFromJson('lang.list'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
       <?php if(isset($editData)): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(url('item-category')); ?>" class="primary-btn small fix-gr-bg">
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
                                <?php echo app('translator')->getFromJson('lang.item_category'); ?>
                            </h3>
                        </div>
                        <?php if(isset($editData)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'item-category/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                        <?php else: ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'item-category',
                        'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <?php if(session()->has('message-success')): ?>
                                    <div class="alert alert-success mb-20">
                                        <?php echo e(session()->get('message-success')); ?>

                                    </div>
                                    <?php elseif(session()->has('message-danger')): ?>
                                    <div class="alert alert-danger">
                                        <?php echo e(session()->get('message-danger')); ?>

                                    </div>
                                    <?php endif; ?>

                                    <div class="col-lg-12 mb-20">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('category_name') ? ' is-invalid' : ''); ?>"
                                            type="text" name="category_name" autocomplete="off" value="<?php echo e(isset($editData)? $editData->category_name : ''); ?>">
                                            <label><?php echo app('translator')->getFromJson('lang.category'); ?> <?php echo app('translator')->getFromJson('lang.name'); ?> <span>*</span> </label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('category_name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('category_name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">

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
                    <h3 class="mb-0"> <?php echo app('translator')->getFromJson('lang.item_category'); ?>  <?php echo app('translator')->getFromJson('lang.list'); ?></h3>
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
                                    <td colspan="2">
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
                            <th> <?php echo app('translator')->getFromJson('lang.category'); ?>  <?php echo app('translator')->getFromJson('lang.title'); ?></th>
                            <th> <?php echo app('translator')->getFromJson('lang.action'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if(isset($itemCategories)): ?>
                        <?php $__currentLoopData = $itemCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>

                            <td><?php echo e($value->category_name); ?></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        <?php echo app('translator')->getFromJson('lang.select'); ?>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">

                                        <a class="dropdown-item" href="<?php echo e(url('item-category/'.$value->id.'/edit')); ?>"> <?php echo app('translator')->getFromJson('lang.edit'); ?></a>

                                        <a class="deleteUrl dropdown-item" data-modal-size="modal-md" title="Delete Item Category" href="<?php echo e(url('delete-item-category-view/'.$value->id)); ?>"> <?php echo app('translator')->getFromJson('lang.delete'); ?></a>

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