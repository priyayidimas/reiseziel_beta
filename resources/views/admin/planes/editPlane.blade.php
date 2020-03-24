
<script>
    Materialize.updateTextFields();
</script>
<form class="" action="{{URL::to('/updatePlane')}}" method="post">
    {!! csrf_field() !!}
    <input type="hidden" name="id" value="{{$plane->id}}">
    <div class="row">
        <div class="input-field col s12">
            <input name="code" type="text" class="validate" required value="{{$plane->code}}">
            <label for="code">Plane Code</label>
        </div>
        <div class="input-field col s12">
            <input id="description" name="description" type="text" class="validate" required value="{{$plane->description}}">
            <label for="description">Description</label>
        </div>
        <div class="input-field col s12">
                <input id="seat_qty" name="seat_qty" type="number" class="validate" required value="{{$plane->seat_qty}}">
                <label for="seat_qty">Seat Quantity</label>
        </div>
    </div>
   
            
{{--  <div class="divider"></div>  --}}
<button type="button" class="btn btn-flat" data-dismiss="modal">Close</button>
<button type="submit" class="btn green waves-effect waves-light">Submit<i class="material-icons right">send</i></button>
</form>

<script src="{{url('/assets/js/autocomplete.js')}}"></script>
