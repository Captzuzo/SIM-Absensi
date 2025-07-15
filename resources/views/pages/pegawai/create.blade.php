@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Tambah Pegawai</h4>
    <form action="{{ route('pages.pegawai.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>NIP</label>
            <input name="nip" type="number" class="form-control" placeholder="Nomor Induk Pegawai" required>
        </div>
        <div class="form-group">
            <label>Nama Pegawai</label>
            <input name="nama" class="form-control" placeholder="Nama Lengkap Pegawai" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input name="email" type="email" class="form-control" placeholder="contoh@example.com" required>
        </div>
        <div class="form-group">
            <label for="role_id">Role</label>
            <select name="role_id" class="form-control" required>
                <option value="">-- Pilih Role --</option>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 position-relative">
            <label for="password" class="form-label">Password</label>
            <input name="password" id="password" type="password" class="form-control" placeholder="Password" required>
            <i class="fas fa-eye toggle-password" data-target="password"></i>
        </div>
        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input name="password_confirmation" type="password" class="form-control" placeholder="Ulangi Password" required>
        </div>

        <div class="form-group">
            <label>Jenis Karyawan</label>
            <select name="jenis_karyawan" class="form-control" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="tetap">Tetap</option>
                <option value="magang">Magang</option>
                <option value="outsourcing">Outsourcing</option>
            </select>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="">-- Pilih Jenis --</option>
                <option value="aktif">Aktif</option>
                <option value="tidak">Tidak Aktif</option>
            </select>
        </div>

        <button class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>

<style>
    .toggle-password {
        position: absolute;
        top: 38px;
        right: 15px;
        cursor: pointer;
        color: #6c757d;
    }
</style>

<script>
    document.querySelectorAll('.toggle-password').forEach(icon => {
        icon.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });
</script>
@endsection