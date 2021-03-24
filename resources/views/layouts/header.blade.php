{{-- Loading --}}

<div class="pre-loader">
    <div class="pre-loader-box">
        <div class="loader-logo"><img src="{{ asset('deskapp/src/images/deskapp-logo-white.png') }}" alt=""></div>
        <div class='loader-progress' id="progress_div">
            <div class='bar' id='bar1'></div>
        </div>
        <div class='percent' id='percent1'>0%</div>
        <div class="loading-text">
            Loading...
        </div>
    </div>
</div>

<div class="header">
    <div class="header-left">
        <div class="menu-icon dw dw-menu ml-3"></div>
    </div>
    <div class="header-right">
        <div class="user-info-dropdown mr-3">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <span class="user-icon">
                        {{-- <img src="{{ asset('deskapp/vendors/images/photo1.jpg') }}" height="20px" alt=""> --}}
                        @if (Auth::user()->avatar)
                            <img src="{{ asset('storage/'.Auth::user()->avatar) }}" width="50px">
                        @else
                            <img src="{{ asset('deskapp/src/images/no-image.png') }}" width="50px">
                        @endif
                    </span>
                    <span class="user-name">{{ Auth::user()->username }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a class="dropdown-item" href="{{ route("users.profile", Auth::user()->id) }}"><i class="dw dw-user1"></i> Profile</a>
                    {{-- <a class="dropdown-item" href="profile.php"><i class="dw dw-settings2"></i> Setting</a>
                    <a class="dropdown-item" href="faq.php"><i class="dw dw-help"></i> Help</a> --}}
                    <form action="{{ route("logout") }}" method="POST">
                        @csrf
                        <button class="dropdown-item"><i class="dw dw-logout"></i> Log Out</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>