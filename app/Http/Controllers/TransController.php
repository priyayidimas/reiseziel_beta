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
use Excel;

class TransController extends Controller
{
    public function insertPlane()
    {
      $cek = DB::table('transportation')->where('code','=',Input::get('code'))->count();
      if ($cek > 0) {
          return Redirect::to('dashboard/viewPlanes')->with(['color' => 'red', 'msg' => 'Plane with code '.Input::get('code').' is already exists']);
      }
      $price = Input::get('price');
      if ($price < 0 ) {
        return Redirect::to('dashboard/viewPlanes')->with(['color' => 'red', 'msg' => 'You Cannot Add Price With negative']);
      }
        $dataTrans = array(
          'code' => Input::get('code'),
          'description' => Input::get('description'),
          'seat_qty' => Input::get('seat_qty'),
          'seat_avail' => Input::get('seat_qty'),
          'type_id' => '2'
        );
        DB::table('transportation')->insert($dataTrans);
        $trans_id = DB::table('transportation')->where('code','=',Input::get('code'))->first()->id;  
        $dataRute = array(
          'depart_at' => Input::get('depart_at'),
          'rute_from' => Input::get('rute_from'),
          'rute_to' => Input::get('rute_to'),
          'duration' => Input::get('duration'),
          'price' => $price,
          'transportation_id' => $trans_id
        );
        DB::table('rute')->insert($dataRute);
        return Redirect::to('dashboard/addPlane')->with(['color' => 'green', 'msg' => 'A Plane with Code '.Input::get('code').' has been Added']);
    }
    public function updatePlane()
    {
         $pid = Input::get('id');
         $plane = DB::table('transportation')->where('id','=',$pid)->first();
         $diff =  $plane->seat_avail - $plane->seat_qty;
         

         $dataTrans = array(
            'code' => Input::get('code'),
            'description' => Input::get('description'),
            'seat_qty' => Input::get('seat_qty'),
            'seat_avail' => Input::get('seat_qty') + $diff,
            'type_id' => '2'
          );
          DB::table('transportation')->where('id','=',$pid)->update($dataTrans);    
          return Redirect::to('dashboard/viewPlanes')->with(['color' => 'green', 'msg' => 'A Plane has been updated']);
    }
    public function updatePlaneRoute()
    {
          $rid = Input::get('id');
          $dataRute = array(
            'transportation_id' => Input::get('trans_id'),
            'depart_at' => Input::get('depart_at'),
            'rute_from' => Input::get('rute_from'),
            'rute_to' => Input::get('rute_to'),
            'duration' => Input::get('duration'),
            'price' => Input::get('price')
          );
          DB::table('rute')->where('id','=',$rid)->update($dataRute);  
          return Redirect::to('dashboard/viewPlanes')->with(['color' => 'green', 'msg' => 'A Plane Route has been updated']);
    }

    public function deletePlane()
    {
        $id = Input::get('id');
        DB::table('transportation')->where('id','=',$id)->delete();  
        return Redirect::to('dashboard/viewPlanes')->with(['color' => 'green', 'msg' => 'Sucessfully Deleted A Plane']);
    }

