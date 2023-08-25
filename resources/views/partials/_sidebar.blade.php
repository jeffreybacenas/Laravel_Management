
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('books') }}">
        <i class="mdi mdi-book menu-icon"></i>
        <span class="menu-title">Books</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('category') }}">
        <i class="mdi mdi-folder menu-icon"></i>
        <span class="menu-title">Category</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('usermanagement') }}">
        <i class="mdi mdi-account-group menu-icon"></i>
        <span class="menu-title">User Management</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('catalogmanagement') }}">
        <i class="mdi mdi-file-cabinet menu-icon"></i>
        <span class="menu-title">Catalog Management</span>
      </a>
    </li>

    <li class="nav-item">
     <a class="nav-link" href="{{ route('bookandreturn') }}">
      <i class="mdi mdi-book-open-variant menu-icon"></i>
      <span class="menu-title">Books And Returns</span>
     </a>
    </li>


    <li class="nav-item">
      <a class="nav-link" href="{{ route('magazines') }}">
        <i class="mdi mdi-newspaper menu-icon"></i>
        <span class="menu-title">Magazines</span>
      </a>
    </li>

  </ul>
</nav>