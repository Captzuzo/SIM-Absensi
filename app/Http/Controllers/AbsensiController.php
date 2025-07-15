<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index()
    {
        // $absensis = Absensi::with('pegawai')->latest()->get();
        // return view('pages.absensi.index', compact('absensis'));
        $user = auth()->user();
        $role = $user->role->name;

        if ($role === 'pegawai') {
            $pegawai = \App\Models\Pegawai::where('user_id', $user->id)->first();
            $absensis = \App\Models\Absensi::where('pegawai_id', $pegawai->id)->latest()->get();
        } else {
            $absensis = \App\Models\Absensi::with('pegawai')->latest()->get();
        }

        return view('pages.absensi.index', compact('absensis'));
    }

    public function show(Absensi $absensi)
    {
        return view('pages.absensi.show', compact('absensi'));
    }

    public function create()
    {
        $pegawais = Pegawai::all();
        return view('pages.absensi.create', compact('pegawais'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'tanggal' => 'required|date',
            'jam_masuk' => 'nullable|date_format:H:i',
            'jam_pulang' => 'nullable|date_format:H:i',
            'status' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        Absensi::create($request->all());

        return redirect()->route('pages.absensi.index')->with('success', 'Absensi berhasil dicatat.');
    }

    public function destroy(Absensi $absensi)
    {
        $absensi->delete();
        return back()->with('success', 'Data absensi berhasil dihapus.');
    }


    public function createByLogin()
    {
        // dd(auth()->user());
        $pegawai = \App\Models\Pegawai::with('absensis')
            ->where('user_id', auth()->id())
            ->first();

        if (!$pegawai) {
            return back()->with('error', 'Pegawai tidak ditemukan untuk user ini.');
        }

        return view('pages.absensi.create-login', compact('pegawai'));
    }


    public function storeByLogin(Request $request)
    {
        $pegawai = Pegawai::where('user_id', auth()->id())->first();

        if (!$pegawai) {
            return back()->with('error', 'Pegawai tidak ditemukan.');
        }

        $today = now()->toDateString();
        $absensi = Absensi::where('pegawai_id', $pegawai->id)->where('tanggal', $today)->first();

        if ($absensi) {
            return back()->with('warning', 'Anda sudah absen masuk.');
        }

        Absensi::create([
            'pegawai_id' => $pegawai->id,
            'tanggal'    => $today,
            'jam_masuk'  => now()->format('H:i:s'),
            'status'     => 'hadir',
        ]);

        return redirect()->route('pages.absensi.create-login')->with('success', 'Absen masuk berhasil.');
    }

    public function storeJamPulang()
    {
        $pegawai = Pegawai::where('user_id', auth()->id())->first();

        if (!$pegawai) {
            return back()->with('error', 'Pegawai tidak ditemukan.');
        }

        $today = now()->toDateString();
        $absensi = Absensi::where('pegawai_id', $pegawai->id)->where('tanggal', $today)->first();

        if (!$absensi) {
            return back()->with('error', 'Anda belum absen masuk.');
        }

        if ($absensi->jam_pulang) {
            return back()->with('warning', 'Anda sudah absen pulang.');
        }

        $absensi->update(['jam_pulang' => now()->format('H:i:s')]);

        return redirect()->route('pages.absensi.create-login')->with('success', 'Absen pulang berhasil.');
    }
}
