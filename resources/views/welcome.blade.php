@extends('t_index')
@section('title')
    Welcome
@endsection
@section('head')
<script>
    
  $(document).ready(function(){
        $('.scrollspy').scrollSpy();
        // Slider
        $('.slider').slider({
            height: 720,
            full_width: true
        });
        $('.carousel').carousel({
            dist: 0
        });
        // Material Box
        $('.materialboxed').materialbox();
        
        $(window).scroll(function() {
            if ($(".nav").offset().top > 650) {
                $(".nav").removeClass("transparent");
                $(".nav").addClass("blue");
            } else {
                $(".nav").removeClass("blue");
                $(".nav").addClass("transparent");
            }   
         });

           $('.date').flatpickr({
                altInput: true,
                altFormat: "d/m/Y",
                dateFormat: "Y-m-d",
                minDate: "today",
            });
        
        
         $("#check,#check2").click(function () {
          $(".return").hasAttr("disabled") ? $(".return").removeAttr("disabled") : $(".return").prop("disabled",true);
        });
  });


        
</script>
@endsection
@section('content')

    @include('home.navbar')
    @include('home.slider')
    @include('home.booking')
    @include('home.about')
    @include('home.toplace')
    @include('home.order')
    @include('home.benefit')
    @include('home.sponsor')
    @include('home.feedback')
    @include('footer')
@endsection
@section('script')
<script src="{{url('/assets/js/autocomplete.js')}}"></script>
@endsection