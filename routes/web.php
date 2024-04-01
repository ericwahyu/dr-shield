<?php

use App\Livewire\Auth\AuthLogin\AuthLoginIndex;
use App\Livewire\Calculation\ProductRoof\ProductRoofIndex;
use App\Livewire\Calculation\ProductUpvc\ProductUpvcIndex;
use App\Livewire\Customer\CustomerOrder\CustomerOrderIndex;
use App\Livewire\Customer\CustomerPercentage\CustomerPercentageIndex;
use App\Livewire\Customer\PotentialCustomer\PotentialCustomerIndex;
use App\Livewire\Dashboard\DashboardIndex;
use App\Livewire\MarketingTool\Sample\SampleIndex;
use App\Livewire\MarketingTool\SampleHistory\SampleHistoryIndex;
use App\Livewire\MasterData\AdminData\AdminDataIndex;
use App\Livewire\Order\OrderHistory\OrderHistoryIndex;
use App\Livewire\Order\OrderRoof\OrderRoofIndex;
use App\Livewire\Order\OrderUpvc\OrderUpvcIndex;

use App\Livewire\Product\ProductRoof\ProductRoofIndex as ProductRoofProductRoofIndex;
use App\Livewire\Product\ProductUpvc\ProductUpvcIndex as ProductUpvcProductUpvcIndex;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::get('/', AuthLoginIndex::class)->name('auth.login');

Route::get('/logout', function () {
    Session::flush();
    Auth::logout();
    return redirect()->to('/');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardIndex::class)->name('dashboard');

    Route::prefix('/pelanggan')->group(function () {
        Route::get('/calon', PotentialCustomerIndex::class)->name('customer.potential');
        Route::get('/masuk', CustomerOrderIndex::class)->name('customer.order');
        Route::get('/persentase', CustomerPercentageIndex::class)->name('customer.percentage');
    });

    Route::prefix('/pesanan')->group(function () {
        Route::get('/genteng', OrderRoofIndex::class)->name('order.roof');
        Route::get('/UPVC', OrderUpvcIndex::class)->name('order.upvc');
        Route::get('/riwayat', OrderHistoryIndex::class)->name('order.history');
    });

    Route::prefix('/perhitungan')->group(function () {
        Route::get('/genteng', ProductRoofIndex::class)->name('calculation.roof');
        Route::get('/UPVC', ProductUpvcIndex::class)->name('calculation.upvc');
    });

    Route::prefix('/produk')->group(function () {
        Route::get('/genteng', ProductRoofProductRoofIndex::class)->name('product.roof');
        Route::get('/UPVC', ProductUpvcProductUpvcIndex::class)->name('product.upvc');
    });

    Route::prefix('/marketing-tool')->group(function () {
        Route::get('/sample', SampleIndex::class)->name('marketing.sample');
        Route::get('/riwayat-sample', SampleHistoryIndex::class)->name('marketing.sample.history');
    });

    Route::prefix('/master-data')->middleware(['role:master-admin|super-admin'])->group(function () {
        Route::get('/admin', AdminDataIndex::class)->name('master.admin');
    });
});
