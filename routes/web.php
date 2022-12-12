<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
Use Spatie\QueryBuilder\QueryBuilder;
Use Spatie\QueryBuilder\AllowedFilter;
Use App\Models\Owner;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FlutterwaveController;
use App\Http\Controllers\Admin\CertificatepayController;
use App\Http\Controllers\Admin\Location\StateController;

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







Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    /**
    * Logout Route
    */
    Route::get('/logout', [LogoutController::class, 'perform'])->name('logout.perform');
    Route::get('/', [LoginController::class, 'index']);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
 });

Route::get('/home', [DashboardController::class, 'index'])->name('home');






//admin=======
Route::get('admin/home', [AdminController::class, 'index']);
// Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
// Route::post('admin', 'Admin\LoginController@login');
        // Password Reset Routes...
// Route::get('admin/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
// Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
// Route::get('admin/reset/password/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
// Route::post('admin/update/reset', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');
// Route::get('/admin/Change/Password','AdminController@ChangePassword')->name('admin.password.change');
// Route::post('/admin/password/update','AdminController@Update_pass')->name('admin.password.update');
Route::get('admin/logout', [LogoutController::class, 'perform'])->name('admin.logout');





//Dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.home');


//States
Route::get('admin/state/all', [StateController::class, 'index'])->name('states');
Route::post('admin/store/state', [StateController::class, 'storeState'])->name('store.state');
Route::get('edit/state/{id}', [StateController::class, 'EditState']);
Route::post('update/state/{id}', [StateController::class, 'UpdateState']);
Route::get('delete/state/{id}', [StateController::class, 'DeleteState']);
Route::get('view/state/{id}', [StateController::class, 'StateView']);




//Owners
Route::get('admin/owner/all', [OwnerController::class, 'index'])->name('owners');
Route::post('admin/store/owner', [OwnerController::class, 'Storeowner'])->name('store.owner');
Route::get('admin/owner/all', [OwnerController::class, 'Findowner'])->name('find.owner');
Route::get('edit/owner/{id}', [OwnerController::class, 'Editowner']);
Route::post('update/owner/{id}', [OwnerController::class, 'Updateowner']);
Route::get('delete/owner/{id}', [OwnerController::class, 'Deleteowner']);
Route::get('view/owner/{id}', [OwnerController::class, 'OwnerView']);



//Dealer
Route::get('admin/dealer/all', [DealerController::class, 'index'])->name('dealers');
Route::post('admin/store/dealer', [DealerController::class, 'Storedealer'])->name('store.dealer');
Route::get('admin/dealer/all', [DealerController::class, 'Finddealer'])->name('find.dealer');
Route::get('edit/dealer/{id}', [DealerController::class, 'Editdealer']);
Route::post('update/dealer/{id}', [DealerController::class, 'Updatedealer']);
Route::get('delete/dealer/{id}', [DealerController::class, 'Deletedealer']);
Route::get('view/dealer/{id}', [DealerController::class, 'DealerView']);




//Vehicle
Route::get('admin/vehicle/all', [VehicleController::class, 'index'])->name('vehicles');
Route::post('admin/store/vehicle', [VehicleController::class, 'Storevehicle'])->name('store.vehicle');
Route::get('admin/vehicle/all', [VehicleController::class, 'Findvehicle'])->name('find.vehicle');
Route::get('edit/vehicle/{id}', [VehicleController::class, 'Editvehicle']);
Route::post('update/vehicle/{id}', [VehicleController::class, 'Updatevehicle']);
Route::get('delete/vehicle/{id}', [VehicleController::class, 'Deletevehicle']);
Route::get('view/vehicle/{id}', [VehicleController::class, 'VehicleView']);



//Certificates
Route::get('admin/certificate/all', [CertificateController::class, 'index'])->name('certificates');
// Route::post('admin/store/certificate', [CertificateController::class, 'Storecertificate'])->name('store.certificate');
Route::post('admin/assign/license', [CertificateController::class, 'assignlicense'])->name('assign.plate');
Route::get('admin/certificate/all', [CertificateController::class, 'Findcertificate'])->name('find.certificate');
Route::get('edit/certificate/{id}', [CertificateController::class, 'Editcertificate']);
Route::post('update/certificate/{id}', [CertificateController::class, 'Updatecertificate']);
Route::get('delete/certificate/{id}', [CertificateController::class, 'Deletecertificate']);
Route::get('view/certificate/{id}', [CertificateController::class, 'CertificateView']);

//Flutterwave
// The route that the button calls to initialize payment
// Route::post('/certificatepay', [CertificatepayController::class, 'initialize'])->name('certificatepay');
// // The callback url after a payment
// Route::get('/rave/callback', [FlutterwaveController::class, 'callback'])->name('callback');





 //Donation
Route::get('admin/donation/all', [DonationController::class, 'index'])->name('donations');
Route::post('admin/store/donation', [DonationController::class, 'Storedonation'])->name('store.donation');
Route::get('delete/donation/{id}', [DonationController::class, 'Deletedonation']);
Route::get('view/donation/{id}', [DonationController::class, 'DonationView']);


//Flutterwave
// The route that the button calls to initialize payment
Route::post('/pay', [CertificatepayController::class, 'initialize'])->name('pay');
// The callback url after a payment
Route::get('/rave/callback', [CertificatepayController::class, 'callback'])->name('callback');

Auth::routes();

Route::get('/home', [DashboardController::class, 'index'])->name('home');
