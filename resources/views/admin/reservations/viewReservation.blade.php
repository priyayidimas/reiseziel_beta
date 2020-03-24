@php
if (isset($fil_year)) {
  $data = DB::select("SELECT reservation.*,SUM(ticket.price) AS total FROM reservation,ticket WHERE ticket.reservation_id = reservation.id AND reservation.reservation_date LIKE '$fil_year-$fil_mon-%' GROUP BY ticket.reservation_id ORDER BY payment_check ASC, reservation_date DESC");
}else {
  $data = DB::select("SELECT reservation.*,SUM(ticket.price) AS total FROM reservation,ticket WHERE ticket.reservation_id = reservation.id GROUP BY ticket.reservation_id ORDER BY payment_check ASC, reservation_date DESC");
}
    $mon = array(
            '01' => "January", 
            '02' => "February",
            '03' => "March", 
            '04' => "April", 
            '05' => 'May', 
            '06' => "June", 
            '07' => "July", 
            '08' => "August",
            '09' => "September",
            '10' => "October",
            '11' => "November",
            '12' => "December",
        );
@endphp
@extends('t_index')
@section('title')
Admin Dashboard
@endsection
@section('head')
<link rel="stylesheet" href="{{URL::asset('/assets/css/ui/jquery-ui.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('/assets/css/ui/jquery-ui.theme.min.css')}}">
<link rel="stylesheet" href="{{URL::asset('/assets/css/datatables.css')}}">

<script type="text/javascript">
$(document).ready(function () {
    $('.display').DataTable({
        paging : false
    });
});
</script>
@endsection

