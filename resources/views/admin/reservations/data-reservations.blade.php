@php
if (isset($year)) {
  $data = DB::select("SELECT ticket.*,ticket.price AS tprice,reservation.*,customer.*,rute.* FROM `reservation`,ticket,rute,customer WHERE ticket.reservation_id = reservation.id AND ticket.customer_id = customer.id AND reservation.rute_id = rute.id AND reservation.reservation_date LIKE '$year-$mon-%' ORDER BY payment_check ASC, reservation_date DESC");
}else {
  $data = DB::select("SELECT ticket.*,ticket.price AS tprice,reservation.*,customer.*,rute.* FROM `reservation`,ticket,rute,customer WHERE ticket.reservation_id = reservation.id AND ticket.customer_id = customer.id AND reservation.rute_id = rute.id ORDER BY payment_check ASC, reservation_date DESC");
}
@endphp
<style media="screen">
  tr td{
    border: 1px solid #000000;
  }
</style>
  <table>
  <tr>
  <td colspan="10" align="center"><h2>REISEZIEL RESERVATIONS</h2></td>
  </tr>
  </table>
<table class="bordered data">
  <thead>
    <tr style="background-color: #ffc107; color:#111 ">
        <th>NO</th>
        <th>RESERVATION CODE</th>
        <th>RESERVATION DATE</th>
        <th>PAYMENT STATUS</th>
        <th>CONTACT NAME</th>
        <th>CONTACT EMAIL</th>
        <th>CONTACT PHONE</th>
        <th>SEAT CODE</th>
        <TH>TITLE</TH>
        <TH>PASSENGER NAME</TH>
        <TH>PASSENGER EMAIL</TH>
        <TH>TRANSPORTATION</TH>
        <TH>TYPE</TH>
        <TH>ORIGIN</TH>
        <TH>DESTINATION</TH>
        <TH>DEPART AT</TH>
        <TH>PRICE</TH>
    </tr>
  </thead>

  <tbody>
    @php
      $n = 1
    @endphp
    @foreach ($data as $row)
        @php
            $contact = DB::table('customer')->where('id','=',$row->contact_id)->first();
            $trans = DB::table('transportation')->where('id','=',$row->transportation_id)->first();
        @endphp
      <tr>
        <td>{{$n++}}</td>
        <td>{{$row->reservation_code}}</td>
        <td>{{$row->reservation_date}}</td>
        <td>{{$status = ($row->payment_check) ? "APPROVED" : "NOT APPROVED" }}</td>
        <td>{{$contact->name }}</td>
        <td>{{$contact->email }}</td>
        <td>{{$contact->phone }}</td>
        <td>{{$row->seat_code}}</td>
        <td>{{$row->gender}}</td>
        <td>{{$row->name}}</td>
        <td>{{$row->email}}</td>
        <td>{{$trans->code}} - {{$trans->description}}</td>
        <td>{{$type = ($trans->type_id == "1") ? "TRAIN" : "PLANE" }}</td>
        <td>{{$row->rute_from}}</td>
        <td>{{$row->rute_to}}</td>
        <td>{{Carbon::parse($row->depart_at)->format('d/m/Y H:i')}}</td>
        <td style="text-align:right">Rp. {{number_format($row->tprice,2,',','.')}}</td>
      </tr>
    @endforeach
  </tbody>
</table>
</div>
