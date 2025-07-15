@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Form Pengajuan Izin</h4>
    <form action="{{ route('pages.pengajuan-izin.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Jenis Izin</label>
            <select name="jenis_izin" class="form-control" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="sakit">Sakit</option>
                <option value="cuti">Cuti</option>
                <option value="izin">Izin</option>
            </select>
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3"></textarea>
        </div>

        <button class="btn btn-primary mt-3">Ajukan Izin</button>
    </form>
</div>
@endsection