@php
$res = DB::table('reservation')->where('id','=',$id)->first();
$rute = DB::table('rute')->where('id','=',$res->rute_id)->first();
$trans = DB::table('transportation')->where('id','=',$rute->transportation_id)->first();
$cus = DB::table('customer')->where('id','=',$res->contact_id)->first();

$duration = Carbon::parse($rute->duration)->format('H:i');
$durationArr = explode(':',$duration);

$data = DB::select("SELECT ticket.*,ticket.price AS tprice,reservation.*,customer.*,rute.* FROM `reservation`,ticket,rute,customer WHERE ticket.reservation_id = reservation.id AND ticket.customer_id = customer.id AND reservation.rute_id = rute.id AND reservation.id = '$id' ORDER BY payment_check ASC, reservation_date DESC");
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REISEZIEL E-TICKET</title>
    <style>
        <?php include('assets/css/materialize.css'); ?>
        <?php include('assets/css/gooicon.css'); ?>
        .bordered tr td {
            margin-top: 5px;
            padding-bottom: 5px;
        }
        .a tr td {
            margin-top: 2px;
            padding-bottom: 3px;
        }
    </style>
</head>
<body>
        <table style="background: #2196F3">
                <tr>
                <td style="width: 40px"><img src="assets/images/logo.gif" height="40" width="40" alt=""></td>
                <td style="color:#FFF"><h4>REISEZIEL E-TICKET</h4></td>
                </tr>
                </table>
              <br><br>
              <h5>A. {{$tipe = ($trans->type_id == 1) ? "Trip" : "Flight" }} Details</h5>
              <table class="a" style="border: 1px solid #2196F3">
                  <tr><td style="width: 50%">
                    <table>
                        <tr>
                            <td>RESERVATION CODE</td>
                            <td>:</td>
                            <td>{{$res->reservation_code}}</td>
                        </tr>
                        <tr>
                            <td>BOOKED BY</td>
                            <td>:</td>
                            <td>{{$cus->name}}</td>
                        </tr>
                        <tr>
                            <td>CONTACT EMAIL</td>
                            <td>:</td>
                            <td>{{$cus->email}}</td>
                        </tr>
                        <tr>
                            <td>CONTACT PHONE</td>
                            <td>:</td>
                            <td>{{$cus->phone}}</td>
                        </tr>
                        
                    </table></td>
                <td style="width:50%"><table>
                            <tr>
                                <td>RESERVATION DATE</td>
                                <td>:</td>
                                <td>{{$res->reservation_date}}</td>
                            </tr>
                            <tr>
                                <td>TRANSPORTATION NAME</td>
                                <td>:</td>
                                <td>{{$trans->code}} - {{$trans->description}}</td>
                            </tr>
                            <tr>
                                <td>ROUTE</td>
                                <td>:</td>
                                <td>{{$rute->rute_from}} to {{$rute->rute_to}}</td>
                            </tr>
                            <tr>
                                <td>DEPARTURE</td>
                                <td>:</td>
                                <td>{{Carbon::parse($rute->depart_at)->format('d/m/Y H:i')}} - {{Carbon::parse($rute->depart_at)->addHour($durationArr[0])->addMinute($durationArr[1])->format('H:i')}}</td>
                            </tr>    
                    </table>   
                </td></tr>
              </table>
              <br><h5>B. Passenger Details</h5>
              <table class="bordered">
                <thead>
                  <tr style="background-color: #2196F3; color:#FFF ">
                      <th>NO</th>
                      <th>SEAT CODE</th>
                      <TH>TITLE</TH>
                      <TH>NAME</TH>
                      <TH>EMAIL</TH>
                      <TH>PRICE</TH>
                  </tr>
                </thead>
              
                <tbody>
                  @php
                    $n = 1;
                    $total = 0;
                  @endphp
                  @foreach ($data as $row)
                      @php
                          $contact = DB::table('customer')->where('id','=',$row->contact_id)->first();
                          $trans = DB::table('transportation')->where('id','=',$row->transportation_id)->first();
                      @endphp
                    <tr>
                      <td>{{$n++}}</td>
                      <td>{{$row->seat_code}}</td>
                      <td>{{$row->gender}}</td>
                      <td>{{$row->name}}</td>
                      <td>{{$row->email}}</td>
                      <td style="text-align:right">Rp. {{number_format($row->tprice,2,',','.')}}</td>
                    </tr>
                    @php
                        $total = $total + $row->tprice;
                    @endphp
                  @endforeach
                       <tr>
                          <td colspan="4"></td>
                          <td style="background: #2196F3;color:#FFF">TOTAL PRICE</td>
                          <td style="text-align:right;background: #2196F3;color:#FFF">Rp. {{number_format($total,2,',','.')}}</td>
                        </tr>
                </tbody>
              </table>
              </div>
              
</body>
</html>
  