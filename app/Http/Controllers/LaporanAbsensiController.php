<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use PDF;

class LaporanAbsensiController extends Controller
{
    public function index(Request $request)
    {
        $pegawai_id = $request->pegawai_id;
        $start = $request->start_date;
        $end = $request->end_date;

        $pegawais = Pegawai::all();

        $query = Absensi::with('pegawai');

        if ($pegawai_id) {
            $query->where('pegawai_id', $pegawai_id);
        }

        if ($start && $end) {
            $query->whereBetween('tanggal', [$start, $end]);
        }

        $absensis = $query->orderBy('tanggal', 'desc')->get();

        return view('pages.laporan-absensi.index', compact('absensis', 'pegawais'));
    }

    public function cetak(Request $request)
    {
        $pegawai_id = $request->pegawai_id;
        $start = $request->start_date;
        $end = $request->end_date;

        $query = Absensi::with('pegawai');

        if ($pegawai_id) {
            $query->where('pegawai_id', $pegawai_id);
        }

        if ($start && $end) {
            $query->whereBetween('tanggal', [$start, $end]);
        }

        $absensis = $query->orderBy('tanggal', 'desc')->get();

        $pdf = PDF::loadView('pages.laporan-absensi.pdf', compact('absensis'))->setPaper('a4', 'portrait');
        return $pdf->download('laporan-absensi.pdf');
    }
}
