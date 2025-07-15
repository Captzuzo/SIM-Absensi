@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Tambah Absensi</h4>

    <form action="{{ route('pages.absensi.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Pegawai</label>
            <select name="pegawai_id" class="form-control" required>
                <option value="">-- Pilih Pegawai --</option>
                @foreach($pegawais as $pegawai)
                <option value="{{ $pegawai->id }}">{{ $pegawai->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Jam Masuk</label>
            <input type="time" name="jam_masuk" class="form-control">
        </div>

        <div class="form-group">
            <label>Jam Pulang</label>
            <input type="time" name="jam_pulang" class="form-control">
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="hadir">Hadir</option>
                <option value="izin">Izin</option>
                <option value="sakit">Sakit</option>
                <option value="alpha">Alpha</option>
            </select>
        </div>

        <button class="btn btn-success mt-3">Simpan</button>
    </form>
</div>
@endsection