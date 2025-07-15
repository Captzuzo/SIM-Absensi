@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <h4 class="mb-4">
                <i class="fas fa-user-edit text-primary me-2"></i>Edit User
            </h4>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('pages.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input name="name" id="name" class="form-control"
                                value="{{ old('name', $user->name) }}" required>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" id="email" type="email" class="form-control"
                                value="{{ old('email', $user->email) }}" required>
                        </div>

                        {{-- Role --}}
                        <div class="mb-3">
                            <label for="role_id" class="form-label">Role</label>
                            <select name="role_id" id="role_id" class="form-control" required>
                                <option value="">-- Pilih Role --</option>
                                @foreach ($roles as $r)
                                <option value="{{ $r->id }}"
                                    {{ old('role_id', $user->role_id) == $r->id ? 'selected' : '' }}>
                                    {{ ucfirst($r->name) }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Password (Opsional) --}}
                        <div class="mb-3 position-relative">
                            <label for="password" class="form-label">
                                Password
                            </label>
                            <input name="password" id="password" type="password" class="form-control" placeholder="Masukkan password baru (opsional)">
                            <i class="fas fa-eye toggle-password" data-target="password"></i>
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('pages.users.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-save me-1"></i> Update
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
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