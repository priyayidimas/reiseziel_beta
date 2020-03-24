
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
    table tr td, th{
        font-size: 12pt
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
                    <a class="breadcrumb">Search {{Session::get('type')}} </a>
                    <a class="breadcrumb">Confirm Book</a>
                    <a class="breadcrumb">Fill Information</a>
                    <a class="breadcrumb">Confirm Payment</a>
                </div>
              </div>
            </nav>
          </div>
        </div>
        
    @foreach($reservation as $res)
    @php
        $ticket = DB::table('ticket')->where('reservation_id','=',$res->id)->get();
    @endphp
    <div class="row en-container">
        <div class="col s12 m7">
                <div class="card white darken-1">
                        <div class="card-content">
                            <span class="card-title">Complete Your Payment</span>
                            <div class="divider"></div><br><br>
                            <h5>Please Transfer To : </h5>
                            <ul class="collapsible" data-collapsible="accordion">
                              <li>
                                <div class="collapsible-header active"><h5>BRI</h5></div>
                                <div class="collapsible-body">
                                    <div class="row">
                                        <div class="col s5">Account Number</div>
                                        <div class="col s1">:</div>
                                        <div class="col s6">6150 42998</div>
                                    </div>
                                    <div class="row">
                                        <div class="col s5">Account Holder Name</div>
                                        <div class="col s1">:</div>
                                        <div class="col s6">DIMAS ANOM PRIYAYI</div>
                                    </div>
                                    <div class="row">
                                        <div class="col s5">Transfer Amount</div>
                                        <div class="col s1">:</div>
                                        <div class="col s6">Rp. {{number_format($res->total,2,',','.')}}</div>
                                    </div>
                                </div>
                              </li>
                              <li>
                                <div class="collapsible-header"><h5>BCA</h5></div>
                                <div class="collapsible-body">
                                    <div class="row">
                                        <div class="col s5">Account Number</div>
                                        <div class="col s1">:</div>
                                        <div class="col s6">3232 1909 21</div>
                                    </div>
                                    <div class="row">
                                        <div class="col s5">Account Holder Name</div>
                                        <div class="col s1">:</div>
                                        <div class="col s6">DIMAS ANOM PRIYAYI</div>
                                    </div>
                                    <div class="row">
                                        <div class="col s5">Transfer Amount</div>
                                        <div class="col s1">:</div>
                                        <div class="col s6">Rp. {{number_format($res->total,2,',','.')}}</div>
                                    </div>
                                </div>
                              </li>
                              <li>
                                <div class="collapsible-header"><h5>BNI</h5></div>
                                <div class="collapsible-body">
                                    <div class="row">
                                        <div class="col s5">Account Number</div>
                                        <div class="col s1">:</div>
                                        <div class="col s6">3273 9999 2222</div>
                                    </div>
                                    <div class="row">
                                        <div class="col s5">Account Holder Name</div>
                                        <div class="col s1">:</div>
                                        <div class="col s6">DIMAS ANOM PRIYAYI</div>
                                    </div>
                                    <div class="row">
                                        <div class="col s5">Transfer Amount</div>
                                        <div class="col s1">:</div>
                                        <div class="col s6">Rp. {{number_format($res->total,2,',','.')}}</div>
                                    </div>
                                </div>
                              </li>
                            </ul>
            
                        </div>
                        <div class="card-action">
                            <a href="{{URL::to('/')}}" class="btn-flat waves-effect black-text"><i class="material-icons left">home</i> Back To Home</a>
                            <button type="button" data-toggle="modal" data-target="#del" class="btn red waves-effect"><i class="material-icons left">close</i> Cancel Booking</button>
                            <a href="{{URL::to('/retrieveBooking')}}" class="btn blue waves-effect"><i class="material-icons left">book</i> Retrieve Booking</a>
                        </div>
                    </div>
        </div>
        <div class="col s12 m5">
                <div class="card white darken-1">
                        <div class="card-content">
                            <span class="card-title">BOOKING ID : {{$res->reservation_code}}</span>
                            <table>
                                <thead>
                                    <tr>
                                        <th data-field="name">PASSENGER NAME</th>
                                        <th data-field="price">PRICE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ticket as $data)
                                    @php
                                        $cus = DB::table('customer')->where('id','=',$data->customer_id)->first()->name;
                                    @endphp
                                        <tr>
                                            <td>{{$cus}}</td>
                                            <td>Rp. {{number_format($data->price,2,',','.')}}</td>
                                        </tr>
                                    @endforeach
                                    <div class="divider"></div>
                                    <tr>
                                        <td><b>TOTAL PRICE</b></td>
                                        <td><b>Rp. {{number_format($res->total,2,',','.')}}</b></td>
                                    </tr>
                                </tbody>
                            </table>
            
                        </div>
                    </div>
        </div>
    </div>

        @endforeach

        <div class="modal fade" id="del">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h5 class="modal-title">Confirmation</h5>
                        </div>
                        <div class="modal-body">
                            Are You Sure Want To Cancel Your Book ? This Operation Can Never Be Undone
                        </div>
                        <div class="modal-footer">
                                <form action="{{URL::to('/delReserveCode')}}" method="post">
                                    {!!csrf_field()!!}
                                    <input type="hidden" name="code" value="{{$res->reservation_code}}" >    
                                    <button type="button" class="btn-flat" data-dismiss="modal">No</button>
                                    <button type="submit" class="btn red waves-effect"> Yes </button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
                

@endsection
@section('script')
<script src="{{URL::asset('/assets/js/datatables.js')}}" charset="utf-8"></script>
@endsection 




    