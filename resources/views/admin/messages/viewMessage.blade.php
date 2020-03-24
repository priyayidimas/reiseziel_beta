@php
  $data = DB::table('message')->get();
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
                  <a href="#!" class="breadcrumb">Messages</a>
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
          <div class="col s12 m3">
              <div class="card-panel white">
                  <a href="{{URL::to('/dashboard/exportMessage')}}" class="btn green waves-effect btn-small"><i class="material-icons left">save</i>Export Excel</a>
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
                    <h5 class="center">Message List</h5>
                    <div class="divider">  </div>
                    @if (isset($data))
                    <table class="bordered data display">
                      <thead>
                        <tr style="center">
                          <th>NO</th>
                          <th>SENDER</th>
                          <th>SUBJECT</th>
                          <th>CONTENT</th>
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
                            <td>{{$row->sender}}</td>
                            <td>{{$row->subject}}</td>
                            <td class="truncate">{{$row->content}}</td>
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
                  <h5 class="modal-title">Message Details</h5>
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
        modal.find('.modal-body').load('/dashboard/detailMessage/' + id);
    });
  </script>
<script src="{{URL::asset('/assets/js/datatables.js')}}" charset="utf-8"></script>
@endsection 
