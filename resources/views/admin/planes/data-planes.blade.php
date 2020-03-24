@php
$data = DB::select("SELECT transportation.type_id,transportation.*,transportation.code,rute.* FROM transportation,rute WHERE rute.transportation_id = transportation.id AND transportation.type_id = 2");
@endphp
<style media="screen">
  tr td{
    border: 1px solid #000000;
  }
</style>
  <table>
  <tr>
  <td colspan="10" align="center"><h2>REISEZIEL PLANES</h2></td>
  </tr>
  </table>
<table class="bordered data">
  <thead>
    <tr style="background-color: #4CAF50; color:#FFFFFF ">
        <th>NO</th>
        <th>PLANE CODE</th>
        <th>NAME</th>
        <th>SEAT QTY</th>
        <th>DEPART FROM</th>
        <TH>DESTINATION</TH>
        <TH>DEPART AT</TH>
        <TH>DURATION</TH>
        <TH>ETA</TH>
        <TH>PRICE</TH>
    </tr>
  </thead>

  <tbody>
    @php
      $n = 1
    @endphp
    @foreach ($data as $row)
    @php
        $duration = Carbon::parse($row->duration)->format('H:i');
        $durationArr = explode(':',$duration);
    @endphp                          
      <tr>
        <td>{{$n++}}</td>
        <td>{{$row->code}}</td>
        <td>{{$row->description}}</td>
        <td>{{$row->seat_qty}}</td>
        <td>{{$row->rute_from}}</td>
        <td>{{$row->rute_to}}</td>
        <td>{{Carbon::parse($row->depart_at)->format('d/m/Y H:i')}}</td>
        <td>{{$row->duration}}</td>
        <td>{{Carbon::parse($row->depart_at)->addHour($durationArr[0])->addMinute($durationArr[1])->format('d/m/Y H:i')}}</td>
        <td>{{$row->price}}</td>
      </tr>
    @endforeach
  </tbody>
</table>
</div>
