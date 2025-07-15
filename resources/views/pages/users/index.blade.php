@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Data Users</h4>
        <a href="{{ route('pages.users.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-1"></i> Tambah User
        </a>
    </div>


    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-hover table-striped align-middle text-center">
                <thead class="thead-dark">
                    <tr>
                        <th width="30">#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="text-start">{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <span class="badge bg-info text-dark text-capitalize">{{ $item->role->name }}</span>
                        </td>
                        <td>
                            <a href="{{ route('pages.users.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('pages.users.destroy', $item->id) }}" method="POST" class="d-inline delete-form">
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
                        <td colspan="5" class="text-center text-muted">Belum ada data pengguna.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection