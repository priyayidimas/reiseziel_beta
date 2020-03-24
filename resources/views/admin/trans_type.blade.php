@php
    $data = DB::table('type')->get();
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
} );
</script>
@endsection

@section('content')
@include('admin.nav')
      <div class="row">
          <div class="col s12">
            <div class="card-panel white z-depth-3">
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
              <a href="{{URL::to('/export')}}" class="btn green waves-effect btn-small"><i class="material-icons left">save</i>Export Excel</a>
              <a href="#!" class="btn waves-effect btn-small" data-toggle="modal" data-target="#addModal"><i class="material-icons left">add</i>Insert News</a>
              <a href="#!" class="btn-flat waves-effect btn-small" data-toggle="modal" data-target="#newsModal"><i class="material-icons left">assignment</i>Check News</a>
              <br>
              <h5 class="center">Transportation Type</h5>
              <div class="divider">  </div>
              @if (isset($data))
              <table class="bordered data display" id="table_id">
                <thead>
                  <tr style="center">
                    <th style="width: 50px">NO</th>
                    <th>DESCRIPTION</th>
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
                      <td>{{$row->description}}</td>
                      <td style="width: 50px">
                          <button class="col s6 m6 l6 btn btn-small yellow darken-2 waves-effect waves-light" onclick="location.href= '{{URL::to('/edit/'.$row->id)}}'"><i class="material-icons">edit</i></button>
                          <button class="col s6 m6 l6 btn btn-small red darken-2 waves-effect waves-light" onclick="delfunc()"><i class="material-icons">delete</i></button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              @endif
            </div>
          </div>
        </div>
      </div> 


    <!-- Modal -->
    <div id="addModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h5 class="modal-title">Add Some New News</h5>
          </div>
          <div class="modal-body row">
            <form class="" action="{{URL::to('/insert')}}" method="post">
              {!! csrf_field() !!}
              <div class="input-field col s6">
                <input id="icon_prefix" type="text" class="validate" name="header" required>
                <label for="icon_prefix">Header</label>
              </div>
              <div class="input-field col s4">
                <input id="datepicker" type="text" class="validate" name="uidate" required>
                <label for="icon_prefix">Date</label>
              </div>
              <div class="input-field col s6">
                <input id="icon_prefix" type="text" class="validate" name="media" required>
                <label for="icon_prefix">Media</label>
              </div>
              <div class="input-field col s4">
                <input id="alt" type="hidden" name="date">
              </div>
              <div class="input-field col s12">
                <input id="icon_prefix" type="text" class="validate" name="link" required>
                <label for="icon_prefix">Link</label>
              </div>
              <div class="input-field col s4">
                <select name="val">
                  <option disabled selected>Value</option>
                  <option>POSITIVE</option>
                  <option>NEGATIVE</option>
                  </select>
              </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn green waves-effect waves-light">Submit<i class="material-icons right">send</i></button>&nbsp;
            <button type="reset" class="btn btn-flat">Reset</button>
          </div>
         </form>
        </div>

      </div>
    </div>

@endsection
@section('script')
  <script type="text/javascript">
  @if (isset($row)) {
    function delfunc(){
      var r = confirm("Are You Sure To Delete This Record?");
      if (r == true) {
      window.location.href = "{{URL::to('/delete/'.$row->id)}}";
      }
    }
  }
  @endif
  </script>
<script src="{{URL::asset('/assets/js/datatables.js')}}" charset="utf-8"></script>
@endsection 
