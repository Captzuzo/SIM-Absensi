@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <h4 class="mb-4"><i class="fas fa-user-plus text-primary me-2"></i>Tambah Roles</h4>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('pages.roles.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input name="name" id="name" class="form-control" value="{{ old('name', $role->name) }}" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('pages.roles.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection