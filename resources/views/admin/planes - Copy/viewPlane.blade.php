@php
    $dataPlane = DB::table('transportation')->where('type_id','=','2')->get();
    $dataRoute = DB::select("SELECT transportation.type_id,transportation.id,transportation.code,rute.* FROM transportation,rute WHERE rute.transportation_id = transportation.id AND transportation.type_id = 2");
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
                  <a href="#!" class="breadcrumb">Planes</a>
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
          <div class="col s12">
              <div class="card-panel white">
                  <a href="{{URL::to('/export')}}" class="btn green waves-effect btn-small"><i class="material-icons left">save</i>Export Excel</a>
                  <a class="btn waves-effect btn-small" data-toggle="modal" data-target="#addPlane"><i class="material-icons left">add</i>Add New Plane</a>
                  <a class="btn amber waves-effect btn-small" data-toggle="modal" data-target="#addRoute"><i class="material-icons left">add</i>Add New Route</a>
              </div>
          </div>
        </div>

        <div class="row en-container">
            <div class="col s12 m5">
                {{--  <div class="card-panel white">  --}}
                <ul class="collapsible" data-collapsible="accordion"><li>
                    <div class="collapsible-header center active"><h5 class="center">Plane List</h5></div>
                    <div class="collapsible-body card-panel no-margin">
                    
                    @if (isset($dataPlane))
                    <table class="bordered data display" id="table_id" style="font-size: 10pt">
                      <thead>
                        <tr style="center">
                          <th>NO</th>
                          <th>PLANE CODE</th>
                          <th>NAME</th>
                          <th>SEAT QTY</th>
                          <th>ACTION</th>
                        </tr>
                      </thead>
      
                      <tbody>
                        @php
                          $n = 1
                        @endphp
                       @foreach ($dataPlane as $row)
                          <tr>
                            <td>{{$n++}}</td>
                            <td>{{$row->code}}</td>
                            <td>{{$row->description}}</td>
                            <td>{{$row->seat_qty}}</td>
                            <td style="width: 90px">
                                <button class="col s4  btn btn-small yellow darken-2 waves-effect waves-light" data-toggle="modal" data-target="#editPlane" data-content="{{$row->id}}" ><i class="material-icons">edit</i></button>
                                <button class="col s4  btn btn-small red darken-2 waves-effect waves-light" data-toggle="modal" data-target="#delPlane" data-content="{{$row->id}}"><i class="material-icons">delete</i></button>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                    @endif
                  </div></li></ul>
            {{--  </div>  --}}
            </div>
            <div class="col s12 m7">
                    {{--  <div class="card-panel white">  --}}

                        <ul class="collapsible" data-collapsible="accordion"><li>
                            <div class="collapsible-header center active"><h5>Route Details</h5></div>
                            <div class="collapsible-body card-panel no-margin">

                            @if (isset($dataRoute))
                            <table class="bordered data display" id="table_id" style="font-size: 9pt">
                              <thead>
                                <tr style="center">
                                  <th>NO</th>
                                  <th>PLANE CODE</th>
                                  <th>DEPART FROM</th>
                                  <TH>DESTINATION</TH>
                                  <TH>DEPART AT</TH>
                                  <TH>ETA</TH>
                                  <th>ACTION</th>
                                </tr>
                              </thead>
              
                              <tbody>
                                @php
                                  $n = 1
                                @endphp
                               @foreach ($dataRoute as $row)
                                @php
                                    $duration = Carbon::parse($row->duration)->format('H:i');
                                    $durationArr = explode(':',$duration);
                                @endphp
                                  <tr>
                                    <td>{{$n++}}</td>
                                    <td>{{$row->code}}</td>
                                    <td>{{$row->rute_from}}</td>
                                    <td>{{$row->rute_to}}</td>
                                    <td>{{Carbon::parse($row->depart_at)->format('d/m/Y H:i')}}</td>
                                    <td>{{Carbon::parse($row->depart_at)->addHour($durationArr[0])->addMinute($durationArr[1])->format('d/m/Y H:i')}}</td>
                                    <td style="width: 100px">
                                        <button class="col s4  btn btn-small yellow darken-2 waves-effect waves-light" data-toggle="modal" data-target="#editRoute" data-content="{{$row->id}}"><i class="material-icons">edit</i></button>
                                        <button class="col s4  btn btn-small amber darken-2 waves-effect waves-light" data-toggle="modal" data-target="#delRoute" data-content="{{$row->id}}" ><i class="material-icons">delete</i></button>
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                            @endif
                          </div></li></ul>
                    {{--  </div>  --}}
            </div>
        </div>

  <div class="nothing-just-modal">
        <div id="addPlane" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Add Plane</h5>
              </div>
              <div class="modal-body">
      
              </div>
            </div>
          </div>
        </div>
        <div id="addRoute" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Add Route</h5>
              </div>
              <div class="modal-body">
      
              </div>
            </div>
          </div>
        </div>
        <div id="editPlane" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Edit Plane</h5>
              </div>
              <div class="modal-body">
      
              </div>
            </div>
          </div>
        </div>

        <div id="delPlane" class="modal fade" role="dialog">
          <div class="modal-dialog">
  
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h5 class="modal-title">Delete Plane</h5>
                  </div>
                  <div class="modal-body">
                      
                  </div>
              </div>
          </div>
      </div>
      
        <div id="editRoute" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Edit Route</h5>
              </div>
              <div class="modal-body">
      
              </div>
            </div>
          </div>
        </div>

        <div id="delRoute" class="modal fade" role="dialog">
          <div class="modal-dialog">

              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h5 class="modal-title">Delete Route</h5>
                  </div>
                  <div class="modal-body">
                      
                  </div>
              </div>
          </div>
      </div>

  </div>

        


@endsection
@section('script')
  <script type="text/javascript">
    $('#addPlane').on('show.bs.modal', function(ev) {
        var modal = $(this);
        var link = $(ev.relatedTarget);
        modal.find('.modal-body').load('/dashboard/addPlane/');
    });
    $('#addRoute').on('show.bs.modal', function(ev) {
        var modal = $(this);
        var link = $(ev.relatedTarget);
        modal.find('.modal-body').load('/dashboard/addPlaneRoute/');
    });
    $('#editPlane').on('show.bs.modal', function(ev) {
        var modal = $(this);
        var link = $(ev.relatedTarget);
        var id = link.data('content');
        modal.find('.modal-body').load('/dashboard/editPlane/' + id);
    });
    $('#delPlane').on('show.bs.modal', function(ev) {
            var modal = $(this);
            var link = $(ev.relatedTarget);
            var id = link.data('content');
            modal.find('.modal-body').load('/dashboard/deletePlane/' + id);
    });
    $('#editRoute').on('show.bs.modal', function(ev) {
        var modal = $(this);
        var link = $(ev.relatedTarget);
        var id = link.data('content');
        modal.find('.modal-body').load('/dashboard/editRoute/' + id);
    });
    $('#delRoute').on('show.bs.modal', function(ev) {
            var modal = $(this);
            var link = $(ev.relatedTarget);
            var id = link.data('content');
            modal.find('.modal-body').load('/dashboard/deleteRoute/' + id);
    });
  </script>
<script src="{{URL::asset('/assets/js/datatables.js')}}" charset="utf-8"></script>
@endsection 
