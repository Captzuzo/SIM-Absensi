@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Tambah Roles</h4>
    <form action="{{ route('pages.roles.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama</label>
            <input name="name" class="form-control" placeholder="Masukkan Nama" required>
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