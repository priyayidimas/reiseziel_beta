
@extends('t_index')
@section('title')
Admin Dashboard
@endsection
@section('head')
<script>
$( function(){
  $('#datetime').flatpickr({
    enableTime: true,
    altInput: true,
    altFormat: "d/m/Y H:i:S",
    dateFormat: "Y-m-d H:i:S",
    // minDate: "today",
    time_24hr: true
  });
  $('#time').flatpickr({
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true
  });
});
</script>
@endsection

@section('content')
@include('admin.nav')
      <div class="row en-container"><br>
        <div class="col s12">
          <nav>
              <div class="nav-wrapper light-blue">
                <div class="col s12">
                  <a href="{{URL::to('/dashboard')}}" class="breadcrumb">Dashboard</a>
                  <a href="{{URL::to('/dashboard/viewPlanes')}}" class="breadcrumb">Planes</a>
                  <a href="#!" class="breadcrumb">Add Plane</a>
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

        <div class="row container">
            <div class="col s12">
                <div class="card white">
                    <div class="card-content">
                        <span class="card-title"></span>
                        <h5 class="center">Add A Plane</h5>
                        <div class="divider"></div><br>
                            <div class="en-container">
                                    <form class="" action="{{URL::to('/insertPlane')}}" method="post" autocomplete="off">
                                        {!! csrf_field() !!}
                                        
                                        <ul class="collapsible" data-collapsible="accordion">
                                                <li>
                                                <div class="collapsible-header active"><h6>General Information</h6></div>
                                                <div class="collapsible-body">
                                                    
                                                        <div class="row">
                                                                <div class="input-field col s12">
                                                                    <input id="code" name="code" type="text" class="validate" required>
                                                                    <label for="code">Plane Code</label>
                                                                </div>
                                                                <div class="input-field col s12">
                                                                    <input id="description" name="description" type="text" class="validate" required>
                                                                    <label for="description">Description</label>
                                                                </div>
                                                                <div class="input-field col s12">
                                                                        <input id="seat_qty" name="seat_qty" type="number" class="validate" required>
                                                                        <label for="seat_qty">Seat Quantity</label>
                                                                </div>
                                                            </div>

                                                </div>
                                                </li>

                                                <li>
                                                <div class="collapsible-header"><h6>Flight Information</h6></div>
                                                <div class="collapsible-body">
                                                    
                                                            <div class="row">
                                                                    <div class="input-field col s12">
                                                                        <input id="rute_from" name="rute_from" type="text" class="validate bandara" required>
                                                                        <label for="rute_from">Depart From</label>
                                                                    </div>
                                                                    <div class="input-field col s12">
                                                                        <input id="rute_to" name="rute_to" type="text" class="validate bandara" required>
                                                                        <label for="rute_to">Destination</label>
                                                                    </div>
                                                                    <div class="input-field col s12">
                                                                        <input id="datetime" name="depart_at" type="text" class="validate" required>
                                                                        <label for="depart_at">Depart At</label>
                                                                    </div>
                                                                    <div class="input-field col s12">
                                                                        <input id="time" name="duration" type="text" class="validate" required>
                                                                        <label for="duration">Flight Duration</label>
                                                                    </div>
                                                                    <div class="input-field col s12">
                                                                        <input id="price" name="price" type="number" class="validate" required>
                                                                        <label for="price">Price (Rp.)</label>
                                                                    </div>
                                                                </div>

                                                </div>
                                                </li>

                                            </ul>
                                  </div>
                                  
                    </div>
                    <div class="card-action">
                            {{--  <div class="divider"></div>  --}}
                            <button type="reset" class="btn btn-flat">Reset</button>
                            <button type="submit" class="btn green waves-effect waves-light">Submit<i class="material-icons right">send</i></button>
                         </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
<script src="{{url('/assets/js/autocomplete.js')}}"></script>
@endsection