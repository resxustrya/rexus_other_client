
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="author" content="Lourence Rex B. Traya">
    <meta name="author" content="Rusel Tayong">
    <meta name="author" content="Department of Health Region 7">
    <link rel="icon" href="{{ asset('public/img/favicon.png') }}">
    <meta http-equiv="cache-control" content="max-age=0" />
    <title>HRIS</title>


<!-- Bootstrap core CSS -->
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <!--CHOSEN SELECT -->
    <link href="{{ asset('public/plugin/chosen/chosen.css') }}" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{ asset('public/assets/css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/plugin/Lobibox old/lobibox.css') }}" />

    <link href="{{ asset('public/plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet">
    <!-- bootstrap datepicker -->
    <!--DATE RANGE-->
    <link href="{{ asset('public/plugin/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet">
    <script>var loadingState = '<center><img src="{{ asset('public/img/spin.gif') }}" width="150" style="padding:20px;"></center>'; </script>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/plugin/clockpicker/dist/jquery-clockpicker.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/plugin/clockpicker/dist/bootstrap-clockpicker.min.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/datepicer/css/bootstrap-datepicker3.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/datepicer/css/bootstrap-datepicker3.standalone.css') }}" />
    <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
    @if(Request::segments()[0] == "work-schedule")
        <link rel="stylesheet" type="text/css" href="{{ asset('public/plugin/datatables/datatables.min.css') }}" />
        <script src="{{ asset('public/plugin/datatables/datatables.min.js') }}"></script>
    @endif
<!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('public/plugin/iCheck/square/blue.css') }}">
    <!-- SELECT 2 -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/plugin/select2/select2.min.css') }}" />



    <style>
        body {
            background-color: #eee;
        }
    </style>

    @section('css')

    @show
    @section('head-js')
    <!--DATE RANGE-->
    @show
</head>

<body  class="ng-cloak ">
<div class="loading"></div>

<!-- Fixed navbar -->

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="header" style="background-color:#6f5499;padding:20px;">
        <div class="col-md-6">
            <span class="title-info">Welcome,</span> <span class="title-desc">{{ Auth::user()->fname }} {{ Auth::user()->lname }}</span>
        </div>
        <div class="col-md-6">
            <span class="title-info">Date:</span> <span class="title-desc">{{ date('M d, Y') }}</span>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">DTR</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            @if(Auth::user()->usertype == "1")
                @include('layouts.admin-menu')
            @elseif(Auth::user()->usertype == "0")
                @include('layouts.personal')
            @endif
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div class="container">
    <div class="loading"></div>
        <div class="wrapper" style="margin-top: 15%;">
            @yield('content')
        </div>
    <div class="clearfix"></div>
    @include('modal')
</div> <!-- /container -->
<footer class="footer">
    <div class="container">
        <p class="text-muted">Company Name</p>
    </div>
</footer>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- DATE RANGE SELECT -->
<script src="{{ asset('public/plugin/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('public/plugin/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('public/plugin/Lobibox old/Lobibox.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery-validate.js') }}"></script>
<script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/assets/datepicer/js/bootstrap-datepicker.js') }}"></script>
<!-- CLOCK PICKER -->
<script src="{{ asset('public/plugin/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>
<script src="{{ asset('public/plugin/clockpicker/dist/bootstrap-clockpicker.min.js') }}"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{ asset('public/assets/js/ie10-viewport-bug-workaround.js') }}"></script>

<!-- bootstrap datepicker -->
<script src="{{ asset('public/assets/js/script.js') }}?v=2"></script>
<script src="{{ asset('public/assets/js/form-justification.js') }}"></script>
<script src="{{ asset('public/plugin/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>

<!-- SELECT 2 -->
<script src="{{ asset('public/plugin/select2/select2.full.min.js') }}"></script>
<!-- CHOSEN SELECT -->
<script src="{{ asset('public/plugin/chosen/chosen.jquery.js') }}"></script>

<script src="{{ asset('public/plugin/fullcalendar/moment.js') }}"></script>
<script src="{{ asset('public/plugin/fullcalendar/fullcalendar.min.js') }}"></script>

<!-- iCheck -->
<script src="{{ asset('public/plugin/iCheck/icheck.min.js') }}"></script>

<script>
    $('.create-absent').click(function(){
        var url = $(this).data('link');
        $('.modal_content').html('');
        $('.loading').show();
        setTimeout(function (){
            $.get(url, function(data){
                $('.loading').hide();
                $('.modal_content').html(data);

            });
        },1000);
    });

    function select_absent(element)
    {

        var val = $(element).val();
        if(val == "SO")
        {

            $('#desc').removeAttr('disabled');
        } else if(val == "LEAVE") {
            $('#desc').prop('disabled',true);
        } else if(val == "CTO") {

        }
    }
</script>
@section('js')

@show



@if(Session::get('added'))
    <script>
        Lobibox.notify('success',{
            msg:'Successfully Added!'
        });
    </script>
    <?php Session::forget('added'); ?>
@endif
@if(Session::get('deleted'))
    <script>
        Lobibox.notify('error',{
            msg:'Successfully Deleted!'
        });
    </script>
    <?php Session::forget('deleted'); ?>
@endif
@if(Session::get('updated'))
    <script>
        Lobibox.notify('info',{
            msg:'Successfully Updated!'
        });
    </script>
    <?php Session::forget('updated'); ?>
@endif
@if(Session::get('absent'))
    <script>
        Lobibox.notify('error',{
            msg:'Successfully Absent!'
        });
    </script>
    <?php Session::forget('absent'); ?>
@endif
@if(Session::get('msg'))
    <script>
        var msg = <?php echo "'". Session::get('msg') ."';"; ?>
        Lobibox.notify('info',{
            msg:msg
        });
    </script>
    <?php Session::forget('msg'); ?>
@endif
</body>
</html>
