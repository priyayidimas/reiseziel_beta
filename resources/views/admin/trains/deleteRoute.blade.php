@php
    $train = DB::table('transportation')->where('id','=',$route->transportation_id)->first();
@endphp
<form class="" action="{{URL::to('/deleteRoute')}}" method="post">
    {!! csrf_field() !!}
    <input type="hidden" name="trans_id" value="{{$train->id}}">
    <div class="row">
        <p>Do you want to delete this Route For Train {{$train->code}} - {{$train->description}} ?</p>
        <input type="hidden" name="id" value="{{ $route->id }}">
    </div>
    
    <button type="submit" class="btn red waves-effect waves-light">Yes</button>
    <button type="button" class="btn btn-flat" data-dismiss="modal">No</button>

</form>