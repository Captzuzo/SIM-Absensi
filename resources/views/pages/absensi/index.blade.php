@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Data Absensi</h4>
        @if(auth()->user()->role->name === 'admin')
        <a href="{{ route('pages.pegawai.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-1"></i> Tambah Pegawai
        </a>
        @endif
    </div>
    @if(auth()->user()->role->name === 'admin')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Pegawai</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensis as $absensi)
            <tr>
                <td>{{ $absensi->pegawai->nama }}</td>
                <td>{{ $absensi->tanggal }}</td>
                <td>{{ $absensi->jam_masuk ?? '-' }}</td>
                <td>{{ $absensi->jam_pulang ?? '-' }}</td>
                <td>{{ ucfirst($absensi->status) }}</td>
                <td>
                    <form action="{{ route('pages.absensi.destroy', $absensi->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif


    @if(in_array(auth()->user()->role->name, ['pegawai', 'hrd', 'keuangan', 'manager']))

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Pegawai</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
                <th>Status</th>
                @if(auth()->user()->role->name !== 'pegawai')
                <th>Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($absensis as $absensi)
            <tr>
                <td>{{ $absensi->pegawai->nama }}</td>
                <td>{{ $absensi->tanggal }}</td>
                <td>{{ $absensi->jam_masuk ?? '-' }}</td>
                <td>{{ $absensi->jam_pulang ?? '-' }}</td>
                <td>{{ ucfirst($absensi->status) }}</td>
                @if(auth()->user()->role->name !== 'pegawai')
                <td>
                    <form action="{{ route('pages.absensi.destroy', $absensi->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection