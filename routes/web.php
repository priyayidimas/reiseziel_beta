<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    session()->forget('passenger');
    session()->forget('booking');
    return view('welcome');
});
Route::get('login',function()
{
    session()->forget('passenger');
    session()->forget('booking');
    return view('login'); 
});
Route::get('forgotPass',function()
{
    session()->forget('passenger');
    session()->forget('booking');
    return view('forgotPass'); 
});
Route::get('register',function()
{
    session()->forget('passenger');
    session()->forget('booking');
    return view('register'); 
});
Route::get('retrieveBooking',function()
{
    session()->forget('passenger');
    session()->forget('booking');
    return view('book.retrieve'); 
});

Route::post('retrieveBook', 'Reserve@retrieve');
Route::get('printTicket/{code}',function($code)
{
    $data = DB::table("reservation")->where('reservation_code','=',$code);
    if ($data->count() < 1) {
        abort('404');
    }else {
        if ($data->first()->payment_check == 0) {
            abort('404');
        }else {
            $reserve = $data->first();
            $data->update(['printed' => 1]);
            return view('book.print', ['data' => $reserve]); 
        }
    }
});
//Admin Messages
Route::post('addMessage', 'Reserve@addMessage');
Route::post('deleteMessage', 'Reserve@deleteMessage');
Route::get('dashboard/viewMessages', function () {
    if (Auth::check()) {
        if (Auth::user()->level == '1') {
            abort('404');
        } else {
            return view('admin.messages.viewMessage'); 
        }
    } else {
        return redirect('/');
    }
});
Route::get('dashboard/detailMessage/{id}', function ($id) {
    if (Auth::check() && Auth::user()->level != '1') {
        // $did = Crypt::decryptString($id);
        $data = DB::table('message')->where('id','=',$id)->first();
        return view('admin.messages.detailMessage',['message' => $data]);
    }else {
        abort('404');
    }
});
Route::get('dashboard/exportMessage', 'Reserve@exportMessage');


Route::get('/logout','UserController@logout');

Route::post('actlogin', 'UserController@login');
Route::post('actForgotPass', 'UserController@forgotPass');
Route::post('actregister', 'UserController@register');
Route::get('dashboard', function () {
    if (Auth::check()) {
        if (Auth::user()->level == '1') {
            return view('user.home');
        } else {
            return view('admin.home'); 
        }
    } else {
        return redirect('/');
    }
});


//Dashboard Customers
Route::get('dashboard/viewCustomers', function () {
    if (Auth::check()) {
        if (Auth::user()->level == '1') {
            return view('user.customers.viewCustomer');
        } else {
            return view('admin.customers.viewCustomer'); 
        }
    } else {
        return redirect('/');
    }
});
//user customer
Route::post('insertCustomer', 'UserController@insertCustomer');
Route::post('updateCustomer/{id}', 'UserController@updateCustomer');
Route::post('updateUserCus/{id}', 'UserController@updateUserCus');
Route::get('deleteCustomer/{id}', 'UserController@deleteCustomer');

//user reservation
Route::get('dashboard/viewReservations', function () {
    if (Auth::check()) {
        if (Auth::user()->level == '1') {
            return view('user.reservations.viewReservation');
        } else {
            return view('admin.reservations.viewReservation'); 
        }
    } else {
        return redirect('/');
    }
});
Route::post('dashboard/filterReservations', 'Reserve@filterReservations');
Route::get('dashboard/viewReservations/{year}/{mon}', function ($year,$mon) {
    if (Auth::check()) {
        if (Auth::user()->level == '1') {
            abort('404');
        } else {
            $mon = ($mon == '00') ? "%" : $mon ;
            return view('admin.reservations.viewReservation',['fil_year' => $year,'fil_mon' => $mon]); 
        }
    } else {
        return redirect('/');
    }
});


// Admin Dashboard User
Route::get('dashboard/viewUsers', function () {
    if (Auth::check() && Auth::user()->level != '1') {
        return view('admin.users.viewUser');
    }else {
        abort('404');
    }
});
Route::post('insertUser', 'UserController@insertUser');
Route::get('dashboard/editUser/{id}', function ($id) {
    if (Auth::check() && Auth::user()->level != '1') {
        $did = Crypt::decryptString($id);
        $data = DB::table('users')->where('id','=',$did)->first();
        return view('admin.users.editUser', ['data' =>$data]);
    }else {
        abort('404');
    }
});
Route::post('updateUser', 'UserController@updateUser');
Route::get('dashboard/deleteUser/{id}', function ($id) {
    if (Auth::check() && Auth::user()->level != '1') {
        $did = Crypt::decryptString($id);
        $data = DB::table('users')->where('id','=',$did)->first();
        return view('admin.users.deleteUser', ['data' =>$data]);
    }else {
        abort('404');
    }
});
Route::post('deleteUser', 'UserController@deleteUser');

