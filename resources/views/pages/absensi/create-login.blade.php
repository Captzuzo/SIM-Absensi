@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Absensi Hari Ini</h4>

    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
    @if(session('warning')) <div class="alert alert-warning">{{ session('warning') }}</div> @endif
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

    <div class="mb-3">
        <label>Nama Pegawai</label>
        <input type="text" class="form-control" value="{{ $pegawai->nama }}" disabled>
    </div>

    <div class="mb-3">
        <label>Tanggal</label>
        <input type="text" class="form-control" value="{{ now()->toDateString() }}" disabled>
    </div>

    <div class="mb-3">
        <label>Jam Sekarang</label>
        <input type="text" class="form-control" value="{{ now()->format('H:i:s') }}" disabled>
    </div>

    @php
    $absensiHariIni = $pegawai->absensis->firstWhere('tanggal', now()->toDateString());
    @endphp

    @if (!$absensiHariIni)
    <form action="{{ route('pages.absensi.store-login') }}" method="POST">
        @csrf
        <button class="btn btn-success mt-3">Absen Masuk</button>
    </form>
    @elseif (!$absensiHariIni->jam_pulang)
    <form action="{{ route('pages.absensi.store-pulang') }}" method="POST">
        @csrf
        <button class="btn btn-warning mt-3">Absen Pulang</button>
    </form>
    @else
    <div class="alert alert-info mt-3">
        Anda sudah melakukan absensi masuk dan pulang hari ini.
    </div>
    @endif
</div>
@endsection