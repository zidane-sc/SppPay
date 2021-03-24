<div class="left-side-bar">
    <div class="brand-logo">
        <a href="{{ url('/home') }}">
            <img src="{{ asset('deskapp/src/images/deskapp-logo-black-fixed.png') }}" alt="" class="light-logo">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu icon-list-style-4">
            <ul id="accordion-menu">
                <li>
                    <a href="{{ url('/home') }}" class="dropdown-toggle no-arrow {{ (request()->segment(1) == 'home') ? 'active' : ''}}">
                        <span class="micon"><i class="icon-copy fa fa-home" aria-hidden="true"></i></span></span><span class="mtext">Dashboard</span>
                    </a>
                </li>
                @can('user')
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon"><i class="icon-copy fa fa-users" aria-hidden="true"></i></span><span class="mtext">Management Users</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('users.index') }}" class="{{ (request()->segment(1) == 'users' AND request()->segment(2) == "") ? 'active' : ''}}">Daftar Users</a></li>
                        <li><a href="{{ route('users.create') }}" class="{{ (request()->segment(2) == 'create') ? 'active' : ''}}">Tambah User</a></li>
                    </ul>
                </li>
                @endcan
                
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon"><i class="icon-copy fa fa-folder" aria-hidden="true"></i></span><span class="mtext">Data Master</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('jurusan.index') }}" class="{{ (request()->segment(1) == 'jurusan') ? 'active' : ''}}">Jurusan</a></li>
                        <li><a href="{{ route('kelas.index') }}" class="{{ (request()->segment(1) == 'kelas') ? 'active' : ''}}">Kelas</a></li>
                        <li><a href="{{ route('siswa.index') }}" class="{{ (request()->segment(1) == 'siswa') ? 'active' : ''}}">Siswa</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon"><i class="icon-copy fa fa-money" aria-hidden="true"></i></span><span class="mtext">Transaksi</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('pembayaran.create') }}" class="{{ (request()->segment(1) == 'pembayaran') ? 'active' : ''}}">Pembayaran Spp</a></li>
                        <li><a href="{{ route('spp.index') }}" class="{{ (request()->segment(1) == 'spp') ? 'active' : ''}}">Spp</a></li>
                    </ul>
                </li>
                @can('laporan')
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon"><i class="icon-copy fa fa-file-text" aria-hidden="true"></i></span></span><span class="mtext">Laporan</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('laporan.spp') }}" class="{{ (request()->segment(1) == 'jurusan') ? 'active' : ''}}">Laporan SPP</a></li>
                        <li><a href="{{ route('laporan.siswa') }}" class="{{ (request()->segment(1) == 'kelas') ? 'active' : ''}}">Laporan Siswa</a></li>
                        {{-- <li><a href="{{ route('siswa.index') }}" class="{{ (request()->segment(1) == 'siswa') ? 'active' : ''}}">Laporan </a></li> --}}
                    </ul>
                </li>
                @endcan

                <li>
                    <div class="dropdown-divider"></div>
                </li>

                <li>
                    <div class="sidebar-small-cap">Utilities</div>
                </li>
                <li>
                    
                </li>
                <li>
                    <a href="{{ route('users.profile', Auth::user()->id) }}" class="dropdown-toggle no-arrow {{ (request()->segment(1) == 'users') ? 'active' : ''}}">
                        <span class="micon"><i class="icon-copy fa fa-user" aria-hidden="true"></i></span></span><span class="mtext">My Profile</span>
                    </a>
                </li>
                @can('database', Model::class)
                <li>
                    <a href="{{ route('backup') }}" class="dropdown-toggle no-arrow {{ (request()->segment(1) == 'users') ? 'active' : ''}}">
                        <span class="micon"><i class="icon-copy fa fa-database" aria-hidden="true"></i></span></span><span class="mtext">Backup Database</span>
                    </a>
                </li>
                @endcan
                <li>
                    <a href="{{ route('calender') }}" class="dropdown-toggle no-arrow {{ (request()->segment(1) == 'users') ? 'active' : ''}}">
                        <span class="micon"><i class="icon-copy fa fa-calendar" aria-hidden="true"></i></span></span><span class="mtext">Calendar</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>