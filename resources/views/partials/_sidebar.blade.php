
<ul class="nav">
  <li class="nav-item">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('books') }}">
      <i class="mdi mdi-archive menu-icon"></i>
      <span class="menu-title">Books</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('category') }}">
      <i class="mdi mdi-animation menu-icon"></i>
      <span class="menu-title">Category</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('usermanagement') }}">
      <i class="mdi mdi-account-settings menu-icon"></i>
      <span class="menu-title">User Management</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('catalogmanagement') }}">
      <i class="mdi mdi-application menu-icon"></i>
      <span class="menu-title">Catalog Management</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('bookandreturn') }}">
      <i class="mdi mdi-airplay menu-icon"></i>
      <span class="menu-title">Books And Returns</span>
    </a>
  </li>
</ul>