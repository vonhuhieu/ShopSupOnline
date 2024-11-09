<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <div class="navbar-header" data-logobg="skin5">
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                <i class="ti-menu ti-close"></i>
            </a>
            <div class="navbar-brand">
                <a href="index.html" class="logo">
                    <b class="logo-icon">
                        <img src="{{ asset('/admin/assets/images/logo-icon.png') }}" alt="homepage" class="dark-logo" />
                        <img src="{{ asset('/admin/assets/images/logo-light-icon.png') }}" alt="homepage" class="light-logo" />
                    </b>
                    <span class="logo-text">
                        <img src="{{ asset('/admin/assets/images/logo-text.png') }}" alt="homepage" class="dark-logo" />
                        <img src="{{ asset('/admin/assets/images/logo-light-text.png') }}" class="light-logo" alt="homepage" />
                    </span>
                </a>
            </div>
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <i class="ti-more"></i>
            </a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin6">
            <ul class="navbar-nav float-left mr-auto">
                <li class="nav-item search-box">
                    <a class="nav-link waves-effect waves-dark" href="javascript:void(0)">
                        <div class="d-flex align-items-center">
                            <i class="mdi mdi-magnify font-20 mr-1"></i>
                            <div class="ml-1 d-none d-sm-block">
                                <span>Search</span>
                            </div>
                        </div>
                    </a>
                    <form class="app-search position-absolute">
                        <input type="text" class="form-control" placeholder="Search &amp; enter">
                        <a class="srh-btn">
                            <i class="ti-close"></i>
                        </a>
                    </form>
                </li>
            </ul>
            <ul class="navbar-nav float-right">
                <li class="nav-item dropdown">
                    <?php
                        use App\Models\User;
                        use Illuminate\Support\Facades\Auth;
                        $avatar = User::findOrFail(Auth::id())->avatar ?? '';
                    ?>
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href=""
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                            src="{{ asset('/admin/avatar/'.Auth::id().'/'.$avatar) }}" alt="user" class="rounded-circle" width="31"></a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated">
                        <a class="dropdown-item" href="{{ url('/admin/profile') }}"><i class="ti-user m-r-5 m-l-5"></i>Trang cá nhân</a>
                        <a class="dropdown-item" href="{{ url('/admin/logout_user') }}"><i class="ti-wallet m-r-5 m-l-5"></i>Đăng xuất</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>