
<form class="" action="{{URL::to('/deletePlane')}}" method="post">
    {!! csrf_field() !!}
    <div class="row">
        <p>Do you want to delete this plane ?</p>
        <input type="hidden" name="id" value="{{ $plane->id }}">
    </div>
    
    <button type="submit" class="btn red waves-effect waves-light">Yes</button>
    <button type="button" class="btn btn-flat" data-dismiss="modal">No</button>

</form>