<style>
.nav-link {color: grey}
.nav-link:hover {color: black}
.navbar-nav .nav-link.active{color: black}
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-light ">
  <div class="container">
    <a href="/" class="d-flex align-items-center me-3 mb-2 mb-lg-0 text-white text-decoration-none">
      <img src="img/logopnj.png" alt="logo" width="75" height="75">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ $active === 'home' ? 'active' : '' }}"  href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $active === 'about' ? 'active' : '' }}" href="/about">About</a>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link {{ $active === 'posts' ? 'active' : '' }}" href="/posts">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ $active === 'categories' ? 'active' : '' }}" href="/categories">Categories</a>
        </li> --}}
      </ul>
    </div>
    
    @auth
    <div class="text-end dropdown">
      <a href="#" class="dropdown-toggle px-4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Welcome back, {{ auth()->user()->name }}
      </a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="/dashboard/index"><i class="bi bi-layout-text-sidebar-reverse"></i> My Dashboard</a></li>
        <li><hr class="dropdown-divider"></li>
        <li>
          <form action="/logout" method="post">
            @csrf
            <button type="submit" class="dropdown-item">
              <i class="bi bi-box-arrow-right"></i> Logout
            </button>
          </form>
      </ul>
    </div>
    @else
    <div class="text-end">
      <a href="/login" class="btn btn-outline-primary px-4">Login</a>
    </div>
    @endauth
  </div>
</nav>

