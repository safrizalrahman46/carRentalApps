<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PembayaranSupplier;
use App\Models\SaldoPelanggan;
use App\Models\MenuSaldoPelanggan;
use App\Models\BayarGaji;
use App\Models\Kasbon;
use App\Models\Transaksi;
use App\Models\CatatanTransaksi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get counts of different types of data
        $data = [
            // 'PembayaranSupplier' => PembayaranSupplier::count(),
            // 'SaldoPelanggan' => SaldoPelanggan::count(),
            // 'MenuSaldoPelanggan' => MenuSaldoPelanggan::count(),
            // 'BayarGaji' => BayarGaji::count(),
            // 'Kasbon' => Kasbon::count(),
            // 'Transaksi' => Transaksi::count(),
            // 'CatatanTransaksi' => CatatanTransaksi::count(),
            'User' => User::count(),
        ];

        //    // Get details for tables
        //    $data['PembayaranSupplierDetails'] = PembayaranSupplier::select('nama_barang', 'total_tagihan')->get();
        //    $data['SaldoPelangganDetails'] = SaldoPelanggan::select('Nama', 'SaldoSekarang')->get();
   
        //    // Data for charts
        //    $data['PembayaranSupplierChart'] = [
        //        'labels' => ['Offline sales', 'Online sales', 'Returns'],
        //        'values' => [40, 50, 10]
        //    ];
   
        //    $data['SaldoPelangganChart'] = [
        //        'labels' => ['Credit', 'Debit', 'Pending'],
        //        'values' => [70, 20, 10]
        //    ];

        return view('admin.dashboard', compact('data'));
    }
}
