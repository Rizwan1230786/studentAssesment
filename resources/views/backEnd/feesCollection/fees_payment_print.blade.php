<!DOCTYPE html>
<html>
<head>
    <title>Fees Payment</title>
    <style>
        tr td:first-child {
            display: none;
        }
        tr th:first-child {
            display: none;
        }
        .school-table-style {
            padding: 10px 0px!important;
        }
        .school-table-style tr th {
            font-size: 8px!important;
            text-align: left!important;
        }
        .school-table-style tr td {
            font-size: 9px!important;
            text-align: left!important;
            padding: 10px 0px!important;
        }
        .logo-image {
            width: 10%;
        }
    </style>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap.css" />
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/style.css" />
</head>
<body>
    <div class="text-center">
        <img class="logo-image" src="{{asset('public/backEnd/img/logo.png')}}">
        <h4 class="text-center mt-1"><span>Fees Payment</span></h4>
    </div>
	<table class="school-table school-table-style" cellspacing="0" width="100%">
        <thead>
            <tr align="center">
                <th>Date</th>
                <th>Fees Group</th>
                <th>Fees Code</th>
                <th>Mode</th>
                <th>Amount ($)</th>
                <th>Discount ($)</th>
                <th>Fine ($)</th>
            </tr>
        </thead>

        <tbody>
            
            <tr align="center">
                <td>{{date('jS M, Y', strtotime($payment->payment_date))}}</td>
                <td>{{$group}}</td>
                <td>{{$payment->feesType->code}}</td>
                <td>
                @if($payment->payment_mode == "C")
                        {{'Cash'}}
                @elseif($payment->payment_mode == "Cq")
                    {{'Cheque'}}
                @else
                    {{'DD'}}
                @endif 
                </td>
                <td>{{$payment->amount}}</td>
                <td>{{$payment->discount_amount}}</td>
                <td>{{$payment->fine}}</td>
                <td></td>
            </tr>
            
        </tbody>
    </table>
</body>
</html>