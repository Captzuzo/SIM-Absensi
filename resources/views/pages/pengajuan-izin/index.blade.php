@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Pengajuan Izin</h4>
        <a href="{{ route('pages.pengajuan-izin.create') }}" class="btn btn-primary mb-3">Ajukan Izin</a>
    </div>

    <!-- @if(in_array(auth()->user()->role->name, ['hrd', 'admin', 'pegawai']))
    <a href="{{ route('pages.pengajuan-izin.create') }}" class="btn btn-primary mb-3">Ajukan Izin</a>
    @endif -->

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Pegawai</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Jenis Izin</th>
                <th>Keterangan</th>
                <th>Status</th>
                @if(in_array(auth()->user()->role->name, ['admin', 'hrd']))
                <th>Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($izin as $data)
            <tr>
                <td>{{ $data->pegawai?->nama ?? '-' }}</td>
                <td>{{ $data->tanggal_mulai }}</td>
                <td>{{ $data->tanggal_selesai }}</td>
                <td>{{ ucfirst($data->jenis_izin) }}</td>
                <td>{{ $data->keterangan }}</td>
                <td>
                    @php
                    $badgeClass = match($data->status) {
                    'disetujui' => 'success',
                    'ditolak' => 'danger',
                    'menunggu' => 'secondary',
                    default => 'light'
                    };
                    @endphp
                    <span class="badge bg-{{ $badgeClass }}">{{ ucfirst($data->status) }}</span>
                </td>

                @if(in_array(auth()->user()->role->name, ['admin', 'hrd']))
                <td>
                    @if($data->status === 'menunggu')
                    <form action="{{ route('pages.pengajuan-izin.approve', $data->id) }}" method="POST" class="d-inline">
                        @csrf @method('PUT')
                        <button class="btn btn-success btn-sm">Setujui</button>
                    </form>
                    <form action="{{ route('pages.pengajuan-izin.reject', $data->id) }}" method="POST" class="d-inline">
                        @csrf @method('PUT')
                        <button class="btn btn-danger btn-sm">Tolak</button>
                    </form>
                    @else
                    <em>Tindakan selesai</em>
                    @endif
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection