@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">👋 Selamat datang, <strong>{{ Auth::user()->name }}</strong> <span class="text-muted">({{ ucfirst(Auth::user()->role->name) }})</span></h4>

    <div class="row g-4">
        <!-- Box: Total Users -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-gradient-warning text-white position-relative overflow-hidden h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-0 fw-semibold text-uppercase">Total Users</p>
                        <h2 class="fw-bold">{{ $totalUsers }}</h2>
                    </div>
                    <div class="display-4">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                <a href="{{ route('pages.users.index') }}" class="stretched-link text-white text-decoration-none text-center">
                    <div class="card-footer border-top-0 text-end text-white bg-transparent fw-medium">
                        Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                    </div>
                </a>
            </div>
        </div>

        <!-- Box Tambahan: Pegawai -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-gradient-primary text-white position-relative overflow-hidden h-100 ">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-0 fw-semibold text-uppercase">Total Pegawai</p>
                        <h2 class="fw-bold">{{ $totalPegawai }}</h2>
                    </div>
                    <div class="display-4">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <a href="{{ route('pages.users.index') }}" class="stretched-link text-white text-decoration-none text-center">
                    <div class="card-footer border-top-0 text-end text-white bg-transparent fw-medium">
                        Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                    </div>
                </a>
            </div>
        </div>

        <!-- Box Tambahan: Roles -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-gradient-danger text-white position-relative overflow-hidden h-100 ">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="mb-0 fw-semibold text-uppercase">Total Roles</p>
                        <h2 class="fw-bold">{{ $totalRoles }}</h2>
                    </div>
                    <div class="display-4">
                        <i class="fas fa-key"></i>
                    </div>
                </div>
                <a href="{{ route('pages.roles.index') }}" class="stretched-link text-white text-decoration-none text-center">
                    <div class="card-footer border-top-0 text-end text-white bg-transparent fw-medium">
                        Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .card:hover {
        transform: translateY(-3px);
        transition: all 0.3s ease-in-out;
    }

    .bg-gradient-warning {
        background: linear-gradient(45deg, #f0ad4e, #f7c04a);
    }

    .bg-gradient-primary {
        background: linear-gradient(45deg, #007bff, #339dff);
    }
</style>
@endsection