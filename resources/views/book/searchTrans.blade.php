@if (isset($data))
@php
    $type = ($input['type'] == "1") ? "Train" : "Plane" ;
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
                </div>
              </div>
            </nav>
          </div>
        </div>

        <div class="row container">
            <div class="col s12">
                    <div class="card-panel white">
                            
                            <br>
                            <h5 class="header">{{$input['from']}} <i class="material-icons">arrow_forward</i> {{$input['to']}}</h5>
                            <h6 class="header">{{Carbon::parse($input['depart'])->format('l, d F Y')}}</h6>
                            <div class="divider">  </div>
                            @if (isset($data))
                            <table class="bordered data display" id="table_id">
                              <thead>
                                <tr style="center">
                                  <th>NO</th>
                                  <th>{{strtoupper($type)}} NAME</th>
                                  <th>TICKET AVAILABLE</th>
                                  <TH>DEPART AT</TH>
                                  <TH>ETA</TH>
                                  <th>Price per person</th>
                                </tr>
                              </thead>
              
                              <tbody>
                                @php
                                  $n = 1
                                @endphp
                               @foreach ($data as $row)
                                @php
                                    $duration = Carbon::parse($row->duration)->format('H:i');
                                    $durationArr = explode(':',$duration);
                                @endphp
                                @if ($row->seat_avail > 0)
                                  <tr>
                                    <td>{{$n++}}</td>
                                    <td>{{$row->code}} - {{$row->description}}</td>
                                    <td>{{$row->seat_avail}}</td>
                                    <td>{{Carbon::parse($row->depart_at)->format('H:i')}}</td>
                                    <td>{{Carbon::parse($row->depart_at)->addHour($durationArr[0])->addMinute($durationArr[1])->format('H:i')}}</td>
                                    <td style="width: 150px" class="right-align">
                                        <h5 class="light-blue-text">Rp. {{$row->price}} </h5>
                                        <form action="{{url('/booking/prebook/')}}" method="post">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="{{$type}}">
                                        <input type="hidden" name="rute_id" value="{{$row->id}}">
                                          <button type="submit" class="btn blue waves-effect" >Choose</button> 
                                        </form>
                                    </td>
                                  </tr>
                                  @endif
                                @endforeach
                              </tbody>
                            </table>
                            @endif
                    </div>
            </div>
        </div>


@endsection
@section('script')
<script src="{{URL::asset('/assets/js/datatables.js')}}" charset="utf-8"></script>
@endsection 


    
@endif