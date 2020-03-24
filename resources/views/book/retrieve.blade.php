
@extends('t_index')
@section('title')
Retrieve Booking
@endsection
@section('head')
<link rel="stylesheet" href="{{URL::asset('/assets/css/ui/jquery-ui.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('/assets/css/ui/jquery-ui.theme.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('/assets/css/datatables.css')}}">

<script type="text/javascript">
$(document).ready(function () {
      $('#table_id').DataTable({
        paging : false
    });

});
</script>
<style>
    table tr td{
        font-size: 14pt
    }
    #card-alert a {
        color: #FFF;
        text-decoration: underline;
    }
</style>
@endsection

@section('content')
@include('book.navbar')
      <div class="row en-container"><br>
        <div class="col s12">
          <nav>
              <div class="nav-wrapper light-blue">
                <div class="col s12">
                  <a class="breadcrumb">Retrieve Booking </a>
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
                          <p>{!!Session::get('msg')!!}</p>
                      </div>
                      <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                    </div>
                  @endif
            </div>
        </div>

        <div class="row container">
            <div class="tabs-vertical">
                    <div class="col s12 m3 l3">
                        <ul class="tabs">
                            <li class="tab">
                                <a class="waves-effect waves-cyan" href="#plane"><i class="zmdi zmdi-apps"></i>Plane</a>
                            </li>
                            <li class="tab">
                                <a class="waves-effect waves-cyan" href="#train"><i class="zmdi zmdi-email"></i>Train</a>
                            </li>
                        </ul>
                        </div>
                        <div class="col s12 m9 l9">
                            <div id="plane" class="tab-content">
                                <div class="card white">
                                    <div class="card-content">
                            
                                        <form class="" action="{{URL::to('/retrieveBook')}}" method="post">
                                            {!! csrf_field() !!}
                                            
                                                <div class="row">
                                                    <h5>Retrieve Your Flight Book</h5><br><br>
                                                        <div class="input-field col s12 m8">
                                                            <input name="res" type="text" class="validate" required>
                                                            <label for="res">Reservation Code</label>
                                                        </div>
                                                        <div class="col s12 m4 right-align">
                                                            <button type="submit" class="btn waves-effect blue" style="margin-top: 30px;">Retrieve Now</button>
                                                        </div>
                                                    </div>
                                            </form>
                                    </div>
    
                                </div>
                            </div>
                            <div id="train" class="tab-content">
                                <div class="card white">
                                    <div class="card-content">
                                    
                                            <form class="" action="{{URL::to('/retrieveBook')}}" method="post">
                                                {!! csrf_field() !!}
                                                
                                                    <div class="row">
                                                        <h5>Retrieve Your Train Book</h5><br><br>
                                                            <div class="input-field col s12 m8">
                                                                <input name="res" type="text" class="validate" required>
                                                                <label for="res">Reservation Code</label>
                                                            </div>
                                                            <div class="col s12 m4 right-align">
                                                                <button type="submit" class="btn waves-effect blue" style="margin-top: 30px;">Retrieve Now</button>
                                                            </div>
                                                        </div>
                                                </form>
    
                                    </div>
                                </div>  
                            </div>
                        </div>
        


@endsection
@section('script')
<script src="{{URL::asset('/assets/js/datatables.js')}}" charset="utf-8"></script>
@endsection 


