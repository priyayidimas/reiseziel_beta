
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
                  <a class="breadcrumb">Retrieve Booking </a>
                  <a class="breadcrumb">Print Your Ticket </a>
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
                          <p>{!!Session::get('msg')!!}</p>
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
                <div class="card white darken-1">
                    <div class="card-content">
                        <span class="card-title">Print Ticket</span><br><br>
                        <div class="row">
                            <div class="col s12 m4 center">
                                <button class="btn amber waves-effect" data-toggle="modal" data-target='#lostTicket' 
                                @if ($data->printed == 0) {{"disabled"}} @endif
                                >I Lost My Ticket</button>
                            </div>
                            <div class="col s12 m4 center">
                                <button class="btn red waves-effect" data-toggle="modal" data-target='#refund' 
                                @if ($data->printed == 1) {{"disabled"}} @endif
                                >Ask For Refund</button>
                            </div>
                            <div class="col s12 m4 center">
                                <button class="btn green waves-effect" data-toggle="modal" data-target='#print' 
                                @if ($data->printed == 1) {{"disabled"}} @endif
                                >Print My Ticket</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        <div class="modal fade" id="lostTicket">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title">Send A Report</h5>
                    </div>
                    <div class="modal-body">
                            <form class="" action="{{URL::to('/addMessage')}}" method="post">
                                {!! csrf_field() !!}
                                <input type="hidden" name="subject" value="Lost Ticket">
                                <input type="hidden" name="code" value="{{$data->reservation_code}}">
                                <div class="row">
                                        <div class="input-field col s12 m12">
                                            <input id="sender" name="sender" type="text" class="validate" required>
                                            <label for="sender">From</label>
                                        </div>
                                        <div class="input-field col s12 m12">
                                            <textarea name="content" id="" cols="30" rows="10" class="materialize-textarea"></textarea>
                                            <label for="content">Reason</label>
                                        </div>
                                </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="print">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title">Confirmation</h5>
                    </div>
                    <div class="modal-body">
                        Are You Sure Want To Print Your Ticket Now ? You Can Only Print Once At The Time 
                    </div>
                    <div class="modal-footer">
                        <form action="{{URL::to('/ticket')}}" method="post">
                            {!! csrf_field() !!}
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <button type="button" class="btn red" data-dismiss="modal">No</button>
                            <button type="submit" class="btn green">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="refund">
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
                            <input type="hidden" name="subject" value="ASK REFUND">
                            <input type="hidden" name="sender" value="{{$user = (Auth::check()) ? Auth::user()->fullname : "UNKNOWN CUSTOMER" }}">
                            <input type="hidden" name="content" value="{{$data->reservation_code}}">
                            <button type="button" class="btn red" data-dismiss="modal">No</button>
                            <button type="submit" class="btn green">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        


@endsection
@section('script')
<script src="{{URL::asset('/assets/js/datatables.js')}}" charset="utf-8"></script>
@endsection 


