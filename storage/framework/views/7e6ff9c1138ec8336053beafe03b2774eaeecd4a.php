<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>Fees</h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>">Dashboard</a>
                <a href="#">Fees</a>
                <a href="<?php echo e(route('student_fees')); ?>">Pay Fees</a>
            </div>
        </div>
    </div>
</section>

<input type="hidden" id="url" value="<?php echo e(URL::to('/')); ?>">
<input type="hidden" id="student_id" value="<?php echo e($student->id); ?>">
<section class="">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="d-flex justify-content-between">
                    <div class="main-title">
                        <h3 class="mb-30">Add Fees</h3>
                    </div>
                </div>
            </div>
        </div>
              <?php if(session()->has('message-success')): ?>
                <div class="alert alert-success">
                  <?php echo e(session()->get('message-success')); ?>

              </div>
              <?php elseif(session()->has('message-danger')): ?>
              <div class="alert alert-danger">
                  <?php echo e(session()->get('message-danger')); ?>

              </div>
              <?php endif; ?>

        <div class="row">
            <div class="col-lg-12">
                <table class="display school-table school-table-style" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <td>
                                
                            </td>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Fees Group</th>
                            <th>Fees Code</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Amount ($)</th>
                            <th>Payment ID</th>
                            <th>Mode</th>
                            <th>Date</th>
                            <th>Discount ($)</th>
                            <th>Fine ($)</th>
                            <th>Paid ($)</th>
                            <th>Balance</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $grand_total = 0;
                            $total_fine = 0;
                            $total_discount = 0;
                            $total_paid = 0;
                            $total_grand_paid = 0;
                            $total_balance = 0;
                        ?>
                        <?php $__currentLoopData = $fees_assigneds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_assigned): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                if($fees_assigned->feesGroupMaster->fees_group_id != 1 && $fees_assigned->feesGroupMaster->fees_group_id != 2){
                                    $grand_total += $fees_assigned->feesGroupMaster->amount;
                                }else{
                                    if($fees_assigned->feesGroupMaster->fees_group_id == 1){
                                        $grand_total += $student->route->far;
                                    }else{
                                        $grand_total += $student->room->cost_per_bed;
                                    }
                                }
                                
                            ?>

                            <?php
                                $discount_amount = App\SmFeesAssign::discountSum($fees_assigned->student_id, $fees_assigned->feesGroupMaster->feesTypes->id, 'discount_amount');
                                $total_discount += $discount_amount;
                                $student_id = $fees_assigned->student_id;
                            ?>
                            <?php
                                $paid = App\SmFeesAssign::discountSum($fees_assigned->student_id, $fees_assigned->feesGroupMaster->feesTypes->id, 'amount');
                                $total_grand_paid += $paid;
                            ?>
                            <?php
                                $fine = App\SmFeesAssign::discountSum($fees_assigned->student_id, $fees_assigned->feesGroupMaster->feesTypes->id, 'fine');
                                $total_fine += $fine;
                            ?>
                             
                            <?php
                                $total_paid = $discount_amount + $paid;
                            ?>
                        <tr>
                            <td>
                                <input type="checkbox" id="fees_group.<?php echo e($fees_assigned->id); ?>" class="common-checkbox fees-groups-print" name="fees_group[]" value="<?php echo e($fees_assigned->id); ?>">
                                <label for="fees_group.<?php echo e($fees_assigned->id); ?>"></label>
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                            </td>
                            <td><?php echo e($fees_assigned->feesGroupMaster->feesGroups->name); ?></td>
                            <td><?php echo e($fees_assigned->feesGroupMaster->feesTypes->name); ?></td>
                            <td><?php echo e(date('jS M, Y', strtotime($fees_assigned->feesGroupMaster->date))); ?></td>
                            <td>
                                <?php if($fees_assigned->feesGroupMaster->fees_group_id != 1 && $fees_assigned->feesGroupMaster->fees_group_id != 2): ?>
                                    <?php if($fees_assigned->feesGroupMaster->amount == $total_paid): ?>
                                    <button class="primary-btn small bg-success text-white border-0">Paid</button>
                                    <?php elseif($total_paid != 0): ?>
                                    <button class="primary-btn small bg-warning text-white border-0">Partial</button>
                                    <?php elseif($total_paid == 0): ?>
                                    <button class="primary-btn small bg-danger text-white border-0">Unpaid</button>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if($fees_assigned->feesGroupMaster->fees_group_id == 1): ?>
                                        <?php if($student->route->far == $total_paid): ?>
                                        <button class="primary-btn small bg-success text-white border-0">Paid</button>
                                        <?php elseif($total_paid != 0): ?>
                                        <button class="primary-btn small bg-warning text-white border-0">Partial</button>
                                        <?php elseif($total_paid == 0): ?>
                                        <button class="primary-btn small bg-danger text-white border-0">Unpaid</button>
                                        <?php endif; ?>
                                    <?php elseif($fees_assigned->feesGroupMaster->fees_group_id == 2): ?>
                                        <?php if($student->room->cost_per_bed == $total_paid): ?>
                                        <button class="primary-btn small bg-success text-white border-0">Paid</button>
                                        <?php elseif($total_paid != 0): ?>
                                        <button class="primary-btn small bg-warning text-white border-0">Partial</button>
                                        <?php elseif($total_paid == 0): ?>
                                        <button class="primary-btn small bg-danger text-white border-0">Unpaid</button>
                                        <?php endif; ?>
                                    <?php endif; ?>    
                                <?php endif; ?>    
                            </td>
                            <td>
                                <?php
                                    if($fees_assigned->feesGroupMaster->fees_group_id != 1 && $fees_assigned->feesGroupMaster->fees_group_id != 2){
                                        echo $fees_assigned->feesGroupMaster->amount;
                                    }else{
                                        if($fees_assigned->feesGroupMaster->fees_group_id == 1){
                                            echo $student->route->far;
                                        }else{
                                            echo $student->room->cost_per_bed;
                                        }
                                    }
                                    
                                ?>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td> <?php echo e($discount_amount); ?> </td>
                            <td><?php echo e($fine); ?></td>
                            <td><?php echo e($paid); ?></td>
                            <td>
                                <?php 

                                    if($fees_assigned->feesGroupMaster->fees_group_id != 1 && $fees_assigned->feesGroupMaster->fees_group_id != 2){
                                        $rest_amount = $fees_assigned->feesGroupMaster->amount - $total_paid;
                                    }else{
                                        if($fees_assigned->feesGroupMaster->fees_group_id == 1){
                                           $rest_amount = $student->route->far - $total_paid;
                                        }else{
                                           $rest_amount = $student->room->cost_per_bed - $total_paid;
                                        }
                                    }

                                    $total_balance +=  $rest_amount;
                                    echo $rest_amount;
                                ?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        Select
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                       
                                        <?php if($rest_amount != 0): ?>
                                        <a class="dropdown-item" href="<?php echo e(url('collect-fees-gateway', [$rest_amount, $fees_assigned->student_id, $fees_assigned->feesGroupMaster->fees_type_id])); ?>" >Pay via Paypal</a>
                                        <?php endif; ?>

                                        <?php if($rest_amount != 0): ?>
                                        <a class="dropdown-item" href="<?php echo e(url('collect-fees-stripe', [$rest_amount, $fees_assigned->student_id, $fees_assigned->feesGroupMaster->fees_type_id])); ?>" >Pay via Stripe</a>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </td>
                        </tr>
                            <?php 
                                $payments = App\SmFeesAssign::feesPayment($fees_assigned->feesGroupMaster->feesTypes->id, $fees_assigned->student_id);
                                $i = 0;
                            ?>

                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right"><img src="<?php echo e(asset('public/backEnd/img/table-arrow.png')); ?>"></td>
                                <td>
                                    <?php
                                        $created_by = App\user::find($payment->created_by);
                                    ?>
                                    <a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo e('Collected By: '.$created_by->full_name); ?>"><?php echo e($payment->fees_type_id.'/'.$payment->id); ?></a></td>
                                <td>
                                <?php if($payment->payment_mode == "C"): ?>
                                        <?php echo e('Cash'); ?>

                                <?php elseif($payment->payment_mode == "Cq"): ?>
                                    <?php echo e('Cheque'); ?>

                                <?php else: ?>
                                    <?php echo e('DD'); ?>

                                <?php endif; ?> 
                                </td>
                                <td><?php echo e(date('jS M, Y', strtotime($payment->payment_date))); ?></td>
                                <td><?php echo e($payment->discount_amount); ?></td>
                                <td><?php echo e($payment->fine); ?></td>
                                <td><?php echo e($payment->amount); ?></td>
                                <td></td>
                                <td>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $fees_discounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_discount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td></td>
                            <td>Discount</td>
                            <td><?php echo e($fees_discount->feesDiscount!=""?$fees_discount->feesDiscount->name:""); ?></td>
                            <td></td>
                            <td><?php if(in_array($fees_discount->id, $applied_discount)): ?>
                                <?php
                                    $createdBy = App\SmFeesAssign::createdBy($student_id, $fees_discount->id);
                                    $created_by = App\User::find($createdBy->created_by);

                                ?>
                                <a href="#" data-toggle="tooltip" data-placement="right" title="<?php echo e('Collected By: '.$created_by->full_name); ?>">Discount of $<?php echo e($fees_discount->feesDiscount->amount); ?> Applied : <?php echo e($createdBy->id.'/'.$createdBy->created_by); ?></a>
                                
                                <?php else: ?>
                                Discount of $<?php echo e($fees_discount->feesDiscount->amount); ?> Assigned
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($fees_discount->name); ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Grand Total ($)</th>
                            <th></th>
                            <th><?php echo e($grand_total); ?></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><?php echo e($total_discount); ?></th>
                            <th><?php echo e($total_fine); ?></th>
                            <th><?php echo e($total_grand_paid); ?></th>
                            <th><?php echo e($total_balance); ?></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>

<div class="modal fade admin-query" id="deleteFeesPayment" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Item</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4>Are you sure to detete this item?</h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Cancel</button>
                     <?php echo e(Form::open(['url' => 'fees-payment-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                     <input type="hidden" name="id" id="feep_payment_id">
                    <button class="primary-btn fix-gr-bg" type="submit">Delete</button>
                     <?php echo e(Form::close()); ?>

                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>