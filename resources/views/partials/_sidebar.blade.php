
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
      <a class="nav-link" href="{{ route('user') }}">
        <i class="mdi mdi-account-group menu-icon"></i>
        <span class="menu-title">User</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('catalog') }}">
        <i class="mdi mdi-file-cabinet menu-icon"></i>
        <span class="menu-title">Catalog</span>
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

    <li class="nav-item">
      <a class="nav-link" href="{{ route('dvd') }}">
        <i class="mdi mdi-disc menu-icon"></i>
        <span class="menu-title">DVD</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('reports') }}">
        <i class="mdi mdi-chart-pie menu-icon"></i>
        <span class="menu-title">Reports</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('systemlogs') }}">
        <i class="mdi mdi-file-document-box-outline menu-icon"></i>
        <span class="menu-title">System Logs</span>
      </a>
    </li>



  </ul>
</nav>