// Admin Dashboard Planes
Route::get('dashboard/viewPlanes', function () {
    if (Auth::check() && Auth::user()->level != '1') {
        return view('admin.planes.viewPlane');
    }else {
        abort('404');
    }
});
Route::get('dashboard/addPlane', function () {
    if (Auth::check() && Auth::user()->level != '1') {
        return view('admin.planes.addPlane');
    }else {
        abort('404');
    }
});
Route::get('dashboard/addPlaneRoute', function () {
    if (Auth::check() && Auth::user()->level != '1') {
        return view('admin.planes.addRoute');
    }else {
        abort('404');
    }
});


Route::post('insertPlane', 'TransController@insertPlane');
Route::post('insertPlaneRoute', 'TransController@insertRoute');
Route::get('dashboard/editPlaneRoute/{rid}', function ($rid) {
    if (Auth::check() && Auth::user()->level != '1') {
        $did = Crypt::decryptString($rid);
        $dataRoute = DB::table('rute')->where('id','=',$did)->first();
        return view('admin.planes.editRoute', ['route' => $dataRoute]);
    }else {
        abort('404');
    }
});
Route::get('dashboard/editPlane/{id}', function ($id) {
    if (Auth::check() && Auth::user()->level != '1') {
        $did = Crypt::decryptString($id);
        $dataPlane = DB::table('transportation')->where('id','=',$did)->where('type_id','=','2')->first();
        return view('admin.planes.editPlane',['plane' => $dataPlane]);
    }else {
        abort('404');
    }
});
Route::post('updatePlane', 'TransController@updatePlane');
Route::post('updatePlaneRoute', 'TransController@updatePlaneRoute');

Route::get('dashboard/deletePlane/{id}', function ($id) {
    if (Auth::check() && Auth::user()->level != '1') {
        $did = Crypt::decryptString($id);
        $dataPlane = DB::table('transportation')->where('id','=',$did)->where('type_id','=','2')->first();
        return view('admin.planes.deletePlane',['plane' => $dataPlane]);
    }else {
        abort('404');
    }
});
Route::get('dashboard/deletePlaneRoute/{id}', function ($id) {
    if (Auth::check() && Auth::user()->level != '1') {
        $did = Crypt::decryptString($id);
        $dataRoute = DB::table('rute')->where('id','=',$did)->first();
        return view('admin.planes.deleteRoute',['route' => $dataRoute]);
    }else {
        abort('404');
    }
});
Route::post('deletePlane', 'TransController@deletePlane');
Route::post('deleteRoute', 'TransController@deleteRoute');

// Admin Dashboard Trains
Route::get('dashboard/viewTrains', function () {
    if (Auth::check() && Auth::user()->level != '1') {
        return view('admin.trains.viewTrain');
    }else {
        abort('404');
    }
});
Route::get('dashboard/addTrain', function () {
    if (Auth::check() && Auth::user()->level != '1') {
        return view('admin.trains.addTrain');
    }else {
        abort('404');
    }
});
Route::get('dashboard/addTrainRoute', function () {
    if (Auth::check() && Auth::user()->level != '1') {
        return view('admin.trains.addRoute');
    }else {
        abort('404');
    }
});
Route::post('insertTrain', 'TransController@insertTrain');
Route::post('insertTrainRoute', 'TransController@insertRoute');

Route::get('dashboard/editTrainRoute/{rid}', function ($rid) {
    if (Auth::check() && Auth::user()->level != '1') {
        $did = Crypt::decryptString($rid);
        $dataRoute = DB::table('rute')->where('id','=',$did)->first();
        return view('admin.trains.editRoute', ['route' => $dataRoute]);
    }else {
        abort('404');
    }
});
Route::get('dashboard/editTrain/{id}', function ($id) {
    if (Auth::check() && Auth::user()->level != '1') {
        $did = Crypt::decryptString($id);
        $dataTrain = DB::table('transportation')->where('id','=',$did)->where('type_id','=','1')->first();
        return view('admin.trains.editTrain',['train' => $dataTrain]);
    }else {
        abort('404');
    }
});
Route::post('updateTrain', 'TransController@updateTrain');
Route::post('updateTrainRoute', 'TransController@updateTrainRoute');

