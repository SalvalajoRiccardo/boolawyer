<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Sponsor;
use App\User;

use Carbon\Carbon;

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

// Route::get('/', function () {
//     return view('guest.welcome');
// });


// Change Password
Route::get('change-password', 'ChangePasswordController@index');
Route::post('change-password', 'ChangePasswordController@changePassword')->name('change.password');

Auth::routes();

Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')->group(function() {
    // pagina di atterraggio dopo il login (con il prefisso, l'url è '/admin')
    Route::get('/', 'HomeController@index')->name('index');

    Route::get('/messages', 'HomeController@message')->name('message_page');

    Route::get('/reviews', 'HomeController@review')->name('review_page');

    Route::resource('/users', 'UserController');
    Route::resource('/sponsor', 'SponsorController');

    Route::post('/checkout', function (Request $request) {
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
    
        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;
    
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => 'Tony',
                'lastName' => 'Stark',
                'email' => 'tony@avengers.com',
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        
    
        if ($result->success) {
            $transaction = $result->transaction;

          
            $id = Auth::id();
            $user = User::find($id);
            
            $sponsor= $request->sponsor;
            $sponsor_start=\Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $sponsor_end = \Carbon\Carbon::now()->addHours($request->duration)->format('Y-m-d H:i:s');
            // dd($sponsor_end);
            // 2021/10/14 09:36:00
     
        
            $user->sponsors()->attach(['user_id'=>$id], ['sponsor_id'=> $sponsor], ['sponsor_date_start'=> '2021-10-14 09:36:00', 'sponsor_date_end'=> '2021-10-14 09:36:00']);

           
            return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
        } else {
            $errorString = "";
    
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
    
            // $_SESSION["errors"] = $errorString;
            // header("Location: index.php");
            return back()->withErrors('An error occurred with the message: '.$result->message);
        }
    });

});

// Rotte per front-end Vue
Route::get('/{any?}', 'HomeController@index')->where('any', '.*');
