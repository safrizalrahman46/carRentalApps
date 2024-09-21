<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
// use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Admin\CarsController;
use App\Http\Controllers\Admin\CarAvailabilityController;
use App\Http\Controllers\Admin\RentalRatesController;
use App\Http\Controllers\Admin\BookingsController;
use App\Http\Controllers\Admin\ManageBookingController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\ChargesController;
use App\Http\Controllers\Admin\TourPackagesController;
use App\Http\Controllers\Admin\ZonesController;
use App\Http\Controllers\Admin\PromotionsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\BookingDepositController;
use App\Http\Controllers\Admin\DriverControllerr;
use App\Http\Controllers\Admin\DeliveryPickupChargesController;

use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\StoreBookingController;
use App\Http\Controllers\Admin\UpdateBookingController;
use App\Http\Controllers\DependantDropdownController;





use App\Http\Controllers\ExportController;

use App\Http\Controllers\coba;


use App\Http\Controllers\Dept\DepartemenDeptController;
use coba as GlobalCoba;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\PenggunaController;
// use App\Http\Controllers\PekerjaanController;
// use App\Http\Controllers\RiwayatPekerjaanController;
// use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

// Route::get('/', function () {
    // Route::prefix('backoffice')->group(function () {
    //             Route::get('/laporan-pembayaran-supplier', [LaporanPembayaranSupplierController::class, 'index'])->name('admin.laporan-pembayaran-supplier.index');
    //             Route::get('/laporan-pembayaran-supplier/create', [LaporanPembayaranSupplierController::class, 'create'])->name('admin.laporan-pembayaran-supplier.create');
    //             Route::post('/laporan-pembayaran-supplier', [LaporanPembayaranSupplierController::class, 'store'])->name('admin.laporan-pembayaran-supplier.store');
    //             Route::get('/laporan-pembayaran-supplier/{id}/edit', [LaporanPembayaranSupplierController::class, 'edit'])->name('admin.laporan-pembayaran-supplier.edit');
    //             Route::put('/laporan-pembayaran-supplier/{id}', [LaporanPembayaranSupplierController::class, 'update'])->name('admin.laporan-pembayaran-supplier.update');
    //             Route::delete('/laporan-pembayaran-supplier/{id}', [LaporanPembayaranSupplierController::class, 'destroy'])->name('admin.laporan-pembayaran-supplier.destroy');
    // });

//     return view('welcome');
// Route::get('/', [LandingPageController::class, 'index'])->name('index');

Route::get('/', [AuthController::class, 'index'])->name('login');

