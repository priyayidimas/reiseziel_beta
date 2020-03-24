@php
    $plane = DB::table('transportation')->where('type_id','=','2')->get();
@endphp
<script>
$( function(){
  $('#datetime').flatpickr({
    enableTime: true,
    altInput: true,
    altFormat: "d/m/Y H:i:S",
    dateFormat: "Y-m-d H:i:S",
    // minDate: "today",
    time_24hr: true
  });
  $('#time').flatpickr({
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    time_24hr: true
  });
});
var code = '{{$route->transportation_id}}';
$(document).ready(function () {
    $('#code').val(code);
});
</script>
<script>
    Materialize.updateTextFields();
</script>
<form class="" action="{{URL::to('/')}}" method="post">
    {!! csrf_field() !!}
    <div class="row">
            <div class="col s6">
                    <label>Plane Code</label>
                    <select class="browser-default" id="code" name="trans_id">
                            <option value="" disabled selected>Choose Plane Code</option>
                        @foreach ($plane as $data)
                            <option value="{{$data->id}}">{{$data->code." - ".$data->description}}</option>
                        @endforeach
                    </select>
            </div>                                     
    </div>
    <div class="row">
        <div class="row">
                <div class="input-field col s12">
                    <input id="rute_from" name="rute_from" type="text" class="validate" required value="{{$route->rute_from}}">
                    <label for="rute_from">Depart From</label>
                </div>
                <div class="input-field col s12">
                    <input id="rute_to" name="rute_to" type="text" class="validate" required value="{{$route->rute_to}}">
                    <label for="rute_to">Destination</label>
                </div>
                <div class="input-field col s12">
                    <input id="datetime" name="depart_at" type="text" class="validate" required value="{{$route->depart_at}}">
                    <label for="depart_at">Depart At</label>
                </div>
                <div class="input-field col s12">
                    <input id="time" name="duration" type="text" class="validate" required value="{{$route->duration}}">
                    <label for="duration">Flight Duration</label>
                </div>
                <div class="input-field col s12">
                    <input id="price" name="price" type="text" class="validate" required value="{{$route->price}}">
                    <label for="price">Price (Rp.)</label>
                </div>
            </div>

   
            
{{--  <div class="divider"></div>  --}}
<button type="reset" class="btn btn-flat">Reset</button>
<button type="submit" class="btn green waves-effect waves-light">Submit<i class="material-icons right">send</i></button>
</form>

<script src="{{url('/assets/js/autocomplete.js')}}"></script>
