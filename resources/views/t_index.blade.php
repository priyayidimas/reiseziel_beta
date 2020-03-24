
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reiseziel &middot; @yield('title')</title>
    <link rel="icon" type="image/gif" href="{{url('/assets/images/logo.gif')}}">
    <link rel="stylesheet" href="{{url('/assets/css/materialize.css')}}">
    <link rel="stylesheet" href="{{url('/assets/css/gooicon.css')}}">
    <link rel="stylesheet" href="{{url('/assets/css/bootstrap-modal.css')}}">
    <link rel="stylesheet" href="{{url('/assets/flatpickr/material_blue.css')}}">
    <link rel="stylesheet" href="{{url('/assets/css/ui/ui-timepicker.css')}}">
    <link rel="stylesheet" href="{{url('/assets/css/style.css')}}">
    <script src="{{url('/assets/js/jquery.min.js')}}"></script>
    <script src="{{url('/assets/js/jquery-ui.min.js')}}" charset="utf-8"></script>
    <script src="{{url('/assets/flatpickr/flatpickr.js')}}"></script>
    @yield('head')
</head>
<body class="grey lighten-3">
    @yield('content')
</body>
    <script src="{{url('/assets/js/materialize.min.js')}}"></script>
    @yield('script')
    <script src="{{url('/assets/js/bootstrap-modal.js')}}"></script>
    <script src="{{url('/assets/js/script.js')}}"></script>
</html>