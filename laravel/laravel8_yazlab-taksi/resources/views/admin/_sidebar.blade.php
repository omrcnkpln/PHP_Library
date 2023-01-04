<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('profile-get')}}">
        <div class="sidebar-brand-text mx-3">Kullanıcı <br/>{{$user->name}}</div>
    </a>


    <!-- Dashboard Button -->
    <li class="nav-item active">
        <a class="nav-link" href="{{route('profile-get')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Ayarlar Options -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <li class="nav-item">
            <div class="nav-link" role="button" onclick="event.preventDefault(); this.closest('form').submit();">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Çıkış Yap</span></div>
        </li>
    </form>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
