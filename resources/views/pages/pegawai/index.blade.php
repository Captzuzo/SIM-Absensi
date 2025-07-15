@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Data Pegawai</h4>
        <a href="{{ route('pages.pegawai.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-1"></i> Tambah Pegawai
        </a>
    </div>


    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover table-striped align-middle text-center">
                <thead class="thead-dark">
                    <tr>
                        <th width="30">No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jenis Pegawai</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pegawai as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="text-start">{{ $item->nip }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->user->email }}</td>
                        <td>{{ $item->jenis_karyawan }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <span class="badge bg-info text-dark text-capitalize">{{ $item->role->name }}</span>
                        </td>
                        <td>
                            <a href="{{ route('pages.pegawai.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('pages.pegawai.destroy', $item->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt me-1"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Belum ada data pegawai.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection