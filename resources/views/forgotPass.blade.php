@extends('t_index')
@section('title')
    forgot password
@endsection
@section('head')
    <style>

        body {
            background-color: #64b5f6  !important
        }

    </style>
@endsection
@section('content')

    <section class="row">
        <div class="col m4"></div>
        <div class="col m4">
            <div class="card ">
                <div class="card-content">
                    <span class="card-title">Forgot Password</span>
                    <div class="divider"></div><br>
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
                    <div class="row">
                      <form class="col s12" action="{{URL::to('/actForgotPass')}}" method="POST">
                              {!! csrf_field() !!}
                              <div class="row">
                                    <div class="input-field col s12">
                                      <input id="email" name="email" type="email" class="validate" required>
                                      <label for="email">Email</label>
                                    </div>
                                </div>
                    </div>
                </div>
                <div class="card-action">
                    <a class="btn waves-effect white black-text" href="{{URL::to('/')}}">Back <i class="material-icons left">arrow_back</i></a>
                    <button type="submit" class="btn waves-effect green">Submit <i class="material-icons right">send</i></button>
                  </form>
                </div>
            </div>
        </div>
        <div class="col m4"></div>
    </section>

@endsection