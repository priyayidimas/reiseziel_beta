@php
    $cuser = DB::table('users')->count();
    $ctrain = DB::table('transportation')->where('type_id','=',1)->count();
    $cplane = DB::table('transportation')->where('type_id','=',2)->count();
    $creserve = DB::table('reservation')->count();
    $cmessage = DB::table('message')->count();
    $ccustomer = DB::table('customer')->count();
@endphp
@extends('t_index')
@section('title')
Admin Dashboard
@endsection
@section('head')
<link rel="stylesheet" href="{{URL::asset('/assets/css/datatables.css')}}">

<script type="text/javascript">


// $( function(){
//   $('#datetime').flatpickr({
//     enableTime: true,
//     altInput: true,
//     altFormat: "d/m/Y H:i:S",
//     dateFormat: "Y-m-d H:i:S",
//     minDate: "today",
//     time_24hr: true
//   });
//   $('#time').flatpickr({
//     enableTime: true,
//     noCalendar: true,
//     dateFormat: "H:i",
//     time_24hr: true
//   });
// });

</script>
@endsection

@section('content')
@include('admin.nav')
      <div class="row en-container"><br>
        <div class="col s12">
          <nav>
              <div class="nav-wrapper light-blue">
                <div class="col s12">
                  <a href="#!" class="breadcrumb">Dashboard</a>
                </div>
              </div>
            </nav>
          </div>
        </div>

        <div class="row en-container">
          <div class="col s12">
              @if (Session::has('msg'))
              <div id="card-alert" class="card {{Session::get('color')}}">
                <div class="card-content white-text">
                    <p>{{Session::get('msg')}}</p>
                </div>
                <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
              </div>
            @endif
          </div>
        </div>

        <div class="row en-container">
            <div class="col s12 m3">
                <div class="card horizontal">
                  <div class="card-icon blue white-text valign-wrapper">
                   <i class="material-icons extra">people</i>
                  </div>
                  <div class="card-stacked">
                    <div class="card-info card-content right-align">
                      <h3>{{$cuser}}</h3>
                      <h5>Users</h5>
                    </div>
                    <a class="card-action left-align" href="{{URL::to('/dashboard/viewUsers')}}">
                     Details <i class="material-icons right hide-on-med-and-down">arrow_forward</i>
                    </a>
                  </div>
                </div>
              </div>

              <div class="col s12 m3">
                  <div class="card horizontal">
                    <div class="card-icon green white-text valign-wrapper">
                     <i class="material-icons extra">flight</i>
                    </div>
                    <div class="card-stacked">
                      <div class="card-info card-content right-align">
                        <h3>{{$cplane}}</h3>
                        <h5>Planes</h5>
                      </div>
                      <a class="card-action left-align" href="{{URL::to('/dashboard/viewPlanes')}}">
                        Details <i class="material-icons right hide-on-med-and-down">arrow_forward</i>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="col s12 m3">
                    <div class="card horizontal">
                      <div class="card-icon cyan white-text valign-wrapper">
                       <i class="material-icons extra">train</i>
                      </div>
                      <div class="card-stacked">
                        <div class="card-info card-content right-align">
                          <h3>{{$ctrain}}</h3>
                          <h5>Trains</h5>
                        </div>
                        <a class="card-action left-align" href="{{URL::to('/dashboard/viewTrains')}}">
                          Details <i class="material-icons right hide-on-med-and-down">arrow_forward</i>
                        </a>
                      </div>
                    </div>
                  </div>

                  <div class="col s12 m3">
                      <div class="card horizontal">
                        <div class="card-icon amber white-text valign-wrapper">
                         <i class="material-icons extra">book</i>
                        </div>
                        <div class="card-stacked">
                          <div class="card-info card-content right-align">
                            <h3>{{$creserve}}</h3>
                            <h5>Bookings</h5>
                          </div>
                          <a class="card-action left-align" href="{{URL::to('/dashboard/viewReservations')}}">
                            Details <i class="material-icons right hide-on-med-and-down">arrow_forward</i>
                          </a>
                        </div>
                      </div>
                    </div>

                    <div class="col s12 m3">
                      <div class="card horizontal">
                        <div class="card-icon orange white-text valign-wrapper">
                         <i class="material-icons extra">message</i>
                        </div>
                        <div class="card-stacked">
                          <div class="card-info card-content right-align">
                            <h3>{{$cmessage}}</h3>
                            <h5>Messages</h5>
                          </div>
                          <a class="card-action left-align" href="{{URL::to('/dashboard/viewMessages')}}">
                            Details <i class="material-icons right hide-on-med-and-down">arrow_forward</i>
                          </a>
                        </div>
                      </div>
                    </div>
                    <div class="col s12 m3">
                      <div class="card horizontal">
                        <div class="card-icon lime white-text valign-wrapper">
                         <i class="material-icons extra">people</i>
                        </div>
                        <div class="card-stacked">
                          <div class="card-info card-content right-align">
                            <h3>{{$ccustomer}}</h3>
                            <h5>Customers</h5>
                          </div>
                          <a class="card-action left-align" href="{{URL::to('/dashboard/viewCustomers')}}">
                            Details <i class="material-icons right hide-on-med-and-down">arrow_forward</i>
                          </a>
                        </div>
                      </div>
                    </div>
        </div>
        {{--  <div class="row en-container">
          <form action="/test" method="post">
            {{csrf_field()}}
            <input type="text" name="a" id="datetime">
            <input type="text" name="b" id="time">
            <button type="submit">A</button>
          </form>
        </div>  --}}




@endsection
@section('script')
<script src="{{URL::asset('/assets/js/datatables.js')}}" charset="utf-8"></script>
@endsection 
