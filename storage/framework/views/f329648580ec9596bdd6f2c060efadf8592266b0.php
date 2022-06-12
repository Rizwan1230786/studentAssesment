<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->getFromJson('lang.payment_method_settings'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(url('dashboard')); ?>"><?php echo app('translator')->getFromJson('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.system_settings'); ?></a>
                <a href="#"><?php echo app('translator')->getFromJson('lang.payment_method_settings'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="mb-40 student-details">
    <div class="container-fluid p-0">
        <div class="row">
         <div class="col-lg-3">
            <div class="main-title">
                <h3 class="mb-30"><?php echo app('translator')->getFromJson('lang.select_a_payment_gateway'); ?></h3>  
            </div>
            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => '', 'id' => 'select_payment_gateway'])); ?>


            <div class="white-box">
                <div class="col-lg-12">
                 <?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <div class="">
                    <input type="radio" id="gateway_<?php echo e($value->id); ?>" onclick="active_payment_gateway('<?php echo e($value->method); ?>');" class="common-checkbox" value="<?php echo e($value->method); ?>" name="payment_gateway[]"
                    <?php if($activepaymentGateway->gateway_name == $value->method): ?>
                        <?php echo app('translator')->getFromJson('lang.checked'); ?>
                    <?php endif; ?>
                    >
                    <label for="gateway_<?php echo e($value->id); ?>"><?php echo e($value->method); ?></label>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php echo e(Form::close()); ?>

    </div>
    <div class="col-lg-9">
     <ul class="nav nav-tabs justify-content-end" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="#paypal_settings" role="tab" data-toggle="tab"><?php echo app('translator')->getFromJson('lang.paypal'); ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#stripe_settings" role="tab" data-toggle="tab"><?php echo app('translator')->getFromJson('lang.stripe'); ?></a>
        </li>
        
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade show active" id="paypal_settings">

            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'update-paypal-data', 'id' => 'paypal_settings_form'])); ?>

            <div class="white-box">
                <div class="">
                    <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>"> 
                    <input type="hidden" name="paypal_form_url" id="paypal_form_url" value="update-paypal-data">
                    <input type="hidden" name="gateway_id" id="gateway_id" value="1"> 
                    <div class="row mb-30">
                       <div class="col-md-5">
                        <div class="row">
                            <div class="col-lg-12 mb-30">
                                <div class="input-effect">

                                    <input class="primary-input form-control<?php echo e($errors->has('paypal_username') ? ' is-invalid' : ''); ?>"
                                    type="text" name="paypal_username" id="paypal_username" autocomplete="off" value="<?php echo e(isset($payment_gateways)? $payment_gateways[0]->paypal_username : ''); ?>">
                                    <label><?php echo app('translator')->getFromJson('lang.paypal'); ?> <?php echo app('translator')->getFromJson('lang.username'); ?> <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    <span class="modal_input_validation red_alert"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-30">
                                <div class="input-effect">

                                    <input class="primary-input form-control<?php echo e($errors->has('paypal_password') ? ' is-invalid' : ''); ?>"
                                    type="text" name="paypal_password" id="paypal_password" autocomplete="off" value="<?php echo e(isset($payment_gateways)? $payment_gateways[0]->paypal_password : ''); ?>">
                                    <label><?php echo app('translator')->getFromJson('lang.paypal'); ?> <?php echo app('translator')->getFromJson('lang.password'); ?> <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    <span class="modal_input_validation red_alert"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-lg-12 mb-30">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('paypal_signature') ? ' is-invalid' : ''); ?>"
                                    type="text" name="paypal_signature" id="paypal_signature" autocomplete="off" value="<?php echo e(isset($payment_gateways)? $payment_gateways[0]->paypal_signature : ''); ?>">
                                    <label><?php echo app('translator')->getFromJson('lang.paypal'); ?> <?php echo app('translator')->getFromJson('lang.signature'); ?> <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('paypal_signature')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('paypal_signature')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-30">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('paypal_client_id') ? ' is-invalid' : ''); ?>"
                                    type="text" name="paypal_client_id" id="paypal_client_id" autocomplete="off" value="<?php echo e(isset($payment_gateways)? $payment_gateways[0]->paypal_client_id : ''); ?>">
                                    <label><?php echo app('translator')->getFromJson('lang.paypal'); ?> <?php echo app('translator')->getFromJson('lang.client_id'); ?><span>*</span> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('paypal_client_id')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('paypal_client_id')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-30">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('paypal_client_id') ? ' is-invalid' : ''); ?>"
                                    type="text" name="paypal_secret_id" id="paypal_secret_id" autocomplete="off" value="<?php echo e(isset($payment_gateways)? $payment_gateways[0]->paypal_secret_id : ''); ?>">
                                    <label><?php echo app('translator')->getFromJson('lang.paypal'); ?> <?php echo app('translator')->getFromJson('lang.secret_id'); ?><span>*</span> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('paypal_secret_id')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('paypal_secret_id')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="row justify-content-center">
                            <img class="logo" width="250" height="90" src="<?php echo e(URL::asset('public/backEnd/img/paypal.png')); ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-40">
                <div class="col-lg-12 text-center">
                    <button class="primary-btn fix-gr-bg">
                        <span class="ti-check"></span>
                        <?php echo app('translator')->getFromJson('lang.update'); ?>
                    </button>
                </div>
            </div>
        </div>
        <?php echo e(Form::close()); ?>

    </div>
    <!-- End Profile Tab -->

    <!-- Start Exam Tab -->
    <div role="tabpanel" class="tab-pane fade" id="stripe_settings">

        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'update-twilio-data', 'id' => 'stripe_form'])); ?>

        <div class="white-box">
            <div class="">
                <input type="hidden" name="stripe_form_url" id="stripe_form_url" value="update-stripe-data">

                <input type="hidden" name="gateway_id" id="gateway_id" value="2"> 
                <div class="row mb-30">

                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-lg-12 mb-30">
                                <div class="input-effect">

                                    <input class="primary-input form-control<?php echo e($errors->has('stripe_api_secret_key') ? ' is-invalid' : ''); ?>"
                                    type="text" name="stripe_api_secret_key" autocomplete="off" value="<?php echo e(isset($payment_gateways)? $payment_gateways[1]->stripe_api_secret_key : ''); ?>" id="stripe_api_secret_key">
                                    <label> <?php echo app('translator')->getFromJson('lang.stripe_api_secret_key'); ?><span>*</span> </label>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-30">
                                <div class="input-effect">

                                    <input class="primary-input form-control<?php echo e($errors->has('stripe_publisher_key') ? ' is-invalid' : ''); ?>"
                                    type="text" name="stripe_publisher_key" autocomplete="off" value="<?php echo e(isset($payment_gateways)? $payment_gateways[1]->stripe_publisher_key : ''); ?>" id="stripe_publisher_key">
                                    <label><?php echo app('translator')->getFromJson('lang.stripe_publisher_key'); ?> <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('stripe_publisher_key')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('stripe_publisher_key')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="row justify-content-center">
                            <img class="logo" width="250" height="90" src="<?php echo e(URL::asset('public/backEnd/img/Stripe_logo.png')); ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-40">
                <div class="col-lg-12 text-center">
                    <button class="primary-btn fix-gr-bg">
                        <span class="ti-check"></span>
                        <?php echo app('translator')->getFromJson('lang.update'); ?>
                    </button>
                </div>
            </div>
        </div>
        <?php echo e(Form::close()); ?>

    </div>
    <div role="tabpanel" class="tab-pane fade" id="pay_u_money">
        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'update-payumoney-data', 'id' => 'payumoney_form'])); ?>

        <div class="white-box">
            <div class="">
                <input type="hidden" name="payumoney_form_url" id="payumoney_form_url" value="update-payumoney-data">
                <input type="hidden" name="gateway_id" id="gateway_id" value="3"> 
                <div class="row mb-30">
                   <div class="col-md-5">
                    <div class="row">
                        <div class="col-lg-12 mb-30">
                            <div class="input-effect">

                                <input class="primary-input form-control<?php echo e($errors->has('pay_u_money_key') ? ' is-invalid' : ''); ?>"
                                type="text" id="pay_u_money_key" name="pay_u_money_key" autocomplete="off" value="<?php echo e(isset($payment_gateways)? $payment_gateways[2]->pay_u_money_key : ''); ?>">
                                <label> <?php echo app('translator')->getFromJson('lang.pay_u_money_key'); ?><span>*</span> </label>
                                <span class="focus-border"></span>
                                <?php if($errors->has('pay_u_money_key')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('pay_u_money_key')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-30">
                            <div class="input-effect">

                                <input class="primary-input form-control<?php echo e($errors->has('pay_u_money_salt') ? ' is-invalid' : ''); ?>"
                                type="text" name="pay_u_money_salt" autocomplete="off" value="<?php echo e(isset($payment_gateways)? $payment_gateways[2]-> pay_u_money_salt : ''); ?>" id="pay_u_money_salt">
                                <label> <?php echo app('translator')->getFromJson('lang.pay_u_money_salt'); ?><span>*</span> </label>
                                <span class="focus-border"></span>
                                <?php if($errors->has('pay_u_money_salt')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('pay_u_money_salt')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row justify-content-center">
                        <img class="logo" width="250" height="90" src="<?php echo e(URL::asset('public/backEnd/img/payumoney-logo.png')); ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-40">
            <div class="col-lg-12 text-center">
                <button class="primary-btn fix-gr-bg">
                    <span class="ti-check"></span>
                    <?php echo app('translator')->getFromJson('lang.update'); ?>
                </button>
            </div>
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
</div>
</div>
</div>
</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>