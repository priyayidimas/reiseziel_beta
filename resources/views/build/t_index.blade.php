<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/gif" href="{{URL::asset('assets/images/logo.gif')}}">
    {!! Html::style('assets/css/bootstrap.min.css') !!}
    {!! Html::style('assets/css/font-awesome.css') !!}
    {!! Html::style('assets/css/font-awesome.min.css') !!}
    {!! Html::style('assets/css/animate.css') !!}
    {!! Html::script('assets/js/jquery.min.js') !!}
    {!! Html::script('assets/js/bootstrap.min.js') !!}
    {{--}}
    {!! Html::script('assets/ui/jquery-ui.js') !!}
    {!! Html::style('assets/ui/jquery-ui.css') !!}
    {!! Html::style('assets/ui/jquery-ui.theme.css') !!}
    {!! Html::script('assets/js/jquery.dataTables.min.js') !!}
    {!! Html::style('assets/css/jquery.dataTables.min.css') !!}{{--}}
    <title>@yield('title')</title>
    @yield('head')
  </head>
  <body>
      @yield('content')
  </body>
  </html>
