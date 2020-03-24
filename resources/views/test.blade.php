@if (isset($a))
    {{$a}} <br>
    {{$b}} <br>
@endif

@php
$ca1 = Carbon::parse($a);
$ca2 = Carbon::parse($b)->format('H:i');
$ca = explode(':',$ca2);
@endphp
{{$ca1}} <br>
{{$ca2}} <br><br>
{{$ca[0]}} <br>
{{$ca[1]}} <br><br>
{{$ca1->addHour($ca[0])->addMinute($ca[1])}}
