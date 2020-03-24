@if (Session::has('passenger'))

@php
if (Auth::check()) {
    $contact = DB::table('customer')->where('users_id','=',Auth::user()->id)->first();
}else {
    $contact = new stdClass();
    $contact->name = "";
    $contact->email = "";
    $contact->phone = "";
    $contact->gender = "";
}
@endphp
@extends('t_index')
@section('title')
Book Process
@endsection
@section('head')

<script>
    $(document).ready(function () {
        @if (Auth::check()) 
            $('.con').prop('readonly',true); 
        @endif
        @if (isset($contact))
            var gender = '{{$contact->gender}}';
            $('#gender').val(gender);
        @endif
    });
</script>

@endsection

@section('content')
@include('book.navbar')
      <div class="row en-container"><br>
        <div class="col s12">
          <nav>
              <div class="nav-wrapper light-blue">
                <div class="col s12">
                    <a class="breadcrumb">Search {{$type}} </a>
                    <a class="breadcrumb">Confirm Book</a>
                    <a class="breadcrumb">Fill Information</a>
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
                <div class="col l1"></div>
                <div class="col s12 m12 l5">
                    <div class="card darken-1">
                        <div class="card-content">
                            <span class="card-title">Contact Info</span><br>
                            <form class="" action="{{URL::to('/booking/payment')}}" method="post" autocomplete="off">
                                {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col s12 m4">
                                            <label>Title</label>
                                            <select class="browser-default con" id="gender" name="gender">
                                                    <option value="Mr." selected>Mr.</option>
                                                    <option value="Mrs.">Mrs.</option>
                                                    <option value="Ms.">Ms.</option>
                                            </select>     
                                    </div>
                                    <div class="input-field col s12 m12">
                                        <input id="fullname" name="fullname" type="text" class="validate con" value="{{$contact->name}}"  required>
                                        <label for="fullname">Full Name</label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                      <input id="email" name="email" type="text" class="validate con" value="{{$contact->email}}" required>
                                      <label for="email">Email</label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <input id="phone" name="phone" type="number" class="validate con" value="{{$contact->phone}}" required>
                                        <label for="phone">Phone</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <textarea id="address" name="address" class="materialize-textarea"></textarea>
                                        <label for="address">Address</label>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 l5">
                @for ($i = 1; $i <= Session::get('passenger'); $i++)
                {{--  <div class="row container">  --}}
                    <div class="row">
                        <div class="col s12 m12">
                            <div class="card darken-1">
                                <div class="card-content">
                                    <span class="card-title">Passenger Info {{$i}}</span><br>
                                        <div class="row">
                                            <div class="col s12 m3">
                                                    <label>Title</label>
                                                    <select class="browser-default" id="gender{{$i}}" name="gender{{$i}}">
                                                            <option value="Mr." selected>Mr.</option>
                                                            <option value="Mrs.">Mrs.</option>
                                                            <option value="Ms.">Ms.</option>
                                                    </select>     
                                            </div>
                                     
                                
                                            <div class="input-field col s12 m12">
                                                <input id="fullname{{$i}}" name="fullname{{$i}}" type="text" class="validate" required>
                                                <label for="fullname{{$i}}">Full Name</label>
                                            </div>
                                            <div class="input-field col s12 m6">
                                                <input id="email{{$i}}" name="email{{$i}}" type="text" class="validate" required>
                                                <label for="email{{$i}}">Email</label>
                                            </div>
                                            <div class="input-field col s12 m6">
                                                <input id="phone{{$i}}" name="phone{{$i}}" type="number" class="validate con" required>
                                                <label for="phone{{$i}}">Phone</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <textarea id="address" name="address{{$i}}" class="materialize-textarea"></textarea>
                                                <label for="address">Address</label>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    {{--  </div>  --}}</div>
                @endfor
            </div>
        </div>
        <div class="col l1"></div>
           
            <div class="row en-container">
                    <div class="col s12">
                        <div class="card darken-1">
                            <div class="card-content" style="margin:10px; padding:10px">
                                <div class="row" style="margin:0;paddding:0">
                                    <input type="hidden" name="type" value="{{$type}}">
                                    <input type="hidden" name="rute_id" value="{{$rute->id}}">
                                    <button type="submit" class="btn waves-effect blue right"><i class="material-icons right">send</i> Proceed</button>    
                                    </form>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
@endsection
@section('script')

@endsection 


    
@endif