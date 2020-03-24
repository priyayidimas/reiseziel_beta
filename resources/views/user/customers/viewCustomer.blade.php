@php
    $data = DB::table('customer')->where('users_id','=',Auth::user()->id)->get();
    $ndata = DB::table('customer')->where('users_id','=',Auth::user()->id)->count();
@endphp
@extends('t_index')
@section('title')
User Dashboard
@endsection
@section('head')
<link rel="stylesheet" href="{{URL::asset('/assets/css/ui/jquery-ui.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('/assets/css/ui/jquery-ui.theme.min.css')}}">

<style>
  input:disabled, select:disabled {
    color:black !important;
  }
</style>
<script>
    $(function () {
        $("#d1").css('display','none');
    });
</script>
@endsection

@section('content')
@include('user.nav')
      <div class="row en-container"><br>
        <div class="col s12">
          <nav>
              <div class="nav-wrapper light-blue">
                <div class="col s12">
                  <a href="{{URL::to('/dashboard')}}" class="breadcrumb">My Account</a>
                  <a href="#!" class="breadcrumb">Passengers</a>
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
                    <div class="card-panel white">
                            <br>
                            <h5 class="center">Passengers List</h5>
                            <div class="divider"></div>
                            @if (isset($data))
                               @php
                                    $n = 1;
                               @endphp
                                @foreach ($data as $row)
                                <script type="text/javascript">
                                    var gender = '{{$row->gender}}';
                                    $(document).ready(function () {
                                        $('select').material_select();
                                        $('#gender').val(gender);
                                    });
                                </script>
                            <div class="row" style="margin-bottom: 0px">
                                    <div class="col s10">
                                            <ul class="collapsible" data-collapsible="accordion">
                                                        <li>
                                                          <div class="collapsible-header"><i class="material-icons">person</i> {{$row->name}}</div>
                                                          <div class="collapsible-body">
                                                              <form class="" action="{{URL::to('/updateCustomer/'.$row->id)}}" method="post">
                                                              {!! csrf_field() !!}
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
                                                                          <input id="fullname" name="fullname" type="text" class="validate" value="{{$row->name}}" disabled required>
                                                                          <label for="fullname">Full Name</label>
                                                                      </div>
                                                                      <div class="input-field col s12">
                                                                        <input id="email" name="email" type="text" class="validate" value="{{$row->email}}" disabled required>
                                                                        <label for="email">Email</label>
                                                                      </div>
                                                              </div>
                                                              <div class="row">
                                                                      <div class="input-field col s12">
                                                                          <input id="address" name="address" type="text" class="validate" value="{{$row->address}}" disabled required>
                                                                          <label for="address">Address</label>
                                                                      </div>
                                                                  </div>
                                                                  <div class="row">
                                                                      <div class="input-field col s12">
                                                                          <input id="phone" name="phone" type="text" class="validate" value="{{$row->phone}}" disabled required>
                                                                          <label for="phone">Phone</label>
                                                                      </div>
                                                                  </div>
                                                                  
                                                                  <button type="button" class="btn waves-effect amber white-text check">Edit <i class="material-icons left">edit</i></button>
                                                                  <button type="submit" class="btn green waves-effect waves-light validate" disabled>Submit<i class="material-icons right">send</i></button>
                                                                  
                                                              </form>  
                                                          </div>
                                                        </li>
                                                      </ul>
                                        </div>
                                        <div class="col s2 valign-wrapper" style="margin-top: 18px;">
                                            <a onclick="delfunc()" class="btn red waves-effect" id="{{"d".$n++}}">Delete</a>
                                        </div>
                            </div>
                                @endforeach
                            @endif
                    </div>
                    <a data-toggle="modal" data-target="#addCustomer" class="btn blue waves-effect"><i class="material-icons left">add</i> Add new Passenger</a>
            </div>
        
        </div>
        <!-- Modal -->
    <div id="addCustomer" class="modal fade" role="dialog">
            <div class="modal-dialog">
      
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h5 class="modal-title">Add New Passenger</h5>
                </div>
                <div class="modal-body row">
                        <form class="" action="{{URL::to('/insertCustomer/')}}" method="post">
                            {!! csrf_field() !!}
                            <div class="row">
                                    <div class="col s12 m3">
                                        <label>Title</label>
                                        <select class="browser-default" id="gender" name="gender">
                                                <option value="Mr." selected>Mr.</option>
                                                <option value="Mrs.">Mrs.</option>
                                                <option value="Ms.">Ms.</option>
                                        </select>     
                                    </div>
                                    <div class="input-field col s12 m9">
                                        <input id="fullname" name="fullname" type="text" class="">
                                        <label for="fullname">Full Name</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="email" name="email" type="text" class="validate" disabled required>
                                        <label for="email">Email</label>
                                      </div>
                            </div>
                            <div class="row">
                                    <div class="input-field col s12">
                                        <input id="address" name="address" type="text" class="" >
                                        <label for="address">Address</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="phone" name="phone" type="text" class="">
                                        <label for="phone">Phone</label>
                                    </div>
                                </div>
                                  
                <div class="modal-footer">
                  <button type="reset" class="btn btn-flat">Reset</button>
                  <button type="submit" class="btn green waves-effect waves-light">Submit<i class="material-icons right">send</i></button>
                </div>
               </form>
              </div>
      
            </div>
          </div>


@endsection
@section('script')
  <script type="text/javascript">
  @if (isset($row)) {
    function delfunc(){
      var r = confirm("Are You Sure To Delete This Record?");
      if (r == true) {
      window.location.href = "{{URL::to('/deleteCustomer/'.$row->id)}}";
      }
    }
  }
  @endif
  $(".check").click(function () {
          $(".validate").hasAttr("disabled") ? $(".validate").removeAttr("disabled") : $(".validate").prop("disabled",true);
    });
  </script>
<script src="{{URL::asset('/assets/js/datatables.js')}}" charset="utf-8"></script>
@endsection 
