@extends('t_index')
@section('title')
    Register
@endsection
@section('head')
    <style>
        body {
            background-color: #64b5f6  !important
        }
    </style>
@endsection
@section('content')
    <section class="row" style="padding-top: 30px">
        <div class="col m4"></div>
        <div class="col m4">
            <div class="card ">
                <div class="card-content">
                    <span class="card-title">Register to Reiseziel</span>
                    <div class="divider"></div><br>
                    <div class="row">
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

                            <form class="col s12" action="{{URL::to('/actregister')}}" method="POST">
                                <div class="row">
                                        <div class="col s12 ">
                                          <ul class="tabs tabs-fixed-width ">
                                            <li class="tab col s6"><a class="active blue-text" href="#test1">User Information</a></li>
                                            <li class="tab col s6"><a class="blue-text" href="#test2">User Details</a></li>
                                          </ul>
                                        </div>
                                </div>
                                <div class="row" id="test1">
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
                                            <input id="fullname" name="fullname" type="text" class="validate" required>
                                            <label for="fullname">Full Name</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="email" name="email" type="text" class="validate" required>
                                            <label for="email">Email</label>
                                        </div>
                                    </div>
            
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="password" name="password" type="password" class="validate" required>
                                            <label for="password">Password</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="password" name="cpassword" type="password" class="validate" required>
                                            <label for="password">Confirm Password</label>
                                        </div>
                                    </div> 
                                    <div class="divider"></div><br>
                                    <a href="{{url('/')}}" class="btn waves-effect white black-text"><i class="material-icons left">arrow_left</i>Back</a>
                                    <a type="button" class="btn waves-effect light-blue" id="next"><i class="material-icons right">arrow_forward</i>Next</a> 
                                </div>
                                <div class="row" id="test2">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <textarea id="textarea1" name="address" class="materialize-textarea" required></textarea>
                                            <label for="textarea1">Address</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="phone" name="phone" type="text" class="validate" required>
                                            <label for="phone">Phone</label>
                                        </div>
                                    </div>
                                    <br><br><br><br><div class="divider"></div><br>
                                    <a class="btn waves-effect red" id="previous"><i class="material-icons left">arrow_back</i>Previous</a>
                                    <button type="submit" class="btn waves-effect green"><i class="material-icons right">send</i>Submit</button> 
                                </div>
                            </form>
                    </div>
                </div>

            </form>
            </div>
        </div>
        <div class="col m4"></div>
    </section>
    <script>
        $('#next').click(function () {  
           $('ul.tabs').tabs('select_tab', 'test2');
        });
        $('#previous').click(function () {  
           $('ul.tabs').tabs('select_tab', 'test1');
        });
    </script>
</body>
@endsection