<?php $__env->startSection('mainContent'); ?>
<style type="text/css">
    #productTable tbody tr{
        border-bottom: 1px solid #FFFFFF !important;
    }
    .forStudentWrapper, #selectStaffsDiv{
        display: none;
    }
</style>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Item Sell</h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>">Dashboard</a>
                <a href="<?php echo e(url('item-sell')); ?>">Item Sell</a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
     
     <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'save-item-sell-data',
     'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'item-sell-form'])); ?>


     <div class="row">
        <div class="col-lg-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-title">
                        <h3 class="mb-30"><?php if(isset($editData)): ?>
                            Edit
                            <?php else: ?>

                            <?php endif; ?>
                            Sell Details
                        </h3>
                    </div>

                    <div class="white-box">
                        <div class="add-visitor">
                            <div class="row">
                                

                                 <div class="col-lg-12 mb-30">

                                    <div class="alert alert-danger" id="errorMessage1">
                                        <div id="buyerError"></div>                    
                                        <div id="classError"></div>                    
                                        <div id="sectionError"></div>                    
                                        <div id="studentError"></div>                    
                                        <div id="nameError"></div>                    
                                    </div>

                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('role_id') ? ' is-invalid' : ''); ?>" name="role_id" id="buyer_type">
                                            <option data-display="Sale To *" value="">Sale To *</option>
                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(isset($editData)): ?>
                                            <option value="<?php echo e($value->id); ?>" <?php echo e($value->id == $editData->role_id? 'selected':''); ?>><?php echo e($value->name); ?></option>
                                            <?php else: ?>
                                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>

                                            <?php endif; ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('role_id')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('role_id')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="forStudentWrapper col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-12 mb-30">
                                                <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                                    <option data-display="Select Class *" value="">Select Class *</option>
                                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($class->id); ?>"  <?php echo e(( old("class") == $class->id ? "selected":"")); ?>><?php echo e($class->class_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php if($errors->has('class')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong><?php echo e($errors->first('class')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>

                                            <div class="col-lg-12 mb-30" id="select_section_div">
                                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" id="select_section" name="section">
                                                    <option data-display="Select section *" value="">Select section *</option>
                                                </select>
                                                <?php if($errors->has('section')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong><?php echo e($errors->first('section')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>


                                            <div class="col-lg-12 mb-30" id="select_student_div">
                                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('student') ? ' is-invalid' : ''); ?>" id="select_student" name="student">
                                                    <option data-display="Select Student *" value="">Select Student *</option>
                                                </select>
                                                <?php if($errors->has('student')): ?>
                                                <span class="invalid-feedback invalid-select" role="alert">
                                                    <strong><?php echo e($errors->first('student')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-30" id="selectStaffsDiv">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('staff_id') ? ' is-invalid' : ''); ?>" name="staff_id" id="selectStaffs">
                                            <option data-display="Name *" value="">Name *</option>

                                            <?php if(isset($staffsByRole)): ?>
                                            <?php $__currentLoopData = $staffsByRole; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>" <?php echo e($value->id == $editData->staff_id? 'selected':''); ?>><?php echo e($value->full_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>

                                            <?php endif; ?>
                                        </select>
                                        <?php if($errors->has('staff_id')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('staff_id')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>

                                <div class="col-lg-12 mb-30">
                                    <div class="input-effect">
                                        <input class="primary-input form-control"
                                        type="text" name="reference_no" autocomplete="off" value="<?php echo e(isset($editData)? $editData->reference_no : ''); ?>">
                                        <label>Reference No </label>
                                        <span class="focus-border"></span>
                                        
                                    </div>
                                </div>

                                <div class="col-lg-12 no-gutters input-right-icon mb-30">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control<?php echo e($errors->has('sell_date') ? ' is-invalid' : ''); ?>"  id="sell_date" type="text"
                                            name="sell_date" value="<?php echo e(isset($editData)? date('m/d/Y', strtotime($editData->sell_date)): date('m/d/Y')); ?>" autocomplete="off">
                                            <label>Sell Date <span></span> </label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('sell_date')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('sell_date')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="receive_date_icon"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-20">
                                    <div class="input-effect">
                                        <textarea class="primary-input form-control" cols="0" rows="4" name="description" id="description"><?php echo e(isset($editData) ? $editData->description : ''); ?></textarea>
                                        <label>Description <span></span> </label>
                                        <span class="focus-border textarea"></span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-9">
            
          <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-30">Item Sale</h3>
                </div>
            </div>

            <div class="offset-lg-6 col-lg-2 text-right col-md-6">
                <button type="button" class="primary-btn small fix-gr-bg" onclick="addRowInSell();" id="addRowBtn">
                    <span class="ti-plus pr-2"></span>
                    Add 
                </button>
            </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
             <div class="white-box">
                <div class="alert alert-danger" id="errorMessage2">
                    <div id="itemError"></div>
                    <div id="priceError"></div>
                    <div id="quantityError"></div>                     
                </div>
                 <table class="table" id="productTable">
                    <thead>
                      <tr>
                          <th>Product Name</th>
                          <th>Sell Price</th>
                          <th>Quantity</th>
                          <th>Sub Total</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr id="row1" class="0">
                        <td class="border-top-0">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>"> 
                            <div class="input-effect">
                                <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('category_name') ? ' is-invalid' : ''); ?>" name="item_id[]" id="productName1">
                                    <option data-display="Select Item " value="">Select</option>
                                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>"
                                        <?php if(isset($editData)): ?>
                                        <?php if($editData->category_name == $value->id): ?>
                                        selected
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        ><?php echo e($value->item_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('item_id')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('item_id')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('unit_price') ? ' is-invalid' : ''); ?>"
                                    type="text" id="unit_price1" name="unit_price[]" autocomplete="off" value="<?php echo e(isset($editData)? $editData->unit_price : ''); ?>" onkeyup="getTotalByPrice(1)">

                                    <span class="focus-border"></span>
                                    <?php if($errors->has('unit_price')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('unit_price')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('quantity') ? ' is-invalid' : ''); ?>"
                                    type="text" id="quantity1" name="quantity[]" autocomplete="off" onkeyup="getTotalInSell(1);" value="<?php echo e(isset($editData)? $editData->quantity : ''); ?>">

                                    <span class="focus-border"></span>
                                    <?php if($errors->has('quantity')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('quantity')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('sub_total') ? ' is-invalid' : ''); ?>"
                                    type="text" name="total[]" id="total1" autocomplete="off" value="<?php echo e(isset($editData)? $editData->sub_total : '0.00'); ?>">

                                    <span class="focus-border"></span>
                                    <?php if($errors->has('sub_total')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('sub_total')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <input type="hidden" name="totalValue[]" id="totalValue1" autocomplete="off" class="form-control" />
                            </td>
                            <td>
                                <button class="primary-btn icon-only fix-gr-bg" type="button">
                                 <span class="ti-trash" id="removeSubject" onclick="deleteSubject(4)"></span>
                                 </button>
                            </td>
                        </tr>
                        <tfoot>
                            <tr>
                             <th class="border-top-0" colspan="2">Total</th>
                             <th class="border-top-0">
                                 <input type="text" class="primary-input form-control" id="subTotalQuantity" name="subTotalQuantity" placeholder="0.00" readonly="" />

                                 <input type="hidden" class="form-control" id="subTotalQuantityValue" name="subTotalQuantityValue" />

                             </th>

                             <th class="border-top-0">
                                 <input type="text" class="primary-input form-control" id="subTotal" name="subTotal" placeholder="0.00" readonly="" />

                                 <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />

                             </th>
                             <th class="border-top-0"></th>
                         </tr>
                     </tfoot>

                 </tbody>
             </table>
         </div>
     </div>
 </div>

 <div class="row mt-30">
    <div class="col-lg-12">
        <div class="white-box">

            <div class="row">
              <div class="col-lg-2 mt-30-md">
                 <div class="col-lg-12">
                    <div class="input-effect">
                        <input type="checkbox" id="full_paid" class="common-checkbox form-control<?php echo e($errors->has('full_paid') ? ' is-invalid' : ''); ?>" name="full_paid" value="1">                    
                    <label for="full_paid">Full Paid</label>
                    </div>
                </div>
            </div>  

            <div class="col-lg-3 mt-30-md">
             <div class="col-lg-12">
                <div class="input-effect">
                    <input class="primary-input" type="number" value="0" name="totalPaid" id="totalPaid" onkeyup="paidAmount();">
                    <input type="hidden" id="totalPaidValue" name="totalPaidValue">
                    <label>Total Paid</label>
                    <span class="focus-border"></span>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mt-30-md">
         <div class="col-lg-12">
            <div class="input-effect">
                <input class="primary-input" type="text" value="0.00" id="totalDue" readonly>
                <input type="hidden" id="totalDueValue" name="totalDueValue">
                <label>Total Due</label>
                <span class="focus-border"></span>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
      <select class="niceSelect w-100 bb form-control" name="payment_method" id="payment_method">
        <option data-display="Select Payment Method" value="">SELECT Payment Method </option>
        <?php $__currentLoopData = $paymentMethhods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($value->id); ?>"><?php echo e($value->method); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<div class="col-lg-12 mt-20 text-center">
   <button class="primary-btn fix-gr-bg">
    <span class="ti-check"></span>
    Sell
</button>
</div>
</div>


</div>
</div>
</div>
</div>
</div>
<?php echo e(Form::close()); ?>

</div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>