@section('content')
@include('admin.nav')
      <div class="row en-container"><br>
        <div class="col s12">
          <nav>
              <div class="nav-wrapper light-blue">
                <div class="col s12">
                  <a href="{{URL::to('/dashboard')}}" class="breadcrumb">Dashboard</a>
                  <a href="#!" class="breadcrumb">Reservation</a>
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
          <div class="col s12 m12">
              <div class="card-panel white">
                  <h5>Filter Reservation</h5>
                  <div class="row">
                    <div class="col s12 m3 l2">
                      <form action="{{URL::to('/dashboard/filterReservations')}}" method="post">
                        {!!csrf_field()!!}
                          <select class="browser-default" id="mon" name="mon">
                              <option value="" disabled selected>Select Month</option>
                              <option value="00" >----</option>
                              @foreach ($mon as $key => $item)
                               <option value="{{$key}}">{{$item}}</option>   
                              @endforeach
                          </select>            
                    </div>
                    <div class="col s12 m3 l2">
                          <select class="browser-default" id="year" name="year">
                              <option value="" disabled selected>Select Year</option>
                              @for ($i = 2016; $i <= 2030; $i++)
                              <option>{{$i}}</option>    
                              @endfor
                          </select>            
                    </div>
                    <div class="col s12 m3 l2">
                      <button type="submit" class="btn blue waves-effect btn-small"><i class="material-icons left">date_range</i>Filter Data</a>                  
                    </div>

                  </div>
                </form>
              </div>
          </div>
        </div>

        <div class="row en-container">
          <div class="col s12 m3">
              <div class="card-panel white">
                  @if (isset($fil_year))
                  <a href="{{URL::to('/dashboard/exportReservation/'.$fil_year.'/'.$fil_mon)}}" class="btn green waves-effect btn-small"><i class="material-icons left">save</i>Export Excel</a>
                  @else
                  <a href="{{URL::to('/dashboard/exportReservation')}}" class="btn green waves-effect btn-small"><i class="material-icons left">save</i>Export Excel</a>
                  @endif
              </div>
          </div>
        </div>

        {{--  <div class="row en-container">
            <div class="col s12 m6">  --}}
                {{--  <div class="card-panel white">  --}}
                {{--  <ul class="collapsible" data-collapsible="accordion"><li>
                    <div class="collapsible-header center active"><h5 class="center">Unapproved</h5></div>
                    <div class="collapsible-body card-panel no-margin">
                    
                        @if (isset($data))
                        <table class="bordered data display" id="table_id">
                          <thead>
                            <tr style="center">
                              <th>NO</th>
                              <th>CODE</th>
                              <th>DATE</th>
                              <th>PRICE</th>
                              <th>ACTION</th>
                            </tr>
                          </thead>
          
                          <tbody>
                            @php
                              $n = 1
                            @endphp
                           @foreach ($data as $row)
                             @if ($row->payment_check == 0)
                              <tr>
                                <td>{{$n++}}</td>
                                <td>{{$row->reservation_code}}</td>
                                <td>{{Carbon::parse($row->reservation_date)->format('d/m/Y H:i:s')}}</td>
                                <td>Rp. {{number_format($row->total,2,',','.') }}</td>
                                <td style="width: 50px">
                                    <button class="col s6 m6 l6 btn btn-small green darken-2 waves-effect waves-light" onclick="location.href= '{{URL::to('/approve/'.$row->id)}}'"><i class="material-icons">check</i></button>
                                    <button class="col s6 m6 l6 btn btn-small red darken-2 waves-effect waves-light" onclick="delfunc()"><i class="material-icons">delete</i></button>
                                </td>
                              </tr>
                              @endif
                            @endforeach
                          </tbody>
                        </table>
                        @endif
                  </div></li></ul>  --}}
            {{--  </div>  --}}
            {{--  </div>
            <div class="col s12 m6">  --}}
                    {{--  <div class="card-panel white">  --}}

                        {{--  <ul class="collapsible" data-collapsible="accordion"><li>
                            <div class="collapsible-header center active"><h5>Approved</h5></div>
                            <div class="collapsible-body card-panel no-margin">

                                @if (isset($data))
                                <table class="bordered data display" id="table_id">
                                  <thead>
                                    <tr style="center">
                                      <th>NO</th>
                                      <th>CODE</th>
                                      <th>DATE</th>
                                      <th>PRICE</th>
                                      <th>ACTION</th>
                                    </tr>
                                  </thead>
                  
                                  <tbody>
                                    @php
                                      $n = 1
                                    @endphp
                                   @foreach ($data as $row)
                                     @if ($row->payment_check == 1)
                                      <tr>
                                        <td>{{$n++}}</td>
                                        <td>{{$row->reservation_code}}</td>
                                        <td>{{Carbon::parse($row->reservation_date)->format('d/m/Y H:i:s')}}</td>
                                        <td>Rp. {{number_format($row->total,2,',','.') }}</td>
                                        <td style="width: 50px">
                                            <button class="col s6 m6 l6 btn btn-small red darken-2 waves-effect waves-light" onclick="delfunc()"><i class="material-icons">delete</i></button>
                                        </td>
                                      </tr>
                                      @endif
                                    @endforeach
                                  </tbody>
                                </table>
                                @endif
                          </div></li></ul>  --}}
                    {{--  </div>  --}}
            {{--  </div>
        </div>  --}}

        <div class="row en-container">
            <div class="col s12">
                <div class="card-panel white">
                    <h5 class="center">Reservation List</h5>
                    <div class="divider">  </div>
                    @if (isset($data))
                    <table class="bordered data display">
                      <thead>
                        <tr style="center">
                          <th>NO</th>
                          <th>RESERVATION CODE</th>
                          <th>RESERVATION DATE</th>
                          <th>PRICE</th>
                          <th>STATUS</th>
                          <th>PAYMENT PROOF</th>
                          <th>ACTION</th>
                        </tr>
                      </thead>
      
                      <tbody>
                        @php
                          $n = 1
                        @endphp
                       @foreach ($data as $row)
                          <tr>
                            <td>{{$n++}}</td>
                            <td>{{$row->reservation_code}}</td>
                            <td>{{$row->reservation_date}}</td>
                            <td>Rp. {{number_format($row->total,2,',','.') }}</td>
                            <td>{{ $status = ($row->payment_check == 1) ? "Approved" : "Not Approved" }}</td>
                            <td><a href="{{URL::to('/upload/'.$row->payment_proof)}}" target="_blank">{{$row->payment_proof}}</a></td>
                            <td style="width: 50px">
                                <button class="col s12 m12 l12 btn green darken-2 waves-effect waves-light" data-toggle="modal" data-target="#detail" data-content="{{$row->id}}" ><i class="material-icons">search</i></button>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                    @endif
            </div>
            </div>
        </div>

        <div id="detail" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h5 class="modal-title">Reservation Details</h5>
                </div>
                <div class="modal-body">
        
                </div>
              </div>
            </div>
          </div>


@endsection
@section('script')
  <script type="text/javascript">
    $('#detail').on('show.bs.modal', function(ev) {
        var modal = $(this);
        var link = $(ev.relatedTarget);
        var id = link.data('content');
        modal.find('.modal-body').load('/dashboard/detailReservation/' + id);
    });
  </script>
<script src="{{URL::asset('/assets/js/datatables.js')}}" charset="utf-8"></script>
@endsection 