Route::any('/backoffice/proses_login', [AuthController::class, 'prosesLogin'])->name('form.post.login');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/logout', [AuthController::class, 'signout'])->name('signout');

    ////USER
    //    Route::prefix('backoffice')->group(function () {
    //     Route::get('/User', [UserController::class, 'index'])->name('admin.User.index');
    //     Route::get('/User/create', [UserController::class, 'create'])->name('admin.User.create');
    //     Route::post('/User', [UserController::class, 'store'])->name('admin.User.store');
    //     Route::get('/User/{id}/edit', [UserController::class, 'edit'])->name('admin.User.edit');
    //     Route::put('/User/{id}', [UserController::class, 'update'])->name('admin.User.update');
    //     Route::delete('/User/{id}', [UserController::class, 'destroy'])->name('admin.User.destroy');

    //     Route::get('/export-User', [UserController::class, 'export_tabel_User'])->name('Export.User');
    //     Route::get('/export-users-pdf', [UserController::class, 'export_tabel_User_pdf'])->name('Export.UsersPDF');


    // });


    // ////Masyer Jenis Transaksi
    Route::prefix('backoffice')->group(function () {
        Route::get('/ListCar', [CarsController::class, 'index'])->name('admin.ListCar.index');
        Route::get('/ListCar/create', [CarsController::class, 'create'])->name('admin.ListCar.create');
        Route::post('/ListCar', [CarsController::class, 'store'])->name('admin.ListCar.store');
        Route::get('/ListCar/{id}/edit', [CarsController::class, 'edit'])->name('admin.ListCar.edit');
        Route::put('/ListCar/{id}', [CarsController::class, 'update'])->name('admin.ListCar.update');
        Route::delete('/ListCar/{id}', [CarsController::class, 'destroy'])->name('admin.ListCar.destroy');

        Route::get('/export-ListCar', [CarsController::class, 'export_tabel_ListCar'])->name('Export.ListCar');
        Route::get('/export-ListCar-pdf', [CarsController::class, 'export_tabel_ListCar_pdf'])->name('Export.ListCarPDF');

    });

    //    ////Masyer Jenis Spplier
       Route::prefix('backoffice')->group(function () {
        Route::get('/car_availability', [CarAvailabilityController::class, 'index'])->name('admin.car_availability.index');
        Route::get('/car_availability/create', [CarAvailabilityController::class, 'create'])->name('admin.car_availability.create');
        Route::post('/car_availability', [CarAvailabilityController::class, 'store'])->name('admin.car_availability.store');
        Route::get('/car_availability/{id}/edit', [CarAvailabilityController::class, 'edit'])->name('admin.car_availability.edit');
        Route::put('/car_availability/{id}', [CarAvailabilityController::class, 'update'])->name('admin.car_availability.update');
        Route::delete('/car_availability/{id}', [CarAvailabilityController::class, 'destroy'])->name('admin.car_availability.destroy');
        // Route::get('/export-master-supplier', [CarAvailabilityController::class, 'export_tabel_car_availability'])->name('Export.car_availability');
        // Route::get('/export-master-supplier-pdf', [CarAvailabilityController::class, 'export_tabel_car_availability_pdf'])->name('Export.car_availabilityPDF');

    });

    Route::prefix('backoffice')->group(function () {
        Route::get('/Rental-Rates', [RentalRatesController::class, 'index'])->name('admin.Rental-Rates.index');
        Route::get('/Rental-Rates/create', [RentalRatesController::class, 'create'])->name('admin.Rental-Rates.create');
        Route::post('/Rental-Rates', [RentalRatesController::class, 'store'])->name('admin.Rental-Rates.store');
        Route::get('/Rental-Rates/{id}/edit', [RentalRatesController::class, 'edit'])->name('admin.Rental-Rates.edit');
        Route::put('/Rental-Rates/{id}', [RentalRatesController::class, 'update'])->name('admin.Rental-Rates.update');
        Route::delete('/Rental-Rates/{id}', [RentalRatesController::class, 'destroy'])->name('admin.Rental-Rates.destroy');
        // Route::get('/export-master-supplier', [CarAvailabilityController::class, 'export_tabel_car_availability'])->name('Export.car_availability');
        // Route::get('/export-master-supplier-pdf', [CarAvailabilityController::class, 'export_tabel_car_availability_pdf'])->name('Export.car_availabilityPDF');

    });

    Route::prefix('backoffice')->group(function () {
        Route::get('/Bookings', [BookingsController::class, 'index'])->name('admin.Bookings.index');
        Route::get('/Bookings/create', [BookingsController::class, 'create'])->name('admin.Bookings.create');
        Route::post('/Bookings', [BookingsController::class, 'store'])->name('admin.Bookings.store');
        Route::get('/Bookings/{id}/edit', [BookingsController::class, 'edit'])->name('admin.Bookings.edit');
        Route::put('/Bookings/{id}', [BookingsController::class, 'update'])->name('admin.Bookings.update');
        Route::delete('/Bookings/{id}', [BookingsController::class, 'destroy'])->name('admin.Bookings.destroy');
        // Route::get('/export-master-supplier', [CarAvailabilityController::class, 'export_tabel_car_availability'])->name('Export.car_availability');
        // Route::get('/export-master-supplier-pdf', [CarAvailabilityController::class, 'export_tabel_car_availability_pdf'])->name('Export.car_availabilityPDF');

    });


    Route::prefix('backoffice')->group(function () {
        Route::get('/Manage-Booking', [ManageBookingController::class, 'index'])->name('admin.Manage-Booking.index');
        Route::get('/Manage-Booking/create', [ManageBookingController::class, 'create'])->name('admin.Manage-Booking.create');
        Route::post('/Manage-Booking', [ManageBookingController::class, 'store'])->name('admin.Manage-Booking.store');
        Route::get('/Manage-Booking/{id}/edit', [ManageBookingController::class, 'edit'])->name('admin.Manage-Booking.edit');
        Route::put('/Manage-Booking/{id}', [ManageBookingController::class, 'update'])->name('admin.Manage-Booking.update');
        Route::delete('/Manage-Booking/{id}', [ManageBookingController::class, 'destroy'])->name('admin.Manage-Booking.destroy');
        // Route::get('/export-master-supplier', [CarAvailabilityController::class, 'export_tabel_car_availability'])->name('Export.car_availability');
        // Route::get('/export-master-supplier-pdf', [CarAvailabilityController::class, 'export_tabel_car_availability_pdf'])->name('Export.car_availabilityPDF');

    });


    Route::prefix('backoffice')->group(function () {
        Route::get('/Service', [ServicesController::class, 'index'])->name('admin.Service.index');
        Route::get('/Service/create', [ServicesController::class, 'create'])->name('admin.Service.create');
        Route::post('/Service', [ServicesController::class, 'store'])->name('admin.Service.store');
        Route::get('/Service/{id}/edit', [ServicesController::class, 'edit'])->name('admin.Service.edit');
        Route::put('/Service/{id}', [ServicesController::class, 'update'])->name('admin.Service.update');
        Route::delete('/Service/{id}', [ServicesController::class, 'destroy'])->name('admin.Service.destroy');
        // Route::get('/export-master-supplier', [CarAvailabilityController::class, 'export_tabel_car_availability'])->name('Export.car_availability');
        // Route::get('/export-master-supplier-pdf', [CarAvailabilityController::class, 'export_tabel_car_availability_pdf'])->name('Export.car_availabilityPDF');

    });


    Route::prefix('backoffice')->group(function () {
        Route::get('/Charges', [ChargesController::class, 'index'])->name('admin.Charges.index');
        Route::get('/Charges/create', [ChargesController::class, 'create'])->name('admin.Charges.create');
        Route::post('/Charges', [ChargesController::class, 'store'])->name('admin.Charges.store');
        Route::get('/Charges/{id}/edit', [ChargesController::class, 'edit'])->name('admin.Charges.edit');
        Route::put('/Charges/{id}', [ChargesController::class, 'update'])->name('admin.Charges.update');
        Route::delete('/Charges/{id}', [ChargesController::class, 'destroy'])->name('admin.Charges.destroy');
        // Route::get('/export-master-supplier', [CarAvailabilityController::class, 'export_tabel_car_availability'])->name('Export.car_availability');
        // Route::get('/export-master-supplier-pdf', [CarAvailabilityController::class, 'export_tabel_car_availability_pdf'])->name('Export.car_availabilityPDF');

    });

    Route::prefix('backoffice')->group(function () {
        Route::get('/Tour-Packagaes', [TourPackagesController::class, 'index'])->name('admin.Tour-Packagaes.index');
        Route::get('/Tour-Packagaes/create', [TourPackagesController::class, 'create'])->name('admin.Tour-Packagaes.create');
        Route::post('/Tour-Packagaes', [TourPackagesController::class, 'store'])->name('admin.Tour-Packagaes.store');
        Route::get('/Tour-Packagaes/{id}/edit', [TourPackagesController::class, 'edit'])->name('admin.Tour-Packagaes.edit');
        Route::put('/Tour-Packagaes/{id}', [TourPackagesController::class, 'update'])->name('admin.Tour-Packagaes.update');
        Route::delete('/Tour-Packagaes/{id}', [TourPackagesController::class, 'destroy'])->name('admin.Tour-Packagaes.destroy');
        // Route::get('/export-master-supplier', [CarAvailabilityController::class, 'export_tabel_car_availability'])->name('Export.car_availability');
        // Route::get('/export-master-supplier-pdf', [CarAvailabilityController::class, 'export_tabel_car_availability_pdf'])->name('Export.car_availabilityPDF');

    });


    Route::prefix('backoffice')->group(function () {
        Route::get('/Promotions', [PromotionsController::class, 'index'])->name('admin.Promotions.index');
        Route::get('/Promotions/create', [PromotionsController::class, 'create'])->name('admin.Promotions.create');
        Route::post('/Promotions', [PromotionsController::class, 'store'])->name('admin.Promotions.store');
        Route::get('/Promotions/{id}/edit', [PromotionsController::class, 'edit'])->name('admin.Promotions.edit');
        Route::put('/Promotions/{id}', [PromotionsController::class, 'update'])->name('admin.Promotions.update');
        Route::delete('/Promotions/{id}', [PromotionsController::class, 'destroy'])->name('admin.Promotions.destroy');
        // Route::get('/export-master-supplier', [CarAvailabilityController::class, 'export_tabel_car_availability'])->name('Export.car_availability');
        // Route::get('/export-master-supplier-pdf', [CarAvailabilityController::class, 'export_tabel_car_availability_pdf'])->name('Export.car_availabilityPDF');

    });


    Route::prefix('backoffice')->group(function () {
        Route::get('/Users', [UsersController::class, 'index'])->name('admin.Users.index');
        Route::get('/Users/create', [UsersController::class, 'create'])->name('admin.Users.create');
        Route::post('/Users', [UsersController::class, 'store'])->name('admin.Users.store');
        Route::get('/Users/{id}/edit', [UsersController::class, 'edit'])->name('admin.Users.edit');
        Route::put('/Users/{id}', [UsersController::class, 'update'])->name('admin.Users.update');
        Route::delete('/Users/{id}', [UsersController::class, 'destroy'])->name('admin.Users.destroy');
        // Route::get('/export-master-supplier', [CarAvailabilityController::class, 'export_tabel_car_availability'])->name('Export.car_availability');
        // Route::get('/export-master-supplier-pdf', [CarAvailabilityController::class, 'export_tabel_car_availability_pdf'])->name('Export.car_availabilityPDF');

    });

    Route::prefix('backoffice')->group(function () {
        Route::get('/Bookings-Deposit', [BookingDepositController::class, 'index'])->name('admin.Bookings-Deposit.index');
        Route::get('/Bookings-Deposit/create', [BookingDepositController::class, 'create'])->name('admin.Bookings-Deposit.create');
        Route::post('/Bookings-Deposit', [BookingDepositController::class, 'store'])->name('admin.Bookings-Deposit.store');
        Route::get('/Bookings-Deposit/{id}/edit', [BookingDepositController::class, 'edit'])->name('admin.Bookings-Deposit.edit');
        Route::put('/Bookings-Deposit/{id}', [BookingDepositController::class, 'update'])->name('admin.Bookings-Deposit.update');
        Route::delete('/Bookings-Deposit/{id}', [BookingDepositController::class, 'destroy'])->name('admin.Bookings-Deposit.destroy');
        // Route::get('/export-master-supplier', [CarAvailabilityController::class, 'export_tabel_car_availability'])->name('Export.car_availability');
        // Route::get('/export-master-supplier-pdf', [CarAvailabilityController::class, 'export_tabel_car_availability_pdf'])->name('Export.car_availabilityPDF');

    });

    Route::prefix('backoffice')->group(function () {
        Route::get('/Driver', [DriverControllerr::class, 'index'])->name('admin.Driver.index');
        Route::get('/Driver/create', [DriverControllerr::class, 'create'])->name('admin.Driver.create');
        Route::post('/Driver', [DriverControllerr::class, 'store'])->name('admin.Driver.store');
        Route::get('/Driver/{id}/edit', [DriverControllerr::class, 'edit'])->name('admin.Driver.edit');
        Route::put('/Driver/{id}', [DriverControllerr::class, 'update'])->name('admin.Driver.update');
        Route::delete('/Driver/{id}', [DriverControllerr::class, 'destroy'])->name('admin.Driver.destroy');
        // Route::get('/export-master-supplier', [CarAvailabilityController::class, 'export_tabel_car_availability'])->name('Export.car_availability');
        // Route::get('/export-master-supplier-pdf', [CarAvailabilityController::class, 'export_tabel_car_availability_pdf'])->name('Export.car_availabilityPDF');

    });


    Route::prefix('backoffice')->group(function () {
        Route::get('/Delivery-pickup-charges', [DeliveryPickupChargesController::class, 'index'])->name('admin.Delivery-pickup-charges.index');
        Route::get('/Delivery-pickup-charges/create', [DeliveryPickupChargesController::class, 'create'])->name('admin.Delivery-pickup-charges.create');
        Route::post('/Delivery-pickup-charges', [DeliveryPickupChargesController::class, 'store'])->name('admin.Delivery-pickup-charges.store');
        Route::get('/Delivery-pickup-charges/{id}/edit', [DeliveryPickupChargesController::class, 'edit'])->name('admin.Delivery-pickup-charges.edit');
        Route::put('/Delivery-pickup-charges/{id}', [DeliveryPickupChargesController::class, 'update'])->name('admin.Delivery-pickup-charges.update');
        Route::delete('/Delivery-pickup-charges/{id}', [DeliveryPickupChargesController::class, 'destroy'])->name('admin.Delivery-pickup-charges.destroy');
        // Route::get('/export-master-supplier', [CarAvailabilityController::class, 'export_tabel_car_availability'])->name('Export.car_availability');
        // Route::get('/export-master-supplier-pdf', [CarAvailabilityController::class, 'export_tabel_car_availability_pdf'])->name('Export.car_availabilityPDF');

    });

    Route::prefix('backoffice')->group(function () {
        Route::get('/Zones', [ZonesController::class, 'index'])->name('admin.Zones.index');
        Route::get('/Zones/create', [ZonesController::class, 'create'])->name('admin.Zones.create');
        Route::post('/Zones', [ZonesController::class, 'store'])->name('admin.Zones.store');
        Route::get('/Zones/{id}/edit', [ZonesController::class, 'edit'])->name('admin.Zones.edit');
        Route::put('/Zones/{id}', [ZonesController::class, 'update'])->name('admin.Zones.update');
        Route::delete('/Zones/{id}', [ZonesController::class, 'destroy'])->name('admin.Zones.destroy');
        // Route::get('/export-master-supplier', [CarAvailabilityController::class, 'export_tabel_car_availability'])->name('Export.car_availability');
        // Route::get('/export-master-supplier-pdf', [CarAvailabilityController::class, 'export_tabel_car_availability_pdf'])->name('Export.car_availabilityPDF');
        Route::get('provinces', 'ZonesController@provinces')->name('provinces');
        Route::get('cities', 'ZonesController@cities')->name('cities');
        Route::get('districts', 'ZonesController@districts')->name('districts');
        Route::get('villages', 'ZonesController@villages')->name('villages');

        Route::get('/cities', 'DependentDropdownController@getCities')->name('cities');
        Route::get('/districts', 'DependentDropdownController@getDistricts')->name('districts');
        Route::get('/villages', 'DependentDropdownController@getVillages')->name('villages');
        Route::get('cities', [ZonesController::class, 'cities'])->name('cities');
        Route::get('districts', [ZonesController::class, 'districts'])->name('districts');
        Route::get('villages', [ZonesController::class, 'villages'])->name('villages');

    });
    });

// });
