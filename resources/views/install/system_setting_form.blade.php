<!DOCTYPE html>
<html lang="">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="icon" href="{{asset('public/backEnd/')}}/img/favicon.png" type="image/png"/>
    <title>School Management System</title>
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/jquery-ui.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/jquery.data-tables.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/themify-icons.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/flaticon.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/nice-select.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/magnific-popup.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/fastselect.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/software.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/fullcalendar.min.css">
    <link rel="stylesheet" media="print"
          href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/js/select2/select2.css"/>
    <!-- main css -->
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/style.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/infix.css"/>
    <style>
        h2, h5 {
            color: whitesmoke
        }

        .card-body {
            padding: 5.25rem;
        }

        .single-report-admit .card-header {
            background-position: right;
            margin-top: -5px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 20px;
        }

    </style>
</head>

<body class="admin">
<div class="container">
    <div class="col-md-6 offset-3 mt-40" >

            <ul id="progressbar">
                <li class="active">welcome</li>
                <li class="active">verification</li>
                <li class="active">Environment</li>
                <li class="active">System Setup</li>
            </ul>


        <div class="card">
            <div class="single-report-admit">
                <div class="card-header">
                    <h2 style="text-align: center">System Setup</h2>
                </div>
            </div>
            <div class="card-body">
                @if($errors)
                    @foreach($errors->all() as $error)
                    <div class="alert alert-danger"><ul><li>{{ $error }}</li></ul></div>
                    @endforeach
                @endif
                <form method="post" action="{{route('system_setting_install')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="institution_name">Institution Name:</label>
                        <input type="text" class="form-control" name="institution_name" required>
                    </div>
                    <div class="form-group">
                        <label for="institution_code">Institution Code:</label>
                        <input type="text" class="form-control" name="institution_code" required>
                    </div>
                    <div class="form-group">
                        <label for="institution_address">Institution Address:</label>
                        <textarea class="form-control" name="institution_address" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="session_year">Session Year:</label>
                        <select class="form-control" name="session_year" required>
                            <option value="2019">2019</option>
                            <option value="2019">2018</option>
                            <option value="2019">2017</option>
                            <option value="2019">2016</option>
                            <option value="2019">2015</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="system_admin_email">System Admin Email:</label>
                        <input type="text" class="form-control" name="system_admin_email" required>
                    </div>
                    <div class="form-group">
                        <label for="system_admin_password">System Admin Password:</label>
                        <input type="password" class="form-control" name="system_admin_password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password:</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>
                    <div class="form-group">
                        <label for="session_year">Demo Data:</label>
                        <select class="form-control" name="demo_data" required>
                            <option value="1">Without Sample Data</option>
                            <option value="2">With Sample Data</option>
                        </select>
                    </div>
                    <input type="submit" value="Let's Go" class="offset-3 col-sm-6  primary-btn fix-gr-bg"
                           style="background-color: rebeccapurple;color: whitesmoke">
                </form>
            </div>
        </div>
    </div>

</div>
</body>
</html>

