@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Laporan Kehadiran / Absensi</h4>

    <form method="GET" action="{{ route('pages.laporan-absensi.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <label>Pegawai</label>
            <select name="pegawai_id" class="form-control">
                <option value="">-- Semua Pegawai --</option>
                @foreach($pegawais as $p)
                <option value="{{ $p->id }}" {{ request('pegawai_id') == $p->id ? 'selected' : '' }}>
                    {{ $p->nama }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label>Dari Tanggal</label>
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
        </div>
        <div class="col-md-3">
            <label>Sampai Tanggal</label>
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
        </div>
        <div class="col-md-2 align-self-end">
            <button class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <a href="{{ route('pages.laporan-absensi.cetak', request()->all()) }}" class="btn btn-success mb-3">Cetak PDF</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Pegawai</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($absensis as $absen)
            <tr>
                <td>{{ $absen->pegawai->nama }}</td>
                <td>{{ $absen->tanggal }}</td>
                <td>{{ $absen->jam_masuk ?? '-' }}</td>
                <td>{{ $absen->jam_pulang ?? '-' }}</td>
                <td>{{ ucfirst($absen->status) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection