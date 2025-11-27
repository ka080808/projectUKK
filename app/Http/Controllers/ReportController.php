<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\PBB;
use App\Exports\PBBExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Display report dashboard
     */
    public function index()
    {
        $totalWarga = Warga::count();
        $totalPBB = PBB::count();
        $totalPajakTahunIni = PBB::sum('nilai_pajak_tahun_ini');
        
        $statusLunas = PBB::where('status_pembayaran', 'Lunas')->count();
        $statusBelumLunas = PBB::where('status_pembayaran', 'Belum Lunas')->count();
        $statusCicilan = PBB::where('status_pembayaran', 'Cicilan')->count();
        
        $pajakLunas = PBB::where('status_pembayaran', 'Lunas')->sum('nilai_pajak_tahun_ini');
        $pajakBelumLunas = PBB::where('status_pembayaran', 'Belum Lunas')->sum('nilai_pajak_tahun_ini');
        $pajakCicilan = PBB::where('status_pembayaran', 'Cicilan')->sum('nilai_pajak_tahun_ini');

        return view('report.index', [
            'totalWarga' => $totalWarga,
            'totalPBB' => $totalPBB,
            'totalPajakTahunIni' => $totalPajakTahunIni,
            'statusLunas' => $statusLunas,
            'statusBelumLunas' => $statusBelumLunas,
            'statusCicilan' => $statusCicilan,
            'pajakLunas' => $pajakLunas,
            'pajakBelumLunas' => $pajakBelumLunas,
            'pajakCicilan' => $pajakCicilan,
        ]);
    }

    /**
     * Export report to PDF
     */
    public function exportPDF()
    {
        try {
            $totalWarga = Warga::count();
            $totalPBB = PBB::count();
            $totalPajakTahunIni = PBB::sum('nilai_pajak_tahun_ini');
            
            $statusLunas = PBB::where('status_pembayaran', 'Lunas')->count();
            $statusBelumLunas = PBB::where('status_pembayaran', 'Belum Lunas')->count();
            $statusCicilan = PBB::where('status_pembayaran', 'Cicilan')->count();
            
            $pajakLunas = PBB::where('status_pembayaran', 'Lunas')->sum('nilai_pajak_tahun_ini');
            $pajakBelumLunas = PBB::where('status_pembayaran', 'Belum Lunas')->sum('nilai_pajak_tahun_ini');
            $pajakCicilan = PBB::where('status_pembayaran', 'Cicilan')->sum('nilai_pajak_tahun_ini');

            $pbbData = PBB::all();

            $pdf = Pdf::loadView('report.pdf', [
                'totalWarga' => $totalWarga,
                'totalPBB' => $totalPBB,
                'totalPajakTahunIni' => $totalPajakTahunIni,
                'statusLunas' => $statusLunas,
                'statusBelumLunas' => $statusBelumLunas,
                'statusCicilan' => $statusCicilan,
                'pajakLunas' => $pajakLunas,
                'pajakBelumLunas' => $pajakBelumLunas,
                'pajakCicilan' => $pajakCicilan,
                'pbbData' => $pbbData,
            ]);

            return $pdf->download('Laporan_Kependudukan_' . date('Y-m-d_His') . '.pdf');
        } catch (\Exception $e) {
            return back()->with('error', 'Error export PDF: ' . $e->getMessage());
        }
    }

    /**
     * Export report to Excel
     */
    public function exportExcel()
    {
        try {
            $filename = 'Laporan_PBB_' . date('Y-m-d_His') . '.xlsx';
            return Excel::download(new PBBExport, $filename);
        } catch (\Exception $e) {
            return back()->with('error', 'Error export Excel: ' . $e->getMessage());
        }
    }
}
