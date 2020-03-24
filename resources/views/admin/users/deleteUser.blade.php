
<form class="" action="{{URL::to('/deleteUser')}}" method="post">
    {!! csrf_field() !!}
    <div class="row">
        <p>Are you sure want to delete this user with email {{$data->email}} ?</p>
        <input type="hidden" name="id" value="{{ $data->id }}">
    </div>
    
    <button type="submit" class="btn red waves-effect waves-light">Yes</button>
    <button type="button" class="btn btn-flat" data-dismiss="modal">No</button>

</form>