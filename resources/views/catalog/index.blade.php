@include('partials._styles')
<body>
  <!-- <div class="container-scroller"> -->
      @include('partials._header')
      @include('partials._sidebar')
        <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  
                <div class="card-body">
                  <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <h1 class="card-title mb-3">Search for what you seek within this library.</h1>
                    <div class="input-group input-group-sm mb-3">
                      <input type="text" class="form-control" placeholder="Enter what you seek.">
                      <button class="btn btn-outline-secondary" type="button">Search</button>
                    </div>
                  </div>
                </div>
                
                  <div class="table-responsive">
                    <table class="table table-striped">
                    <thead>
                      <tr>
                          <th>ID</th>
                          <th>Description</th>
                          <th>Date Created</th>
                          <th>Date Updated</th>
                      </tr>
                     </thead>
                    @forelse($catalogs as $catalog)
                        <tr data-id="{{ $catalog->id }}">
                            <td>{{ $catalog->id }}</td>
                            <td>
                              <span class="module">Module :</span>
                              <span>{{ $catalog->catalog }}</span>
                              <span class="info">Info:</span>
                              <span>{{ $catalog->description }}</span>
                            </td>

                            <td>{{  \Carbon\Carbon::parse($catalog->created_at)->format('M d, Y')  }}</td>
                            <td >{{ \Carbon\Carbon::parse($catalog->updated_at)->format('M d, Y') }}</td>
                            
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No records found.</td>
                        </tr>
                        @endforelse 
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
        @include('partials._footer')
        <script>
          document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('#booksTable tbody tr');

            searchInput.addEventListener('input', function () {
                const searchTerm = searchInput.value.trim().toLowerCase();

                tableRows.forEach(row => {
                    const rowData = row.textContent.toLowerCase();

                    if (rowData.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
          });
        </script>  