    public function insertTrain()
    {
        $cek = DB::table('transportation')->where('code','=',Input::get('code'))->count();
        if ($cek > 0) {
            return Redirect::to('dashboard/viewTrains')->with(['color' => 'red', 'msg' => 'Train with code '.Input::get('code').' is already exists']);
        }
          $dataTrans = array(
            'code' => Input::get('code'),
            'description' => Input::get('description'),
            'seat_qty' => Input::get('seat_qty'),
            'seat_avail' => Input::get('seat_qty'),
            'type_id' => '1'
          );
          DB::table('transportation')->insert($dataTrans);
          $trans_id = DB::table('transportation')->where('code','=',Input::get('code'))->first()->id;  
          $dataRute = array(
            'depart_at' => Input::get('depart_at'),
            'rute_from' => Input::get('rute_from'),
            'rute_to' => Input::get('rute_to'),
            'duration' => Input::get('duration'),
            'price' => Input::get('price'),
            'transportation_id' => $trans_id
          );
          DB::table('rute')->insert($dataRute);
          return Redirect::to('dashboard/viewTrains')->with(['color' => 'green', 'msg' => 'A Train with Code '.Input::get('code').' has been Added']);
    }
    public function updateTrain()
    {
         $pid = Input::get('id');
         $train = DB::table('transportation')->where('id','=',$pid)->first();
         $diff =  $train->seat_avail - $train->seat_qty;

         $dataTrans = array(
            'code' => Input::get('code'),
            'description' => Input::get('description'),
            'seat_qty' => Input::get('seat_qty'),
            'seat_avail' => Input::get('seat_qty') + $diff,
            'type_id' => '1'
          );
          DB::table('transportation')->where('id','=',$pid)->update($dataTrans);    
          return Redirect::to('dashboard/viewTrains')->with(['color' => 'green', 'msg' => 'A Train has been updated']);
    }
    public function updateTrainRoute()
    {
          $rid = Input::get('id');
          $dataRute = array(
            'transportation_id' => Input::get('trans_id'),
            'depart_at' => Input::get('depart_at'),
            'rute_from' => Input::get('rute_from'),
            'rute_to' => Input::get('rute_to'),
            'duration' => Input::get('duration'),
            'price' => Input::get('price')
          );
          DB::table('rute')->where('id','=',$rid)->update($dataRute);  
          return Redirect::to('dashboard/viewTrains')->with(['color' => 'green', 'msg' => 'A Train Route has been updated']);
    }
    public function deleteTrain()
    {
        $id = Input::get('id');
        DB::table('transportation')->where('id','=',$id)->delete();  
        return Redirect::to('dashboard/viewTrains')->with(['color' => 'green', 'msg' => 'Sucessfully Deleted A Train']);
    }
    public function deleteRoute()
    {
        $id = Input::get('id');
        DB::table('rute')->where('id','=',$id)->delete();  
        $type = DB::table('transportation')->where('id','=',Input::get('trans_id'))->first()->type_id;
          if ($type == 1) {
            return Redirect::to('dashboard/viewTrains')->with(['color' => 'green', 'msg' => 'Sucessfully Deleted A Route']);
          }else{
            return Redirect::to('dashboard/viewPlanes')->with(['color' => 'green', 'msg' => 'Sucessfully Deleted A Route']);
          }
    }

    public function insertRoute()
    {
        $code = DB::table('transportation')->where('id','=',Input::get('trans_id'))->first()->code;
        $price = Input::get('price');
        if ($price < 0 ) {
          return Redirect::to('dashboard/viewPlanes')->with(['color' => 'red', 'msg' => 'You Cannot Add Price With negative']);
        }
        $dataRute = array(
            'depart_at' => Input::get('depart_at'),
            'rute_from' => Input::get('rute_from'),
            'rute_to' => Input::get('rute_to'),
            'duration' => Input::get('duration'),
            'price' => $price,
            'transportation_id' => Input::get('trans_id')
          );
          DB::table('rute')->insert($dataRute);
          $type = DB::table('transportation')->where('id','=',Input::get('trans_id'))->first()->type_id;
          if ($type == 1) {
            return Redirect::to('dashboard/addTrainRoute')->with(['color' => 'green', 'msg' => 'A Route for Train Code '.$code.' has been Added']);
          }else{
            return Redirect::to('dashboard/addPlaneRoute')->with(['color' => 'green', 'msg' => 'A Route for Plane Code '.$code.' has been Added']);            
          }
    }

    public function exportPlane()
    {
      if (Auth::check() && Auth::user()->level != '1') {
        return Excel::create('Reiseziel Planes', function($excel) {
          $excel->sheet('Planes', function($sheet)
            {
              $sheet->loadview('admin.planes.data-planes');
            });
          })->download();
        }else{
          abort('404');
        }
    }
    public function exportTrain()
    {
      if (Auth::check() && Auth::user()->level != '1') {
        return Excel::create('Reiseziel Trains', function($excel) {
          $excel->sheet('Trains', function($sheet)
            {
              $sheet->loadview('admin.trains.data-trains');
            });
          })->download();
      }else{
        abort('404');
      }
  }
}
