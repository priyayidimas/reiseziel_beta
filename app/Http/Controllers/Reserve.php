<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Auth;
use Redirect;
use DB;
use Session;
use Carbon\Carbon;
use URL;
use Excel;

class Reserve extends Controller
{
    public function strand($length = 8) {
        return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    public function searchTrans()
    {
        if (!Session::has('passenger')) {
            $from = Input::get('from');
            $to = Input::get('to');
            $depart = Input::get('depart');
            $ret = Input::get('return');
            $passenger = Input::get('passenger');
            $type = Input::get('type');

            $input = array(
                'type' => $type,
                'from' => $from,
                'to' => $to,
                'depart' => $depart,
                'ret' => $ret
            );

            $query = "SELECT type.id AS idtype,transportation.id AS idtrans,transportation.*,rute.*,rute.id AS idrute  
                    FROM type,transportation,rute WHERE type.id = '$type' AND transportation.type_id = type.id AND rute.transportation_id = 
                    transportation.id AND (rute.rute_from = '$from' AND rute.rute_to = '$to' AND rute.depart_at LIKE '$depart%')";
            $data = DB::select($query);

            session()->put('passenger', $passenger);
            return view('book.searchTrans', ['data' => $data, 'input' => $input]);
        } else {
            return Redirect::to('/');
        }
        
        
    }

    public function prebook()
    {   
        if (Session::has('passenger')) {
            $id = Input::get('rute_id');
            $type = Input::get('type');
            $rute = DB::table('rute')->where('id','=',$id)->first();
            $trans = DB::table('transportation')->where('id','=',$rute->transportation_id)->first();

            $avail = $trans->seat_avail;
            if (Session::get('passenger') > $avail) {
                return Redirect::to('/')->with(['color' => 'red', 'msg' => 'There are no more seat on transportation']);
            } else {
                return view('book.prebook', ['rute' => $rute, 'trans' => $trans,'type' => $type]);
            }

        }else {
            return Redirect::to('/');
        }     
        

    }
    public function fillContact()
    {   
        if (Session::has('passenger')) {
            $type = Input::get('type');
            $rute_id = Input::get('rute_id');
            $rute = DB::table('rute')->where('id','=',$rute_id)->first();
            return view('book.fillContact', ['rute' => $rute, 'type' => $type]);
        } else {
            return Redirect::to('/');
        }
        

    }
    public function payment()
    {   
    if (Session::has('passenger')) {
        if (Session::has('booking')) {
            return Redirect::to('/');
        } else {
            session()->put('booking', 'yes');
            $rute_id = Input::get('rute_id');
            $rute = DB::table('rute')->where('id','=',$rute_id)->first();
            $cus = DB::table('customer')->where('email','=',Input::get('email'))->where('name','=',Input::get('fullname'));
            if (!Auth::check()) {
                if ($cus->count() < 1) {
                    $dataContact = array(
                        "gender" => Input::get('gender'),
                        "name" => Input::get('fullname'),
                        "email" => Input::get('email'),
                        "phone" => Input::get('phone'),
                        "address" => Input::get('address')
                    );
                    DB::table('customer')->insert($dataContact);
                }
            }

            $code = Reserve::strand();
            $dataReserve = array(
                'reservation_code' => $code,
                'reservation_date' => Carbon::now(8),
                'rute_id' => $rute_id,
                'contact_id' => $cus->first()->id
            );
            DB::table('reservation')->insert($dataReserve);
            
            $reserve_id = DB::table('reservation')->where('reservation_code','=',$code)->first()->id;
            $price = $rute->price;
            if (Auth::check()) {
                $price = $rute->price - (0.15*$rute->price);
            }
            for ($i=1; $i <= Session::get('passenger'); $i++) { 

                $cust = DB::table('customer')->where('email','=',Input::get('email'.$i))->where('name','=',Input::get('fullname'.$i));
                if ($cust->count() < 1) {
                    $dataPassenger = array(
                        "gender" => Input::get('gender'.$i),
                        "name" => Input::get('fullname'.$i),
                        "email" => Input::get('email'.$i),
                        "phone" => Input::get('phone'.$i),
                        "address" => Input::get('address'.$i)
                    );
                    DB::table('customer')->insert($dataPassenger);
                }

                $dataTicket = array(
                    "reservation_id" => $reserve_id,
                    "customer_id" => $cust->first()->id,
                    "seat_code" => Reserve::strand(2),
                    "price" => $price
                );
                
                DB::table('ticket')->insert($dataTicket);
            }
            $cTicket = DB::table('ticket')->where('reservation_id','=',$reserve_id)->count();
            $avail = DB::table('transportation')->where('id','=',$rute->transportation_id)->first()->seat_avail;
            $avail = $avail - $cTicket;

            DB::table('transportation')->where('id','=',$rute->transportation_id)->update(['seat_avail' => $avail]);

            return Redirect::to('/booking/payment/'.$code)->with('type',Input::get('type'));
        }
    } else {
        return Redirect::to('/');
    }
        // "<script>window.open('".URL::to('/booking/payment/'.$code)."', '_blank'</script>";
    }

    public function approve()
    {
       $id = Input::get('id');
       $code = DB::table('reservation')->where('id','=',$id)->first()->reservation_code;
       DB::table('reservation')->where('id','=',$id)->update(['payment_check' => 1 ]);
       return Redirect::to('dashboard/viewReservations')->with(['color' => 'green', 'msg' => 'A Reservation with Code '.$code.' Has Been Approved']);
    }
    public function delReserve()
    {
       $id = Input::get('id');
       $type = Input::get('type');
       $res = DB::table('reservation')->where('id','=',$id)->first();
       $code = $res->reservation_code;

       $cTicket = DB::table('ticket')->where('reservation_id','=',$id)->count();
       $rute = DB::table('rute')->where('id','=',$res->rute_id)->first();
       $avail = DB::table('transportation')->where('id','=',$rute->transportation_id)->first()->seat_avail;
       $avail = $avail + $cTicket;

       DB::table('transportation')->where('id','=',$rute->transportation_id)->update(['seat_avail' => $avail]);

       DB::table('reservation')->where('id','=',$id)->delete();
       return Redirect::to('dashboard/viewReservations')->with(['color' => 'green', 'msg' => 'A Reservation with Code '.$code.' Has Been '.$type]);
    }
    public function delReserveCode()
    {
       $code = Input::get('code');
       DB::table('reservation')->where('reservation_code','=',$code)->delete();
       return Redirect::to('/');
    }
    public function exportReserve()
    {
        if (Auth::check() && Auth::user()->level != '1') {
            return Excel::create('Reiseziel Reservations', function($excel) {
                $excel->sheet('Reservations', function($sheet)
                {
                    $sheet->loadview('admin.reservations.data-reservations');
                });
                })->download();
        }else{
            abort('404');
        }
    }
    public function exportReserveFil($year,$mon)
    {
        $mon = ($mon == '00') ? "%" : $mon ;
        if (Auth::check() && Auth::user()->level != '1') {
            return Excel::create('Reiseziel Reservations '.$year.'-'.$mon, function($excel) use ($year,$mon) {
                $excel->sheet('Reservations', function($sheet) use ($year,$mon)
                {
                    $sheet->loadview('admin.reservations.data-reservations')->with('year', $year)->with('mon', $mon);
                });
                })->download();
        }else{
            abort('404');
        }
    }

    public function retrieve()
    {
        $code = Input::get('res');
        $data = DB::table('reservation')->where('reservation_code','=',$code);
        if ($data->count() < 1) {
            $color = "red";
            $msg = "Your Reservation Code Is Invalid, Please Try Again";
            return Redirect::to('retrieveBooking')->with(['color' => $color, 'msg' => $msg]);
        }else {
            if($data->first()->payment_check == 0){
                $color = "red";
                $msg = "You Haven't Complete Your Payment, Please Finish Your Payment <a href='/completePayment/$code'> Here </a> ";
                return Redirect::to('retrieveBooking')->with(['color' => $color, 'msg' => $msg]);
            }else{
                $color = "green";
                $msg = "Your Payment Has Been Approved, Print Your Ticket Here !";
                return Redirect::to('printTicket/'.$code)->with(['color' => $color, 'msg' => $msg]);
            }

        }
    }

    public function filterReservations()
    {
        $year = Input::get('year');
        $mon = Input::get('mon');
        return Redirect::to('dashboard/viewReservations/'.$year.'/'.$mon);
    }

    public function addMessage()
    {
        $code = (Input::has('code')) ? Input::get('code')." - " : "" ;
        $sender = Input::get('sender');
        $subject = Input::get('subject');
        $content = $code." ".Input::get('content');
        $sender = Input::get('sender');

        $data = array(
            "sender" => $sender,
            "subject" => $subject,
            "content" => $content
        );

        DB::table('message')->insert($data);
        if (Input::has('code')) {
            return Redirect::to('printTicket/'.$code)->with(['color' => 'green', 'msg' => 'Your Report Has Been Sent']);
        }elseif(Auth::check()) {
            return Redirect::to('/dashboard')->with(['color' => 'green', 'msg' => 'Your Request Has Been Sent']);
        }else {
            return Redirect::to('/')->with([ 'msg' => 'HAHAHA']);
        }
    }

    public function deleteMessage()
    {
        $id = Input::get('id');
        DB::table('message')->where('id','=',$id)->delete();
        return Redirect::to('dashboard/viewMessages')->with(['color' => 'green', 'msg' => 'A Message Has Been Deleted']);
       
    }

    public function exportMessage()
    {
        if (Auth::check() && Auth::user()->level != '1') {
            return Excel::create('Reiseziel Message', function($excel) {
                $excel->sheet('Messages', function($sheet)
                {
                    $sheet->loadview('admin.messages.data-messages');
                });
                })->download();
        }else{
            abort('404');
        }
    }

    public function uploadPayment(Request $request)
    {
        $res_code = Input::get('code');
        $code = rand(0,100);
        $file = $request->file('file');
        $name = $file->getClientOriginalName();

        $filename = $code." - ".$name;

        $dest = "upload";
        $file->move($dest,$code." - ".$name);
        // Storage::disk('local')->put($name,$file);
        // $path = Storage::putFile($file);

        // $path = Storage::putFile('avatars', $request->file('avatar'));

        DB::table('reservation')->where('reservation_code','=',$res_code)->update(['payment_proof' => $filename]);

        return Redirect::to('/completePayment/'.$res_code)->with(['color' => 'green', 'msg' => 'Your Payment Check Has Been Uploaded! Please Wait Until Approved ']);;
    
    }


    public function deleteCustomer()
    {
        $id = Input::get('id');
        DB::table('customer')->where('id','=',$id)->delete();
        return Redirect::to('dashboard/viewCustomers')->with(['color' => 'green', 'msg' => 'A Customer Has Been Deleted']);
    }

    public function exportCustomer()
    {
        if (Auth::check() && Auth::user()->level != '1') {
            return Excel::create('Reiseziel Customer', function($excel) {
                $excel->sheet('Customers', function($sheet)
                {
                    $sheet->loadview('admin.customers.data-customers');
                });
                })->download();
        }else{
            abort('404');
        }
    }
}
