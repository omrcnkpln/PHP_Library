Burası Profil Sayfası


<!-- Ayarlar Options -->
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <li class="nav-item">
        <div class="nav-link" role="button" onclick="event.preventDefault(); this.closest('form').submit();">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Çıkış Yap</span>
        </div>
    </li>
</form>
