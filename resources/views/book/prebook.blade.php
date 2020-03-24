@if (isset($rute))
    @php
        $total = $rute->price * Session::get('passenger');
    @endphp

@extends('t_index')
@section('title')
Book Process
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
</style>
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
                </div>
              </div>
            </nav>
          </div>
        </div>
        @php
            $duration = Carbon::parse($rute->duration)->format('H:i');
            $durationArr = explode(':',$duration);
        @endphp
        <div class="row container">
            <div class="col s12">
                <div class="card darken-1">
                    <div class="card-content">
                        <span class="card-title">{{$type}} Details</span><div class="divider"></div><br>
                        <div class="row">
                            <div class="col s11 m5">
                                {{$type}} Name
                            </div>
                            <div class="col s1 m1">:</div>
                            <div class="col s12 m6">
                                {{$trans->code}} - {{$trans->description}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col m5">
                                Route
                            </div>
                            <div class="col m1">:</div>
                            <div class="col m6">
                                {{$rute->rute_from}} <i class="material-icons tiny">arrow_forward</i> {{$rute->rute_to}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col m5">
                                Departure
                            </div>
                            <div class="col m1">:</div>
                            <div class="col m6">
                                {{Carbon::parse($rute->depart_at)->format('d/m/Y H:i')}} <i class="material-icons tiny">arrow_forward</i> {{Carbon::parse($rute->depart_at)->addHour($durationArr[0])->addMinute($durationArr[1])->format('H:i')}}
                            </div>
                        </div>
                        <div class="row">
                                <div class="col m5">
                                    Estimated Duration
                                </div>
                                <div class="col m1">:</div>
                                <div class="col m6">
                                    {{$durationArr[0]}}h {{$durationArr[1]}}m
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row container">
                <div class="col m12">
                    <div class="card darken-1">
                        <div class="card-content">
                            <span class="card-title">Price Details</span><div class="divider"></div><br>
                            <div class="row">
                                <div class="col m5">
                                    Total Passenger
                                </div>
                                <div class="col m1">:</div>
                                <div class="col m4">
                                    {{Session::get('passenger')}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col m5">
                                    Base Price
                                </div>
                                <div class="col m1">:</div>
                                <div class="col m1 ">
                                    Rp. 
                                </div>
                                <div class="col m2 right-align">
                                   {{number_format($rute->price,2,',','.')}}
                                </div>
                            </div>
                            @if (Auth::check())
                            @php
                                $disc = $rute->price*15/100;
                                $total = $total - $disc
                            @endphp
                            <div class="row">
                                <div class="col m5">
                                    User Discount
                                </div>
                                <div class="col m1">:</div>
                                <div class="col m1 ">
                                    Rp. 
                                </div>
                                <div class="col m2 right-align">
                                   - {{number_format($disc,2,',','.')}}
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col m5">
                                    Total Price
                                </div>
                                <div class="col m1">:</div>
                                <div class="col m1 ">
                                    Rp. 
                                </div>
                                <div class="col m2 right-align">
                                    {{number_format($total,2,',','.') }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row container">
                    <div class="col s12">
                        <div class="card darken-1">
                            <div class="card-content" style="margin:10px; padding:10px">
                                <div class="row" style="margin:0;paddding:0">
                                    <form action="{{url('/booking/fillContact')}}" method="post">
                                    {!! csrf_field() !!}
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
<script src="{{URL::asset('/assets/js/datatables.js')}}" charset="utf-8"></script>
@endsection 




    
@endif