Route::get('dashboard/deleteTrain/{id}', function ($id) {
    $did = Crypt::decryptString($id);
    if (Auth::check() && Auth::user()->level != '1') {
        $dataTrain = DB::table('transportation')->where('id','=',$did)->where('type_id','=','1')->first();
        return view('admin.trains.deleteTrain',['train' => $dataTrain]);
    }else {
        abort('404');
    }
});
Route::get('dashboard/deleteTrainRoute/{id}', function ($id) {
    if (Auth::check() && Auth::user()->level != '1') {
        $did = Crypt::decryptString($id);
        $dataRoute = DB::table('rute')->where('id','=',$did)->first();
        return view('admin.trains.deleteRoute',['route' => $dataRoute]);
    }else {
        abort('404');
    }
});
Route::post('deleteTrain', 'TransController@deleteTrain');


//Book Trip
Route::post('booking/searchTrans', 'Reserve@searchTrans');
Route::post('booking/prebook', 'Reserve@prebook');
Route::post('booking/fillContact', 'Reserve@fillContact');
Route::post('booking/payment', 'Reserve@payment');
Route::get('cek', function () {
    return view('book.cek');
});
Route::get('booking/payment/{code}', function ($code)
{
    $data = DB::select("SELECT reservation.*,SUM(ticket.price) AS total FROM `reservation`,ticket WHERE ticket.reservation_id = reservation.id AND reservation.reservation_code = '$code' GROUP BY ticket.reservation_id");
    return view('book.payment', ['reservation' => $data]);
});
Route::get('completePayment/{code}', function ($code) {
    $data = DB::table('reservation')->where('reservation_code','=',$code)->first();
    return view('book.uploadPayment', ['reservation' => $data]);
});
Route::post('uploadPayment', 'Reserve@uploadPayment');

Route::post('test', function () {
    $a = Input::get('a');
    $b = Input::get('b');
    return view('test', ['a' => $a, 'b' => $b]);
});

//Reservation
Route::post('approve', 'Reserve@approve');
Route::post('delReserve', 'Reserve@delReserve');
Route::post('delReserveCode', 'Reserve@delReserveCode');
Route::get('dashboard/detailReservation/{id}', function ($id) {
    if (Auth::check() && Auth::user()->level != '1') {
        // $did = Crypt::decryptString($id);
        $dataReserve = DB::select("SELECT reservation.*,SUM(ticket.price) AS total FROM `reservation`,ticket WHERE ticket.reservation_id = reservation.id AND reservation.id = $id GROUP BY ticket.reservation_id");
        return view('admin.reservations.detailReservation',['reserve' => $dataReserve]);
    }else {
        abort('404');
    }
});

Route::get('dashboard/exportPlane', 'TransController@exportPlane');
Route::get('dashboard/exportTrain', 'TransController@exportTrain');
Route::get('dashboard/exportReservation', 'Reserve@exportReserve');
Route::get('dashboard/exportReservation/{year}/{mon}', 'Reserve@exportReserveFil');
// Route::get('exportPlane', function()
// {
//    return view('admin.planes.data-planes');
// });
// Route::get('exportTrain', function()
// {
//     return view('admin.trains.data-trains');
// });
Route::get('exportReserve', function()
{
    $pdf = PDF::loadView('admin.reservations.data-reservations');
    $pdf->setPaper('A4', 'landscape');
    return $pdf->stream();
    // return view('admin.reservations.data-reservations');
});
Route::post('ticket', function()
{
    $id = Input::get('id');
    $pdf = PDF::loadView('book.ticket',['id' => $id ]);
    // $pdf->set_base_path();
    $pdf->setPaper('A4', 'landscape');
    return $pdf->stream("Reiseziel E-Ticket.pdf");
    // return view('admin.reservations.data-reservations');
});

//adminCustomer
Route::get('dashboard/exportCustomer', 'Reserve@exportCustomer');
Route::post('deleteCustomer', 'Reserve@deleteCustomer');
Route::get('dashboard/viewCustomers', function () {
    if (Auth::check()) {
        if (Auth::user()->level == '1') {
            abort('404');
        } else {
            return view('admin.customers.viewCustomer'); 
        }
    } else {
        return redirect('/');
    }
});

Route::get('dashboard/deleteCustomer/{id}', function ($id) {
    if (Auth::check() && Auth::user()->level != '1') {
        $did = Crypt::decryptString($id);
        $dataCus = DB::table('customer')->where('id','=',$did)->first();
        return view('admin.customers.deleteCustomer',['cus' => $dataCus]);
    }else {
        abort('404');
    }
});
Route::get('changePassword/{token}', function ($token) {
   $dbtoken = DB::table('users')->where('forgot_pass','=',$token)->count();
    if ($dbtoken < 1) {
       return Redirect::to('/forgotPass')->with(['color' => 'red', 'msg' => 'Token Invalid']);
   }else {
       return view('newPass',['token' => $token]);
   } 
});
Route::post('changePassword/{token}', 'UserController@changePassword');