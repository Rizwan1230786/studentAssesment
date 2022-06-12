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
    <style type="text/css">
      body{
        font-size: 8px;
      }
      p{
        padding: 0;
        margin: 0;
      }
      h2{
        color: whitesmoke;
      }
    </style>
  

</head>


<body class="admin">
<div class="container">
    <div class="col-md-6 offset-3 mb-20  mt-40">

            <ul id="progressbar">
                <li class="active">welcome</li>
                <li class="active">verification</li>
                <li class="active">Environment</li>
                <li>System Setup</li>
            </ul>


        <div class="card">
            <div class="single-report-admit">
            <div class="card-header">
                <h2 class="text-center text-uppercase" style="color: whitesmoke">ENVIRONMENT SETUP</h2>
            </div>
            </div>
            <div class="card-body environment-setup"> 

                @if(Session::has('message-success'))
                    <p class="alert alert-success">{{ Session::get('message-success') }}</p>
                @endif
                @if(Session::has('message-danger'))
                    <p class="alert alert-danger">{{ Session::get('message-danger') }}</p>
                @endif
 
                <h4 class="text-center">Database Connection </h4>
                <p class="mb-20" style="text-align: center;color: green">Database Connection Success</p>

                <h4 style="text-align: center">Basic Requirements </h4>
                <p class="mb-20" style="text-align: center;color: green"> You will need to make sure your server meets the following requirements:</p>
                <div class="requirements">
                   <table class="table">
                       <thead>
                       <th>Status</th>
                       <th>Current Available</th>
                       <th>Our Required</th>
                       </thead>
                       <tbody>
                       <tr>
                           <td> <span class='ti-check-box' style='color: green'></span></td>
                           <td style='color: green'>{{ phpversion()}}</td>
                           <td>PHP >= 7.1.3</td>
                       </tr>
                       <tr>
                           <td>
                               @php
                                   if( OPENSSL_VERSION_NUMBER < 0x009080bf) {
                                   echo "<span class='ti-na' style='color: red'></span>";
                                   } else {
                                    echo "<span class='ti-check-box' style='color: green'></span>";
                                   }
                               @endphp
                           </td>
                           <td>
                               @php
                                   if( OPENSSL_VERSION_NUMBER < 0x009080bf) {
                                       echo "<p style='color:Red'>"."OpenSSL Version Out-of-Date"."<p>";
                                   } else {
                                        echo "<p style='color:green'>"."OpenSSL Version Up-to-Date"."<p>";
                                   }
                               @endphp
                           </td>
                           <td>OpenSSL PHP Extension</td>
                       </tr>
                       <tr>

                           <td>
                               @php
                                   if(PDO::getAvailableDrivers()) {
                                       echo "<span class='ti-check-box' style='color: green'></span>";
                                   } else {
                                    echo "<span class='ti-na' style='color: red'></span>";
                                   }
                               @endphp
                           </td>
                           <td>
                               @php
                                   if(PDO::getAvailableDrivers()) {
                                       echo "<p style='color:green'>"."PDO PHP Extension Available"."<p>";
                                   } else {
                                        echo "<p style='color:red'>"."PDO PHP Extension Not Available"."<p>";
                                   }
                               @endphp
                           </td>
                           <td>PDO PHP Extension</td>
                       </tr>
                       <tr>
                           <td>
                               @php
                                   if(extension_loaded('mbstring')) {
                                       echo "<span class='ti-check-box' style='color: green'></span>";
                                   } else {
                                    echo "<span class='ti-na' style='color: red'></span>";
                                   }
                               @endphp
                           </td>
                           <td>
                               @php
                                   if(extension_loaded('mbstring')) {
                                       echo "<p style='color:green'>"."Mbstring PHP Extension Available"."<p>";
                                   } else {
                                        echo "<p style='color:red'>"."Mbstring PHP Extension Not Available"."<p>";
                                   }
                               @endphp
                           </td>
                           <td>Mbstring PHP Extension</td>
                       </tr>
                       <tr>
                           <td>
                               @php
                                   if(extension_loaded('tokenizer')) {
                                       echo "<span class='ti-check-box' style='color: green'></span>";
                                   } else {
                                    echo "<span class='ti-na' style='color: red'></span>";
                                   }
                               @endphp
                           </td>
                           <td>
                               @php
                                   if(extension_loaded('tokenizer')) {
                                       echo "<p style='color:green'>"."Tokenizer PHP Extension Available"."<p>";
                                   } else {
                                        echo "<p style='color:red'>"."Tokenizer PHP Extension Not Available"."<p>";
                                   }
                               @endphp
                           </td>
                           <td>Tokenizer PHP Extension</td>
                       </tr>
                       <tr>
                           <td>
                               @php
                                   if(extension_loaded('xml')) {
                                       echo "<span class='ti-check-box' style='color: green'></span>";
                                   } else {
                                    echo "<span class='ti-na' style='color: red'></span>";
                                   }
                               @endphp
                           </td>
                           <td>
                               @php
                                   if(extension_loaded('xml')) {
                                       echo "<p style='color:green'>"."XML PHP Extension Available"."<p>";
                                   } else {
                                        echo "<p style='color:red'>"."XML PHP Extension Not Available"."<p>";
                                   }
                               @endphp
                           </td>
                           <td>XML PHP Extension</td>
                       </tr>
                       <tr>
                           <td>
                               @php
                                   if(extension_loaded('ctype')) {
                                       echo "<span class='ti-check-box' style='color: green'></span>";
                                   } else {
                                    echo "<span class='ti-na' style='color: red'></span>";
                                   }
                               @endphp
                           </td>
                           <td>
                               @php
                                   if(extension_loaded('ctype')) {
                                       echo "<p style='color:green'>"."Ctype PHP Extension Available"."<p>";
                                   } else {
                                        echo "<p style='color:red'>"."Ctype PHP Extension Not Available"."<p>";
                                   }
                               @endphp
                           </td>
                           <td>Ctype PHP Extension</td>
                       </tr>
                       <tr>
                           <td>
                               @php
                                   if(extension_loaded('bcmath')) {
                                       echo "<span class='ti-check-box' style='color: green'></span>";
                                   } else {
                                    echo "<span class='ti-na' style='color: red'></span>";
                                   }
                               @endphp
                           </td>
                           <td>
                               @php
                                   if(extension_loaded('bcmath')) {
                                       echo "<p style='color:green'>"."BCMath PHP Extension Available"."<p>";
                                   } else {
                                        echo "<p style='color:red'>"."BCMath PHP Extension Not Available"."<p>";
                                   }
                               @endphp
                           </td>
                           <td>BCMath PHP Extension</td>
                       </tr>
                       <tr>
                           <td>
                               @php
                                   if(extension_loaded('json')) {
                                       echo "<span class='ti-check-box' style='color: green'></span>";
                                   } else {
                                    echo "<span class='ti-na' style='color: red'></span>";
                                   }
                               @endphp
                           </td>
                           <td>
                               @php
                                   if(extension_loaded('json')) {
                                       echo "<p style='color:green'>"."JSON PHP Extension Available"."<p>";
                                   } else {
                                        echo "<p style='color:red'>"."JSON PHP Extension Not Available"."<p>";
                                   }
                               @endphp
                           </td>
                           <td>JSON  PHP Extension</td>
                       </tr>

                       </tbody>
                   </table>
                </div>

                <h4 style="text-align: center">Permission Tests</h4>
                <p class="mb-20" style="text-align: center">The Following Folders needs write permissions</p>

                <form action="{{route('system_setting_form')}}" method="post">
                    {{csrf_field()}}
                    <input type="submit" class="offset-3 col-sm-6  primary-btn fix-gr-bg mt-20 mb-20" style="background-color: rebeccapurple;color: whitesmoke" value="Next Step" name="next">
                </form>
            </div>
        </div>
    </div>

</div>
</body>
</html>


