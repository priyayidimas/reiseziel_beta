@php
    $data = DB::table('users')->get();
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
  $( "#datepicker" ).datepicker({
    altField: '#alt',
    altFormat: 'yy-mm-dd'
  });
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
                  <a href="#!" class="breadcrumb">Users</a>
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
                            <a href="#!" class="btn waves-effect btn-small" data-toggle="modal" data-target="#addUser"><i class="material-icons left">add</i>Add New Administrator</a>
                            
                            <br>
                            <h5 class="center">Users List</h5>
                            <div class="divider">  </div>
                            @if (isset($data))
                            <table class="bordered data display" id="table_id">
                              <thead>
                                <tr style="center">
                                  <th>NO</th>
                                  <th>FULLNAME</th>
                                  <th>EMAIL</th>
                                  <th>LEVEL</th>
                                  <th>ACTION</th>
                                </tr>
                              </thead>
              
                              <tbody>
                                @php
                                  $n = 1
                                @endphp
                               @foreach ($data as $row)
                               @php
                                   $role = ($row->level == 3) ? "Administrator" : "User" ;
                               @endphp
                                  <tr>
                                    <td>{{$n++}}</td>
                                    <td>{{$row->fullname}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{$role}}</td>
                                    <td style="width: 50px">
                                        <button class="col s6 m6 l6 btn btn-small yellow darken-2 waves-effect waves-light" data-toggle="modal" data-target="#editUser" data-content="{{Crypt::encryptString($row->id)}}"><i class="material-icons">edit</i></button>
                                        <button class="col s6 m6 l6 btn btn-small red darken-2 waves-effect waves-light" data-toggle="modal" data-target="#delUser" data-content="{{Crypt::encryptString($row->id)}}"><i class="material-icons">delete</i></button>
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
    <div id="addUser" class="modal fade" role="dialog">
            <div class="modal-dialog">
      
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h5 class="modal-title">Add Administrator</h5>
                </div>
                <div class="modal-body row">
                  <form class="" action="{{URL::to('/insertUser')}}" method="post">
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="fullname" name="fullname" type="text" class="validate" required>
                            <label for="fullname">Full Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" name="email" type="text" class="validate" required>
                            <label for="email">Email</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <input id="password" name="password" type="password" class="validate" required>
                            <label for="password">Password</label>
                        </div>
                        <div class="input-field col s6">
                                <input id="password" name="cpassword" type="password" class="validate" required>
                                <label for="password">Confirm Password</label>
                        </div>
                    </div>
      
                </div>
                <div class="modal-footer">
                  <button type="reset" class="btn btn-flat">Reset</button>
                  <button type="submit" class="btn green waves-effect waves-light">Submit<i class="material-icons right">send</i></button>
                </div>
               </form>
              </div>
      
            </div>
    </div>
    
    <div class="nothing-just-modal">
      <div id="editUser" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h5 class="modal-title">Edit User</h5>
            </div>
            <div class="modal-body">
    
            </div>
          </div>
        </div>
      </div>

      <div id="delUser" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Delete User</h5>
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
    $('#editUser').on('show.bs.modal', function(ev) {
        var modal = $(this);
        var link = $(ev.relatedTarget);
        var id = link.data('content');
        modal.find('.modal-body').load('/dashboard/editUser/' + id);
    });
    $('#delUser').on('show.bs.modal', function(ev) {
            var modal = $(this);
            var link = $(ev.relatedTarget);
            var id = link.data('content');
            modal.find('.modal-body').load('/dashboard/deleteUser/' + id);
    });
  </script>
<script src="{{URL::asset('/assets/js/datatables.js')}}" charset="utf-8"></script>
@endsection 
