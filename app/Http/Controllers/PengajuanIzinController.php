<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\PengajuanIzin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanIzinController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pegawai = Pegawai::where('user_id', $user->id)->first();

        $izin = $pegawai
            ? PengajuanIzin::where('pegawai_id', $pegawai->id)->latest()->get()
            : collect();

        return view('pages.pengajuan-izin.index', compact('pegawai', 'izin', 'user'));
    }

    public function data()
    {
        $user = auth()->user();
        $pegawai = \App\Models\Pegawai::where('user_id', $user->id)->first();

        // Jika user role-nya admin atau hrd → tampilkan semua
        if (in_array($user->role->name, ['admin', 'hrd'])) {
            $izin = \App\Models\PengajuanIzin::with('pegawai')->latest()->get();
        } else {
            // Jika pegawai → hanya tampilkan izin miliknya
            if (!$pegawai) {
                return back()->with('error', 'Data pegawai tidak ditemukan.');
            }

            $izin = \App\Models\PengajuanIzin::with('pegawai')
                ->where('pegawai_id', $pegawai->id)
                ->latest()
                ->get();
        }

        return view('pages.pengajuan-izin.data', compact('izin', 'pegawai', 'user'));
    }

    public function create()
    {
        return view('pages.pengajuan-izin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'jenis_izin' => 'required|in:sakit,cuti,izin',
            'keterangan' => 'nullable|string',
        ]);

        $pegawai = Pegawai::where('user_id', Auth::id())->first();

        PengajuanIzin::create([
            'pegawai_id' => $pegawai->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jenis_izin' => $request->jenis_izin,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pages.pengajuan-izin.index')
            ->with('success', 'Pengajuan izin berhasil dikirim.');
    }

    public function approve($id)
    {
        $izin = PengajuanIzin::findOrFail($id);
        $izin->update(['status' => 'disetujui']);

        return back()->with('success', 'Pengajuan izin disetujui.');
    }

    public function reject($id)
    {
        $izin = PengajuanIzin::findOrFail($id);
        $izin->update(['status' => 'ditolak']);

        return back()->with('success', 'Pengajuan izin ditolak.');
    }
}
