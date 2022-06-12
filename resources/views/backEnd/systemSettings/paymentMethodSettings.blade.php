@extends('backEnd.master')
@section('mainContent')
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1>@lang('lang.payment_method_settings')</h1>
            <div class="bc-pages">
                <a href="{{url('dashboard')}}">@lang('lang.dashboard')</a>
                <a href="#">@lang('lang.system_settings')</a>
                <a href="#">@lang('lang.payment_method_settings')</a>
            </div>
        </div>
    </div>
</section>
<section class="mb-40 student-details">
    <div class="container-fluid p-0">
        <div class="row">
         <div class="col-lg-3">
            <div class="main-title">
                <h3 class="mb-30">@lang('lang.select_a_payment_gateway')</h3>  
            </div>
            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => '', 'id' => 'select_payment_gateway']) }}

            <div class="white-box">
                <div class="col-lg-12">
                 @foreach($paymentMethods as $value)
                 <div class="">
                    <input type="radio" id="gateway_{{$value->id}}" onclick="active_payment_gateway('{{$value->method}}');" class="common-checkbox" value="{{$value->method}}" name="payment_gateway[]"
                    @if($activepaymentGateway->gateway_name == $value->method)
                        @lang('lang.checked')
                    @endif
                    >
                    <label for="gateway_{{$value->id}}">{{$value->method}}</label>
                </div>
                @endforeach
            </div>
        </div>
        {{ Form::close() }}
    </div>
    <div class="col-lg-9">
     <ul class="nav nav-tabs justify-content-end" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="#paypal_settings" role="tab" data-toggle="tab">@lang('lang.paypal')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#stripe_settings" role="tab" data-toggle="tab">@lang('lang.stripe')</a>
        </li>
        {{-- <li class="nav-item">

            <a class="nav-link" href="#pay_u_money" role="tab" data-toggle="tab">@lang('lang.payUMoney')</a>
        </li> --}}
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade show active" id="paypal_settings">

            {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'update-paypal-data', 'id' => 'paypal_settings_form']) }}
            <div class="white-box">
                <div class="">
                    <input type="hidden" name="url" id="url" value="{{URL::to('/')}}"> 
                    <input type="hidden" name="paypal_form_url" id="paypal_form_url" value="update-paypal-data">
                    <input type="hidden" name="gateway_id" id="gateway_id" value="1"> 
                    <div class="row mb-30">
                       <div class="col-md-5">
                        <div class="row">
                            <div class="col-lg-12 mb-30">
                                <div class="input-effect">

                                    <input class="primary-input form-control{{ $errors->has('paypal_username') ? ' is-invalid' : '' }}"
                                    type="text" name="paypal_username" id="paypal_username" autocomplete="off" value="{{isset($payment_gateways)? $payment_gateways[0]->paypal_username : ''}}">
                                    <label>@lang('lang.paypal') @lang('lang.username') <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    <span class="modal_input_validation red_alert"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-30">
                                <div class="input-effect">

                                    <input class="primary-input form-control{{ $errors->has('paypal_password') ? ' is-invalid' : '' }}"
                                    type="text" name="paypal_password" id="paypal_password" autocomplete="off" value="{{isset($payment_gateways)? $payment_gateways[0]->paypal_password : ''}}">
                                    <label>@lang('lang.paypal') @lang('lang.password') <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    <span class="modal_input_validation red_alert"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-lg-12 mb-30">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('paypal_signature') ? ' is-invalid' : '' }}"
                                    type="text" name="paypal_signature" id="paypal_signature" autocomplete="off" value="{{isset($payment_gateways)? $payment_gateways[0]->paypal_signature : ''}}">
                                    <label>@lang('lang.paypal') @lang('lang.signature') <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('paypal_signature'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('paypal_signature') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-30">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('paypal_client_id') ? ' is-invalid' : '' }}"
                                    type="text" name="paypal_client_id" id="paypal_client_id" autocomplete="off" value="{{isset($payment_gateways)? $payment_gateways[0]->paypal_client_id : ''}}">
                                    <label>@lang('lang.paypal') @lang('lang.client_id')<span>*</span> </label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('paypal_client_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('paypal_client_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-30">
                                <div class="input-effect">
                                    <input class="primary-input form-control{{ $errors->has('paypal_client_id') ? ' is-invalid' : '' }}"
                                    type="text" name="paypal_secret_id" id="paypal_secret_id" autocomplete="off" value="{{isset($payment_gateways)? $payment_gateways[0]->paypal_secret_id : ''}}">
                                    <label>@lang('lang.paypal') @lang('lang.secret_id')<span>*</span> </label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('paypal_secret_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('paypal_secret_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="row justify-content-center">
                            <img class="logo" width="250" height="90" src="{{ URL::asset('public/backEnd/img/paypal.png') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-40">
                <div class="col-lg-12 text-center">
                    <button class="primary-btn fix-gr-bg">
                        <span class="ti-check"></span>
                        @lang('lang.update')
                    </button>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
    <!-- End Profile Tab -->

    <!-- Start Exam Tab -->
    <div role="tabpanel" class="tab-pane fade" id="stripe_settings">

        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'update-twilio-data', 'id' => 'stripe_form']) }}
        <div class="white-box">
            <div class="">
                <input type="hidden" name="stripe_form_url" id="stripe_form_url" value="update-stripe-data">

                <input type="hidden" name="gateway_id" id="gateway_id" value="2"> 
                <div class="row mb-30">

                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-lg-12 mb-30">
                                <div class="input-effect">

                                    <input class="primary-input form-control{{ $errors->has('stripe_api_secret_key') ? ' is-invalid' : '' }}"
                                    type="text" name="stripe_api_secret_key" autocomplete="off" value="{{isset($payment_gateways)? $payment_gateways[1]->stripe_api_secret_key : ''}}" id="stripe_api_secret_key">
                                    <label> @lang('lang.stripe_api_secret_key')<span>*</span> </label>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-30">
                                <div class="input-effect">

                                    <input class="primary-input form-control{{ $errors->has('stripe_publisher_key') ? ' is-invalid' : '' }}"
                                    type="text" name="stripe_publisher_key" autocomplete="off" value="{{isset($payment_gateways)? $payment_gateways[1]->stripe_publisher_key : ''}}" id="stripe_publisher_key">
                                    <label>@lang('lang.stripe_publisher_key') <span>*</span> </label>
                                    <span class="focus-border"></span>
                                    @if ($errors->has('stripe_publisher_key'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('stripe_publisher_key') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="row justify-content-center">
                            <img class="logo" width="250" height="90" src="{{ URL::asset('public/backEnd/img/Stripe_logo.png') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-40">
                <div class="col-lg-12 text-center">
                    <button class="primary-btn fix-gr-bg">
                        <span class="ti-check"></span>
                        @lang('lang.update')
                    </button>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
    <div role="tabpanel" class="tab-pane fade" id="pay_u_money">
        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'update-payumoney-data', 'id' => 'payumoney_form']) }}
        <div class="white-box">
            <div class="">
                <input type="hidden" name="payumoney_form_url" id="payumoney_form_url" value="update-payumoney-data">
                <input type="hidden" name="gateway_id" id="gateway_id" value="3"> 
                <div class="row mb-30">
                   <div class="col-md-5">
                    <div class="row">
                        <div class="col-lg-12 mb-30">
                            <div class="input-effect">

                                <input class="primary-input form-control{{ $errors->has('pay_u_money_key') ? ' is-invalid' : '' }}"
                                type="text" id="pay_u_money_key" name="pay_u_money_key" autocomplete="off" value="{{isset($payment_gateways)? $payment_gateways[2]->pay_u_money_key : ''}}">
                                <label> @lang('lang.pay_u_money_key')<span>*</span> </label>
                                <span class="focus-border"></span>
                                @if ($errors->has('pay_u_money_key'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pay_u_money_key') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-30">
                            <div class="input-effect">

                                <input class="primary-input form-control{{ $errors->has('pay_u_money_salt') ? ' is-invalid' : '' }}"
                                type="text" name="pay_u_money_salt" autocomplete="off" value="{{isset($payment_gateways)? $payment_gateways[2]-> pay_u_money_salt : ''}}" id="pay_u_money_salt">
                                <label> @lang('lang.pay_u_money_salt')<span>*</span> </label>
                                <span class="focus-border"></span>
                                @if ($errors->has('pay_u_money_salt'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('pay_u_money_salt') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row justify-content-center">
                        <img class="logo" width="250" height="90" src="{{ URL::asset('public/backEnd/img/payumoney-logo.png') }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-40">
            <div class="col-lg-12 text-center">
                <button class="primary-btn fix-gr-bg">
                    <span class="ti-check"></span>
                    @lang('lang.update')
                </button>
            </div>
        </div>
    </div>
    {{ Form::close() }}
</div>
</div>
</div>
</div>
</div>
</section>
@endsection
