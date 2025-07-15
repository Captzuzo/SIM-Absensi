<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard') }}" class="brand-link text-center">
        <span class="brand-text font-weight-light">SIM Absensi</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            @php $role = auth()->user()->role->name; @endphp
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- MENU DATA MASTER --}}
                @if(in_array($role, ['admin', 'hrd', 'keuangan']))
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Data Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ps-3">
                        @if($role === 'admin')
                        <li class="nav-item"><a href="{{ route('pages.users.index') }}" class="nav-link"><i class="far fa-circle nav-icon"></i>
                                <p>Kelola User</p>
                            </a></li>
                        <li class="nav-item"><a href="{{ route('pages.roles.index') }}" class="nav-link"><i class="far fa-circle nav-icon"></i>
                                <p>Kelola Role</p>
                            </a></li>
                        @endif
                        <li class="nav-item"><a href="{{ route('pages.pegawai.index') }}" class="nav-link"><i class="far fa-circle nav-icon"></i>
                                <p>Kelola Pegawai</p>
                            </a></li>
                    </ul>
                </li>
                @endif

                {{-- MENU TRANSAKSI --}}
                @if(in_array($role, ['admin', 'hrd', 'pegawai']))
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>
                            Transaksi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ps-3">
                        <li class="nav-item"><a href="{{ route('pages.absensi.index') }}" class="nav-link"><i class="far fa-circle nav-icon"></i>
                                <p>Absensi Harian</p>
                            </a></li>
                        <li class="nav-item"><a href="{{ route('pages.absensi.create-login') }}" class="nav-link"><i class="far fa-circle nav-icon"></i>
                                <p>Absensi Masuk</p>
                            </a></li>
                        <li class="nav-item"><a href="{{ route('pages.pengajuan-izin.index') }}" class="nav-link"><i class="far fa-circle nav-icon"></i>
                                <p>Pengajuan Izin</p>
                            </a></li>
                        @if(in_array($role, ['admin', 'hrd']))
                        <li class="nav-item"><a href="{{ route('pages.pengajuan-izin.data') }}" class="nav-link"><i class="far fa-circle nav-icon"></i>
                                <p>Data Pengajuan Izin</p>
                            </a></li>
                        <li class="nav-item"><a href="#" class="nav-link"><i class="far fa-circle nav-icon"></i>
                                <p>Evaluasi</p>
                            </a></li>
                        @endif
                    </ul>
                </li>
                @endif

                {{-- MENU LAPORAN --}}
                @if(in_array($role, ['admin', 'hrd', 'keuangan', 'manager']))
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview ps-3">
                        <li class="nav-item"><a href="{{route('pages.laporan-absensi.index')}}" class="nav-link"><i class="far fa-circle nav-icon"></i>
                                <p>Rekap Kehadiran</p>
                            </a></li>
                        <li class="nav-item"><a href="#" class="nav-link"><i class="far fa-circle nav-icon"></i>
                                <p>Laporan Tunjangan</p>
                            </a></li>
                        <li class="nav-item"><a href="#" class="nav-link"><i class="far fa-circle nav-icon"></i>
                                <p>Evaluasi Karyawan</p>
                            </a></li>
                    </ul>
                </li>
                @endif

                {{-- MENU LAINNYA (Backup, dll) --}}
                @if($role === 'admin')
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-cogs nav-icon"></i>
                        <p>Konfigurasi Sistem</p>
                    </a></li>
                <li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-download nav-icon"></i>
                        <p>Backup Data</p>
                    </a></li>
                @endif

            </ul>
        </nav>
    </div>
</aside>