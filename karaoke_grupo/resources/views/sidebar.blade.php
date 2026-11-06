<nav class="navbar navbar-expand-lg topo">
  <div class="container-fluid px-3">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ asset('imagens/logo.png') }}" alt="Karaokê &amp; Bar">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo01">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Início</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('sala*') ? 'active' : '' }}" href="{{ url('sala') }}">Salas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('reserva*') ? 'active' : '' }}" href="{{ url('reserva') }}">Reservas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('playlist*') ? 'active' : '' }}" href="{{ url('playlist') }}">Playlists</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('produto*') ? 'active' : '' }}" href="{{ url('produto') }}">Produtos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('compra*') ? 'active' : '' }}" href="{{ url('compra') }}">Compras</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('usuario*') ? 'active' : '' }}" href="{{ url('usuario') }}">Usuários</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
