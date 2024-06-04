<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-lg-0 mb-2 me-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cotacoes.list') }}">Cotações</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('pedidos.list') }}">Pedidos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('notas.list') }}">Notas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                </li>
            </ul>
            <div class="d-flex">
                <ul class="navbar-nav mb-lg-0 mb-2 me-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          {{ Auth::user()->name}}
                        </a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{ route('profile.edit')}}">Profile</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="{{route('user.logout')}}">Logout</a></li>
                        </ul>
                      </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
