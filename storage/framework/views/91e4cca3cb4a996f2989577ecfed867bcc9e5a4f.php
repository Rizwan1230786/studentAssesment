<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1>Contact Messages</h1>
                <div class="bc-pages">
                    <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                    <a href="#">Front Settings</a>
                    <a href="#">Contact Messages</a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0">Contact Messages</h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">

                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                                <thead>
                                <tr>
                                    <th width="10%">Name</th>
                                    <th width="20%">Email</th>
                                    <th width="10%">Subject</th>
                                    <th width="10%">Message</th>
                                    <th width="10%">Is Read?</th>
                                    <th width="10%">Is Replied?</th>
                                    <th width="10%">Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php $__currentLoopData = $contact_messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact_message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td width="10%"><?php echo e($contact_message->name); ?></td>
                                        <td width="20%"><?php echo e($contact_message->email); ?></td>
                                        <td width="10%"><?php echo e($contact_message->subject); ?></td>
                                        <td width="10%"><?php echo e($contact_message->message); ?></td>
                                        <td width="10%">
                                            <?php if($contact_message->view_status == 0): ?>
                                                <button class="primary-btn small fix-gr-bg" type="button">No</button>
                                            <?php else: ?>
                                                <button class="primary-btn small fix-gr-bg" type="button"">No</button>
                                            <?php endif; ?>
                                        </td>
                                        <td width="10%">
                                            <?php if($contact_message->reply_status == 0): ?>
                                                <button class="primary-btn small fix-gr-bg" type="button">No</button>
                                            <?php else: ?>
                                                <button class="primary-btn small fix-gr-bg" type="button">No</button>
                                            <?php endif; ?>
                                        </td>
                                        <td width="10%">
                                            <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                Select
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">edit</a>
                                                <a class="dropdown-item" data-toggle="modal" data-target="#"  href="#">delete</a>
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
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>