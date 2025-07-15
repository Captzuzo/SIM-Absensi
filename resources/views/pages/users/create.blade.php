@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Tambah User</h4>
    <form action="{{ route('pages.users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama</label>
            <input name="name" class="form-control" placeholder="Masukkan Nama" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input name="email" type="email" class="form-control" placeholder="contoh : contoh@example.com" required>
        </div>
        <div class="form-group">
            <label for="role_id">Role</label>
            <select name="role_id" class="form-control" required>
                <option value="">-- Pilih Role --</option>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 position-relative">
            <label for="password" class="form-label">Password</label>
            <input name="password" id="password" type="password" class="form-control" placeholder="Masukkan Email" required>
            <i class="fas fa-eye toggle-password" data-target="password"></i>
        </div>
        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input name="password_confirmation" type="password" class="form-control" placeholder="Masukkan Konfirmasi Email" required>
        </div>
        <button class="btn btn-primary">Simpan</button>
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
<script>
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) {
            new bootstrap.Alert(alert).close();
        }
    }, 3000);
</script>
@endsection