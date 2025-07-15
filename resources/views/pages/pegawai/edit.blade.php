@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Data Pegawai</h4>

    {{-- Alert sukses / error --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <form action="{{ route('pages.pegawai.update', $pegawai->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>NIP</label>
            <input name="nip" type="number" class="form-control" value="{{ old('nip', $pegawai->nip) }}" required>
            @error('nip') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Nama Pegawai</label>
            <input name="nama" class="form-control" value="{{ old('nama', $pegawai->nama) }}" required>
            @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input name="email" type="email" class="form-control" value="{{ old('email', $pegawai->user->email) }}" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Role</label>
            <select name="role_id" class="form-control" required>
                <option value="">-- Pilih Role --</option>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ old('role_id', $pegawai->role_id) == $role->id ? 'selected' : '' }}>
                    {{ ucfirst($role->name) }}
                </option>
                @endforeach
            </select>
            @error('role_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Password Baru (opsional)</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi Password">
        </div>

        <div class="form-group">
            <label>Jenis Karyawan</label>
            <select name="jenis_karyawan" class="form-control" required>
                <option value="tetap" {{ old('jenis_karyawan', $pegawai->jenis_karyawan) == 'tetap' ? 'selected' : '' }}>Tetap</option>
                <option value="magang" {{ old('jenis_karyawan', $pegawai->jenis_karyawan) == 'magang' ? 'selected' : '' }}>Magang</option>
                <option value="outsourcing" {{ old('jenis_karyawan', $pegawai->jenis_karyawan) == 'outsourcing' ? 'selected' : '' }}>Outsourcing</option>
            </select>
            @error('jenis_karyawan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="aktif" {{ old('status', $pegawai->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="tidak" {{ old('status', $pegawai->status) == 'tidak' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-primary mt-3">Simpan Perubahan</button>
        <a href="{{ route('pages.pegawai.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>


{{-- Gaya & Script Toggle Password --}}
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
            const target = document.getElementById(this.dataset.target);
            const type = target.type === 'password' ? 'text' : 'password';
            target.type = type;
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });
</script>
@endsection