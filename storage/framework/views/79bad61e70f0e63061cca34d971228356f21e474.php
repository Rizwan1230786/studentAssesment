<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?php echo e(asset('public/backEnd/')); ?>/img/favicon.png" type="image/png" />
    <title>Login</title>
    <meta name="_token" content="<?php echo csrf_token(); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/vendors/css/themify-icons.css" />
    <link rel="stylesheet" href="<?php echo e(asset('public/backEnd/')); ?>/css/style.css" />
</head>

<body class="login admin hight_100">

    <!--================ Start Login Area =================-->
    <section class="login-area">
        <div class="container">
            <!-- 			<div class="row justify-content-center align-items-center">
    <div class="col-lg-6 col-md-8 text-center mt-30 btn-group" id="btn-group">
     <table align="center" width="100%">
      <tr align="center">
       <td><p class="white get-login-access">Super Admin</p></td>
       <td><p class="white get-login-access">Admin</p></td>
       <td><p class="white get-login-access">Teacher</p></td>
       <td><p class="white get-login-access">Accountant</p></td>
      </tr>
      <tr align="center">
       <td><p class="white get-login-access">Receptionist</p></td>
       <td><p class="white get-login-access">Librarian</p></td>
       <td><p class="white get-login-access">Student</p></td>
       <td><p class="white get-login-access">Parents</p></td>
      </tr>
     </table>
       
    </div>
   </div> -->
            <input type="hidden" id="url" value="<?php echo e(url('/')); ?>">
            <div class="row login-height justify-content-center align-items-center">
                <div class="col-lg-5 col-md-8">
                    <div class="form-wrap text-center  mt-40">
                        <div class="logo-container">
                            <a href="#">
                                <h5 class="text-uppercase">Login Details</h5>

                            </a>
                        </div>

                        <?php if(session()->has('message-success') != ""): ?>
                        <?php if(session()->has('message-success')): ?>
                        <p class="text-success"><?php echo e(session()->get('message-success')); ?></p>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if(session()->has('message-danger') != ""): ?>
                        <?php if(session()->has('message-danger')): ?>
                        <p class="text-danger"><?php echo e(session()->get('message-danger')); ?></p>
                        <?php endif; ?>
                        <?php endif; ?>
                        <form method="POST" class="" action="<?php echo e(route('login')); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="form-group input-group mb-4 mx-3">
                                <span class="input-group-addon">
                                    <i class="ti-email"></i>
                                </span>
                                <input class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"
                                    type="email" name='email' id="email" placeholder="Enter Email address" />
                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback text-left pl-3" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="form-group input-group mb-4 mx-3">
                                <span class="input-group-addon">
                                    <i class="ti-key"></i>
                                </span>
                                <input class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>"
                                    type="password" name='password' id="password" placeholder="Enter Password" />
                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback text-left pl-3" role="alert">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="d-flex justify-content-between pl-30">
                                <div class="checkbox">
                                    <input class="form-check-input" type="checkbox" name="remember" id="rememberMe"
                                        <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                    <label for="rememberMe">Remember Me</label>
                                </div>
                                <div>
                                    <a href="<?php echo e(url('recovery/passord')); ?>">Forget Password?</a>
                                </div>
                            </div>

                            <div class="form-group mt-30 mb-30">
                                <button type="submit" class="primary-btn fix-gr-bg">
                                    <span class="ti-lock mr-2"></span>
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--================ Start End Login Area =================-->

    <!--================ Footer Area =================-->
    
    <!--================ End Footer Area =================-->


    <script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/popper.js"></script>
    <script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/bootstrap.min.js"></script>
    <script src="<?php echo e(asset('public/backEnd/')); ?>/js/login.js"></script>
    <script>
        $('.primary-btn').on('click', function(e) {
            // Remove any old one
            $('.ripple').remove();

            // Setup
            var primaryBtnPosX = $(this).offset().left,
                primaryBtnPosY = $(this).offset().top,
                primaryBtnWidth = $(this).width(),
                primaryBtnHeight = $(this).height();

            // Add the element
            $(this).prepend("<span class='ripple'></span>");

            // Make it round!
            if (primaryBtnWidth >= primaryBtnHeight) {
                primaryBtnHeight = primaryBtnWidth;
            } else {
                primaryBtnWidth = primaryBtnHeight;
            }

            // Get the center of the element
            var x = e.pageX - primaryBtnPosX - primaryBtnWidth / 2;
            var y = e.pageY - primaryBtnPosY - primaryBtnHeight / 2;

            // Add the ripples CSS and start the animation
            $('.ripple')
                .css({
                    width: primaryBtnWidth,
                    height: primaryBtnHeight,
                    top: y + 'px',
                    left: x + 'px'
                })
                .addClass('rippleEffect');
        });
    </script>

</body>

</html>
