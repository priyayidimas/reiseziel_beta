
<form class="" action="{{URL::to('/deleteTrain')}}" method="post">
    {!! csrf_field() !!}
    <div class="row">
        <p>Are you sure want to delete this train with code {{$train->code}} - {{$train->description}} ?</p>
        <input type="hidden" name="id" value="{{ $train->id }}">
    </div>
    
    <button type="submit" class="btn red waves-effect waves-light">Yes</button>
    <button type="button" class="btn btn-flat" data-dismiss="modal">No</button>

</form>