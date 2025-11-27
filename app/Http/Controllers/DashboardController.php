<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\PBB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalWarga = Warga::count();
        $totalPBB = PBB::count();
        $totalPajakTahunIni = PBB::sum('nilai_pajak_tahun_ini');
        $statusLunas = PBB::where('status_pembayaran', 'Lunas')->count();
        $statusBelumLunas = PBB::where('status_pembayaran', 'Belum Lunas')->count();
        $statusCicilan = PBB::where('status_pembayaran', 'Cicilan')->count();

        return view('dashboard.index', [
            'totalWarga' => $totalWarga,
            'totalPBB' => $totalPBB,
            'totalPajakTahunIni' => $totalPajakTahunIni,
            'statusLunas' => $statusLunas,
            'statusBelumLunas' => $statusBelumLunas,
            'statusCicilan' => $statusCicilan,
        ]);
    }
}
