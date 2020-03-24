@php
    if (Auth::check()) {
      $user = Auth::user();
      $det = DB::table('customer')->where('users_id','=',$user->id)->first();
      $cpas = DB::table('customer')->where('users_id','=',$user->id)->count();
      $cpes = DB::table('reservation')->where('contact_id','=',$det->id)->count();
    }
@endphp
@extends('t_index')
@section('title')
User Dashboard
@endsection
@section('head')
<link rel="stylesheet" href="{{URL::asset('/assets/css/ui/jquery-ui.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('/assets/css/ui/jquery-ui.theme.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('/assets/css/datatables.css')}}">

<script type="text/javascript">
    var gender = '{{$det->gender}}';
    $(document).ready(function () {
        $('select').material_select();
        $('#gender').val(gender);
    });
</script>
<style>
  input:disabled, select:disabled {
    color:black !important;
  }
</style>
@endsection

@section('content')
@include('user.nav')

  
<div class="row en-container"><br>
  <div class="col s12">
    <nav>
        <div class="nav-wrapper light-blue">
          <div class="col s12">
            <a href="{{URL::to('/dashboard')}}" class="breadcrumb">My Account</a>
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
                      <h3>{{$cpas}}</h3>
                      <h5>Passengers</h5>
                    </div>
                    <a class="card-action left-align" href="{{URL::to('/dashboard/viewCustomers')}}">
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
                        <h3>{{ $cpes }}</h3>
                        <h5>My Bookings</h5>
                      </div>
                      <a class="card-action left-align" href="{{URL::to('/dashboard/viewReservations')}}">
                        Details <i class="material-icons right hide-on-med-and-down">arrow_forward</i>
                      </a>
                    </div>
                  </div>
                </div>

                <div class="col s12 m6">
                  <div class="card-panel light-blue lighten-5">
                    <h4 class="blue-text text-darken-3" style="margin-top: 0.14rem;">Congratulations !</h4>
                    <h6 class="blue-text">As A User, You May Have 15% Discount For Booking Our Planes And Trains</h6><br>
                    <a href="{{url('/')}}" class="btn light-blue waves-effect">Book Now !</a>
                  </div>    
                </div>

              <div class="col s12 m12">
                <form class="" action="{{URL::to('/updateUserCus/'.$user->id)}}" method="post">
                  {!! csrf_field() !!}
                  <ul class="collapsible" data-collapsible="accordion">
                      <li>
                        <div class="collapsible-header"><h5><i class="material-icons left">person</i>{{$user->fullname}} <i class="material-icons right">arrow_drop_down</i></h5></div>
                        <div class="collapsible-body">
                          
                            
                              <div class="row">
                                  <div class="col s12 m3">
                                      <label>Title</label>
                                      <select disabled class="browser-default validate" id="gender" name="gender">
                                              <option value="Mr." selected>Mr.</option>
                                              <option value="Mrs.">Mrs.</option>
                                              <option value="Ms.">Ms.</option>
                                      </select>     
                                  </div>
                                  <div class="input-field col s12 m9">
                                      <input id="fullname" name="fullname" type="text" class="validate" value="{{$user->fullname}}" disabled required>
                                      <label for="fullname">Full Name</label>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="input-field col s12">
                                      <input id="email" name="email" type="text" class="validate" value="{{$user->email}}" disabled required>
                                      <label for="email">Email</label>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="input-field col s12">
                                      <input id="address" name="address" type="text" class="validate" value="{{$det->address}}" disabled required>
                                      <label for="address">Address</label>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="input-field col s12">
                                      <input id="phone" name="phone" type="text" class="validate" value="{{$det->phone}}" disabled required>
                                      <label for="phone">Phone</label>
                                  </div>
                              </div>
                              
                              <button type="button" class="btn waves-effect amber white-text" id="check">Edit <i class="material-icons left">edit</i></button>
                              <button type="submit" class="btn green waves-effect waves-light validate" disabled>Submit<i class="material-icons right">send</i></button>
                              
                            </div>

                          </li>
                        </ul>
                      </form>

                    </div>

              </div>

        </div>


        

        

@endsection
@section('script')
<script>
      $("#check").click(function () {
        $(".validate").hasAttr("disabled") ? $(".validate").removeAttr("disabled") : $(".validate").prop("disabled",true);
      });

</script>
<script src="{{URL::asset('/assets/js/datatables.js')}}" charset="utf-8"></script>
@endsection 
