@php
    $cus_user = DB::table('customer')->where('users_id','=',Auth::user()->id)->first();
    $data = DB::table('reservation')->where('contact_id','=',$cus_user->id)->get();
   
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
                  <a href="#!" class="breadcrumb">My Purchase History</a>
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
                            <h5 class="center">Booking History</h5>
                            <div class="divider"></div>
                            @if (isset($data))
                               @php
                                    $n = 1;
                               @endphp
                                @foreach ($data as $row)
                                @php
                                     $rute = DB::table('rute')->where('id','=',$row->rute_id)->first();
                                     $trans = DB::table('transportation')->where('id','=',$rute->transportation_id)->first();
                                     $duration = Carbon::parse($rute->duration)->format('H:i');
                                     $durationArr = explode(':',$duration); 
                                @endphp
                                <div class="row" style="margin-bottom: 0px">
                                  <div class="col s12">
                                      <ul class="collapsible" data-collapsible="accordion">
                                          <li>
                                            <div class="collapsible-header">
                                              <i class="material-icons">{{$type = ($trans->type_id == 1) ? "train" : "flight"  }}</i> {{$rute->rute_from}} <i class="material-icons tiny">arrow_forward</i> {{$rute->rute_to}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{Carbon::parse($row->reservation_date)->format('d/m/Y')}}
                                            </div>
                                            <div class="collapsible-body">
                                                <div class="row">
                                                    <div class="col s12">
                                                        <div class="row"><div class="col s12"><b>A. Trip Information</b></div></div>
                                                        <div class="row"><div class="col s1"></div>
                                                            <div class="col s4">
                                                                 <b>Booked By</b>
                                                            </div>
                                                            <div class="col s1">:</div>
                                                            <div class="col s6">
                                                                {{$cus_user->name}}
                                                            </div>
                                                        </div>
                                                        <div class="row"><div class="col s1"></div>
                                                            <div class="col s4">
                                                                 <b>Contact Email</b>
                                                            </div>
                                                            <div class="col s1">:</div>
                                                            <div class="col s6">
                                                                {{$cus_user->email}}
                                                            </div>
                                                        </div>
                                         
                                                        <div class="row"><div class="col s1"></div>
                                                             <div class="col s11 m4">
                                                                <b> {{$typei = ($trans->type_id == 1) ? "Train" : "Plane" }} Name </b>
                                                             </div>
                                                             <div class="col s1 m1">:</div>
                                                             <div class="col s12 m6">
                                                                 {{$trans->code}} - {{$trans->description}}
                                                             </div>
                                                         </div>
                                                         <div class="row"><div class="col s1"></div>
                                                             <div class="col m4">
                                                                <b> Departure </b>
                                                             </div>
                                                             <div class="col m1">:</div>
                                                             <div class="col m6">
                                                                 {{Carbon::parse($rute->depart_at)->format('d/m/Y H:i')}} <i class="material-icons tiny">arrow_forward</i> {{Carbon::parse($rute->depart_at)->addHour($durationArr[0])->addMinute($durationArr[1])->format('H:i')}}
                                                             </div>
                                                         </div>
                                                         <div class="row"><div class="col s1"></div>
                                                             <div class="col m4">
                                                                <b> Status </b>
                                                             </div>
                                                             <div class="col m1">:</div>
                                                             <div class="col m6">
                                                                 {{$status = ($row->payment_check == 1) ? "APPROVED" : "NOT APPROVED" }}
                                                             </div>
                                                         </div>
                                                         <div class="row"><div class="col s12"><b>B. Passenger Details</b></div></div>
                                                         <div class="row">
                                                             <div class="col s12">
                                                                 <table class="bordered data display" id="table_id">
                                                                     <thead>
                                                                         <tr>
                                                                             <th>NO</th>
                                                                             <th>SEAT CODE</th>
                                                                             <th>TITLE</th>
                                                                             <th>PASSENGER</th>
                                                                             <th style="text-align:center">PRICE</th>
                                                                         </tr>
                                                                     </thead>
                                                                     <tbody>
                                                                     @php
                                                                          $passenger = DB::table('ticket')->where('reservation_id','=',$row->id)->get();
                                                                          $total = DB::table('ticket')->where('reservation_id','=',$row->id)->sum('price');
                                                                     @endphp
                                                                     @foreach ($passenger as $pass)
                                                                     @php
                                                                         $cus = DB::table('customer')->where('id','=',$pass->customer_id)->first();
                                                                     @endphp
                                                                         <tr>
                                                                             <td>{{$n++}}</td>
                                                                             <td>{{$pass->seat_code}}</td>
                                                                             <td>{{$cus->gender}}</td>
                                                                             <td>{{$cus->name}}</td>
                                                                             <td style="text-align:right">Rp. {{number_format($pass->price,2,',','.')}}</td>
                                                                             <td></td>
                                                                         </tr>
                                                                     @endforeach
                                                                         <tr>
                                                                             <td colspan="3"></td>
                                                                             <td style="text-align:center"><b>TOTAL PRICE</b></td>
                                                                             <td style="text-align:right">Rp. {{number_format($total,2,',','.') }}</td>
                                                                             <td></td>
                                                                         </tr>
                                                                     </tbody>
                                                                 </table>
                                                             </div>
                                                         </div>
                                         
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col s12 m6"></div>
                                                    <div class="col s12 m3">
                                                        <a href="#modal{{$row->id}}" data-toggle="modal" class="btn red waves-effect"><i class="material-icons left">close</i> {{$tulisan = ($row->payment_check == 1) ? "Refund" : "Cancel"  }}</a>
                                                    </div>
                                                    <div class="col s12 m3">
                                                        @if ($row->payment_check == 1)
                                                            <form action="{{URL::to('/ticket')}}" method="post">
                                                                {!! csrf_field() !!}
                                                                <input type="hidden" name="id" value="{{$row->id}}">
                                                                <button type="submit" class="btn green waves-effect"><i class="material-icons left">print</i> Print Ticket</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                          </li>
                                      </ul>
                                  </div>
                                </div>

                                <div class="modal fade" id="modal{{$row->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h5 class="modal-title">Confirmation</h5>
                                            </div>
                                            <div class="modal-body">
                                                Are You Sure ? 
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{URL::to('/addMessage')}}" method="post">
                                                    {!! csrf_field() !!}
                                                    <input type="hidden" name="subject" value="ASK {{$tulisan}}">
                                                    <input type="hidden" name="sender" value="{{$user = (Auth::check()) ? Auth::user()->fullname : "UNKNOWN CUSTOMER" }}">
                                                    <input type="hidden" name="content" value="{{$row->reservation_code}}">
                                                    <button type="button" class="btn red" data-dismiss="modal">No</button>
                                                    <button type="submit" class="btn green">Yes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            @endif
                    </div>
            </div>
        
        </div>
    


@endsection
@section('script')

@endsection 
