@php
    $data = DB::table('customer')->get();
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
$( function() {
  $('#table_id').DataTable({
        paging : false
    });
} );


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
                  <a href="#!" class="breadcrumb">Customer</a>
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
                            <a href="{{URL::to('/dashboard/exportCustomer')}}" class="btn waves-effect btn-small"><i class="material-icons left">save</i>Export Excel </a>
                            
                            <br>
                            <h5 class="center">Customer List</h5>
                            <div class="divider">  </div>
                            @if (isset($data))
                            <table class="bordered data display" id="table_id">
                              <thead>
                                <tr style="center">
                                  <th>NO</th>
                                  <th>TITLE</th>
                                  <th>FULLNAME</th>
                                  <th>EMAIL</th>
                                  <th>ADDRESS</th>
                                  <th>PHONE</th>
                                  <th>CREATED AT</th>
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
                                    <td>{{$row->gender}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{$row->address}}</td>
                                    <td>{{$row->phone}}</td>
                                    <td>{{$row->created_at}}</td>
                                    <td style="width: 50px">
                                        <button class="col s6 m6 l6 btn btn-small red darken-2 waves-effect waves-light" data-toggle="modal" data-target="#delCustomer" data-content="{{Crypt::encryptString($row->id)}}"><i class="material-icons">delete</i></button>
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                            @endif
                    </div>
            </div>
        </div>
        <!-- Modal -->

    <div class="nothing-just-modal">


      <div id="delCustomer" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Delete Customer</h5>
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

    $('#delCustomer').on('show.bs.modal', function(ev) {
            var modal = $(this);
            var link = $(ev.relatedTarget);
            var id = link.data('content');
            modal.find('.modal-body').load('/dashboard/deleteCustomer/' + id);
    });
  </script>
<script src="{{URL::asset('/assets/js/datatables.js')}}" charset="utf-8"></script>
@endsection 
