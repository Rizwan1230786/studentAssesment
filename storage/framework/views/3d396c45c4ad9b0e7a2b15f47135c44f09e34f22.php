<?php $__env->startSection('mainContent'); ?>
<?php
    $user = Auth::user()->student;
?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.online_exam'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.online_exam'); ?></a>
                <a href="<?php echo e(url('student-online-exam')); ?>"><?php echo app('translator')->getFromJson('lang.active_exams'); ?></a>
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
                            <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.online_active_exams'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                                <?php if(session()->has('message-success') != "" ||
                                session()->get('message-danger') != ""): ?>
                                <tr>
                                    <td colspan="6">
                                        <?php if(session()->has('message-success')): ?>
                                        <div class="alert alert-success alert-dismissible fade show"  role="alert">
                                            <?php echo e(session()->get('message-success')); ?>

                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?php elseif(session()->has('message-danger')): ?>
                                        <div class="alert alert-danger alert-dismissible fade show"  role="alert">
                                            <?php echo e(session()->get('message-danger')); ?>

                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <th><?php echo app('translator')->getFromJson('lang.title'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.class_Sec'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.subject'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.exam_date'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('lang.status'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $online_exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $online_exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $submitted_answer = App\SmStudentTakeOnlineExam::submittedAnswer($online_exam->id, $user->id);
                                    ?>
                                    <?php if(!in_array($online_exam->id, $marks_assigned)): ?>
                                    <tr>
                                        <td><?php echo e($online_exam->title); ?></td>
                                        <td><?php echo e($online_exam->class->class_name.'  ('.$online_exam->section->section_name.')'); ?></td>
                                        <td><?php echo e($online_exam->subject !=""?$online_exam->subject->subject_name:""); ?></td>
                                        <td><?php echo e(date('jS M, Y', strtotime($online_exam->date))); ?> <br> Time: <?php echo e($online_exam->start_time.' - '.$online_exam->end_time); ?></td>
                                        <td>
                                            <?php if($submitted_answer != ""): ?>
                                                <?php if($submitted_answer->status == 0): ?>
                                                    <a class="btn btn-success" href="<?php echo e(route("take_online_exam", [$online_exam->id])); ?>"><?php echo app('translator')->getFromJson('lang.take_exam'); ?></a>
                                                <?php else: ?>
                                                    <span class="btn btn-success">Already Submitted</span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <a class="btn btn-success" href="<?php echo e(route("take_online_exam", [$online_exam->id])); ?>"><?php echo app('translator')->getFromJson('lang.take_exam'); ?></a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade admin-query" id="deleteOnlineExam" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->getFromJson('lang.delete'); ?> <?php echo app('translator')->getFromJson('lang.item'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4><?php echo app('translator')->getFromJson('lang.are_you_sure_to_delete'); ?></h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->getFromJson('lang.cancel'); ?></button>
                     <?php echo e(Form::open(['url' => 'online-exam-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                     <input type="hidden" name="id" id="online_exam_id">
                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->getFromJson('lang.delete'); ?></button>
                     <?php echo e(Form::close()); ?>

                </div>
            </div>

        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>