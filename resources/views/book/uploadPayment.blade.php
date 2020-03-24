
@extends('t_index')
@section('title')
Upload Payment Proof
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
    #card-alert a {
        color: #FFF;
        text-decoration: underline;
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
                  <a class="breadcrumb"> Payment Proof </a>
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
                        <div id="plane" class="tab-content">
                            <div class="card white">
                                <div class="card-content">
                        
                                    <form class="" action="{{URL::to('/uploadPayment')}}" method="post" enctype="multipart/form-data">
                                        {!! csrf_field() !!}
                                            <input type="hidden" name="code" value="{{$reservation->reservation_code}}">
                                            <div class="row">
                                                <h5></h5><br><br>
                                                    <div class="file-field input-field col s8">
                                                        <div class="">
                                                            <span>Upload Proof</span>
                                                            <input type="file" name="file">
                                                        </div>
                                                        <div class="file-path-wrapper">
                                                            <input class="file-path validate" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col s12 m12 right-align">
                                                        <button type="submit" class="btn waves-effect blue" style="margin-top: 30px;">Continue</button>
                                                    </div>
                                                </div>
                                        </form>
                                </div>

                            </div>
                        </div>
           </div>
        </div>
        


@endsection
@section('script')
<script src="{{URL::asset('/assets/js/datatables.js')}}" charset="utf-8"></script>
@endsection 


