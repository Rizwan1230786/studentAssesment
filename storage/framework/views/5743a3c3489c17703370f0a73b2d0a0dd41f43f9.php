<?php $__env->startSection('mainContent'); ?>
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
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'fees-discount-assign-search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_studentA'])); ?>

                            <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <input type="hidden" name="fees_discount_id" id="fees_discount_id" value="<?php echo e($fees_discount_id); ?>">
                                <div class="col-lg-3 mt-30-md">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select_class'); ?>" value=""><?php echo app('translator')->getFromJson('lang.select_class'); ?></option>
                                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($class->id); ?>" <?php echo e(isset($class_id)? ($class_id == $class->id? 'selected':''):''); ?>><?php echo e($class->class_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                     <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-3 mt-30-md" id="select_section_div">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" id="select_section" name="section">
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select_section'); ?>" value=""><?php echo app('translator')->getFromJson('lang.select_section'); ?></option>
                                    </select>
                                    <?php if($errors->has('section')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('section')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-3 mt-30-md">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('category') ? ' is-invalid' : ''); ?>" name="category">
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select'); ?> <?php echo app('translator')->getFromJson('lang.category'); ?>" value=""><?php echo app('translator')->getFromJson('lang.select'); ?> <?php echo app('translator')->getFromJson('lang.category'); ?></option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>")}} <?php echo e(isset($category_id)? ($category_id == $category->id? 'selected':''):''); ?>><?php echo e($category->category_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('category')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('category')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-3 mt-30-md">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" name="gender">
                                        <option data-display="<?php echo app('translator')->getFromJson('lang.select'); ?> <?php echo app('translator')->getFromJson('lang.gender'); ?> *" value=""><?php echo app('translator')->getFromJson('lang.select'); ?> <?php echo app('translator')->getFromJson('lang.gender'); ?> </option>
                                        <?php $__currentLoopData = $genders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($gender->id); ?>" <?php echo e(isset($gender_id)? ($gender_id == $gender->id? 'selected':''):''); ?>><?php echo e($gender->base_setup_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('section')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('section')); ?></strong>
                                    </span>
                                    <?php endif; ?>
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
    <?php if(isset($students)): ?>

        
            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'method' => 'POST', 'url' => 'fees-assign-store', 'enctype' => 'multipart/form-data'])); ?>

       


            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row mb-30">
                        <div class="col-lg-6 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo app('translator')->getFromJson('lang.assign'); ?> <?php echo app('translator')->getFromJson('lang.fees_discount'); ?></h3>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="fees_discount_id" value="<?php echo e($fees_discount_id); ?>" id="fees_discount_id">
                      
                    <!-- </div> -->
                    <div class="row">
                        <div class="col-lg-4">
                            <table id="table_id_table" class="display school-table" cellspacing="0" width="100%">  
                                <thead>
                                    <tr>
                                        <tr>
                                            <th><?php echo app('translator')->getFromJson('lang.fees_discount'); ?></th>
                                            <th></th>
                                        </tr>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td><?php echo e($fees_discount->name); ?></td>
                                        <td><?php echo e($fees_discount->amount); ?></td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-8">
                            <table id="table_id_table_one" class="display school-table" cellspacing="0" width="100%">
                                        
                                <thead>
                                    <tr>
                                        <th width="10%">
                                            <input type="checkbox" id="checkAll" class="common-checkbox" name="checkAll"  <?php
                                                if(count($students) > 0){
                                                    if(count($students) == count($pre_assigned)){
                                                        echo 'checked';
                                                    }
                                                           
                                                }
                                            ?>>
                                            <label for="checkAll" 
                                                
                                           
                                            > <?php echo app('translator')->getFromJson('lang.all'); ?></label>
                                        </th>
                                        <th width="20%"><?php echo app('translator')->getFromJson('lang.student'); ?> <?php echo app('translator')->getFromJson('lang.name'); ?></th>
                                        <th width="15%"><?php echo app('translator')->getFromJson('lang.admission'); ?> <?php echo app('translator')->getFromJson('lang.no'); ?></th>
                                        <th width="15%"><?php echo app('translator')->getFromJson('lang.class'); ?></th>
                                        <th width="20%"><?php echo app('translator')->getFromJson('lang.father_name'); ?></th>
                                        <th width="10%"><?php echo app('translator')->getFromJson('lang.category'); ?></th>
                                        <th width="10%"><?php echo app('translator')->getFromJson('lang.gender'); ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" id="student.<?php echo e($student->id); ?>" class="common-checkbox" name="student_checked[]" value="<?php echo e($student->id); ?>" <?php echo e(in_array($student->id, $pre_assigned)? 'checked':''); ?>>
                                            <label for="student.<?php echo e($student->id); ?>"></label>
                                        </td>
                                        <td><?php echo e($student->first_name.' '.$student->last_name); ?> <input type="hidden" name="id[]" value="<?php echo e(isset($update)? $student->forwardBalance->id: $student->id); ?>"></td>
                                        <td><?php echo e($student->admission_no); ?></td>
                                        <td><?php echo e($student->className!=""?$student->className->class_name :"".'('.$student->section!=""?$student->section->section_name:"".')'); ?></td>
                                        
                                        <td><?php echo e($student->parents!=""?$student->parents->fathers_name:""); ?></td>
                                        <td><?php echo e($student->category!=""?$student->category->category_name:""); ?></td>
                                        <td><?php echo e($student->gender!=""?$student->gender->base_setup_name:""); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </tbody>
                                <?php if($students->count() > 0): ?>
                                <tr>
                                    <td colspan="7">
                                        <div class="text-center">
                                            <button type="button" class="primary-btn fix-gr-bg mb-0" id="btn-assign-fees-discount">
                                                <span class="ti-save pr"></span>
                                                <?php echo app('translator')->getFromJson('lang.assign'); ?>  <?php echo app('translator')->getFromJson('lang.discount'); ?>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                       
                            </table>
                        </div>

                    </div>
                </div>
            </div>
    <?php echo e(Form::close()); ?>

    <?php endif; ?>

    </div>
</section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>