
   @foreach ($reserve as $data)
    @php
    $contact = DB::table('customer')->where('id','=',$data->contact_id)->first();
    $rute = DB::table('rute')->where('id','=',$data->rute_id)->first();
    $trans = DB::table('transportation')->where('id','=',$rute->transportation_id)->first();
    $duration = Carbon::parse($rute->duration)->format('H:i');
    $durationArr = explode(':',$duration);
    $passenger = DB::table('ticket')->where('reservation_id','=',$data->id)->get();
    $n = 1;
    @endphp
    <link rel="stylesheet" href="{{URL::asset('/assets/css/ui/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/assets/css/ui/jquery-ui.theme.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/assets/css/datatables.css')}}">
    <script src="{{url('/assets/js/jquery.min.js')}}"></script>
    <script src="{{url('/assets/js/jquery-ui.min.js')}}" charset="utf-8"></script>
    <style>
        .row {
            margin-bottom: 10px;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#table_id').DataTable({
                paging : false
            });
        });
    </script>
       <div class="row">
           <div class="col s12">
               <div class="row"><div class="col s12"><b>A. Trip Information</b></div></div>
               <div class="row"><div class="col s1"></div>
                   <div class="col s4">
                        <b>Booked By</b>
                   </div>
                   <div class="col s1">:</div>
                   <div class="col s6">
                       {{$contact->name}}
                   </div>
               </div>
               <div class="row"><div class="col s1"></div>
                   <div class="col s4">
                        <b>Contact Email</b>
                   </div>
                   <div class="col s1">:</div>
                   <div class="col s6">
                       {{$contact->email}}
                   </div>
               </div>

               <div class="row"><div class="col s1"></div>
                    <div class="col s11 m4">
                       <b> {{$type = ($trans->type_id == 1) ? "Train" : "Plane" }} Name </b>
                    </div>
                    <div class="col s1 m1">:</div>
                    <div class="col s12 m6">
                        {{$trans->code}} - {{$trans->description}}
                    </div>
                </div>
                <div class="row"><div class="col s1"></div>
                    <div class="col m4">
                        <b>Route</b>
                    </div>
                    <div class="col m1">:</div>
                    <div class="col m6">
                        {{$rute->rute_from}} <i class="material-icons tiny">arrow_forward</i> {{$rute->rute_to}}
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
                                    <td style="text-align:right">Rp. {{number_format($data->total,2,',','.') }}</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

           </div>
       </div>
    
    <div class="row">
        <div class="col s4">
            <button type="button" class="btn btn-flat" data-dismiss="modal">Close</button>
        </div>
        @if ($data->payment_check == 0)
        <div class="col s4">
            <form action="{{url('/delReserve')}}" method="post">
                {!! csrf_field() !!}
                <input type="hidden" name="type" value="Declined">
                <input type="hidden" name="id" value="{{$data->id}}">
                <button type="submit" class="btn red waves-effect waves-light">Decline<i class="material-icons left">block</i></button>
            </form>
        </div>
        <div class="col s4">
            <form action="{{url('/approve')}}" method="post">
                {!! csrf_field() !!}
                <input type="hidden" name="id" value="{{$data->id}}">
                <button type="submit" class="btn green waves-effect waves-light">Approve<i class="material-icons right">done</i></button>
            </form>
        </div>
        @else
        <div class="col s6">
            <form action="{{url('/delReserve')}}" method="post">
                {!! csrf_field() !!}
                <input type="hidden" name="type" value="Refunded">
                <input type="hidden" name="id" value="{{$data->id}}">
                <button type="submit" class="btn red waves-effect waves-light">Refund<i class="material-icons left">payment</i></button>
            </form>
        </div>
        @endif
    </div>
        
        

   @endforeach
   <script src="{{URL::asset('/assets/js/datatables.js')}}" charset="utf-8"></script>
