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
                  
                 <div class="card-body d-flex justify-content-between">
                   <h4 class="card-title">Magazines</h4>
                   <button class="btn btn-primary scrollButton">Add Magazines</button>
                 </div>
                  <div class="table-responsive">
                    
                  <div class="table-controls d-flex text-center">
                     <div class="search-container ml-auto"> <!-- Add ml-auto to align to the right -->
                          <label for="searchInput" class="search-label">Search:</label>
                          <input type="text" id="searchInput" class="form-control form-control-sm search-input">
                     </div>
                  </div>
                    
                    <table class="table table-striped" id="magazineTable">
                      <thead>
                        <tr>
                          <th> Magazine ID </th>
                          <th> Magazines Name  </th>
                          <th> Magazines Description </th>
                          <th> Date Created </th>
                          <th> Date Created </th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                            @forelse($magazines as $magazine)
                            <tr data-id="{{ $magazine->id }}">
                                <td>{{ $magazine->id }}</td>
                                <td>{{ $magazine->name }}</td>
                                <td style="color: {{ $magazine->description ? 'inherit' : 'blue' }};">{{ $magazine->description ? $magazine->description : 'N/A' }}</td>
                                <td style="color: {{ $magazine->created_at ? 'inherit' : 'blue' }};">{{ $magazine->created_at ? \Carbon\Carbon::parse($magazine->created_at)->format('M d, Y') : 'N/A' }}</td>
                                <td style="color: {{ $magazine->created_at ? 'inherit' : 'blue' }};">{{ $magazine->created_at ? \Carbon\Carbon::parse($magazine->created_at)->format('M d, Y') : 'N/A' }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary scrollButton editButton">
                                        <i class="mdi mdi-pencil"></i> Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger deleteButton" data-id="{{ $magazine->id }}">
                                      <i class="mdi mdi-delete"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No records found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card" id="Info">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title text-center">Magazine Information</h4><hr>
                  <form action="{{ route('magazines.store') }}" method="POST" class="forms-sample">
                   @csrf
                   <input type="text" name="magazineId" id="magazineId" hidden>
                  <div class="form-group">
                        <label for="exampleInputFirstName">Magazine Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Magazine Name">
                  </div>
                  <div class="form-group">
                        <label for="exampleInputFirstName">Magazine Description</label>
                        <input type="text" class="form-control" id="desc" name="magazineDesc" placeholder="Magazine Description">
                  </div><br>

                    <div class="text-center"> <!-- Added this div with "text-center" class -->
                      <button type="submit" class="btn btn-success me-2 w-50">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        @include('partials._footer')
        <script>

          const magazineTable = document.getElementById('magazineTable');
          const magazineID = document.getElementById('magazineId');
          const magazineName = document.getElementById('name');
          const magazineDesc = document.getElementById('desc');

          document.addEventListener('DOMContentLoaded', function () {
            
            magazineTable .addEventListener('click', async function (event) {

              const clickedElement = event.target;
              const row = clickedElement.closest('tr');

            if (clickedElement.classList.contains('editButton')) {

                const magazineId = row.getAttribute('data-id');

                try {

                    const magazineData = await fetchMagazineData(magazineId);

                    magazineName.value = magazineData.name;
                    magazineDesc.value = magazineData.description;
                    magazineID.value = magazineId;

                } catch (error) {
                    console.error('An error occurred:', error);
                }
            }
        
          });

          const scrollButton = document.querySelector('.scrollButton');

            scrollButton.addEventListener('click', function () {
                clearInputFields();
            });

        });

        async function fetchMagazineData(magazineId) {
            try {
                const response = await fetch(`/magazines/edit/${magazineId}`);

                if (response.ok) {
                    const magazineData = await response.json();
                    return magazineData;
                } else {
                    throw new Error('Failed to fetch book data');
                }
            } catch (error) {
                throw error;
            }
        }

        function clearInputFields() {
          magazineName.value = '';
          magazineDesc.value = '';
          magazineID.value = '';

        }

        // Delete button click event
        document.addEventListener('DOMContentLoaded', function () {

          const deleteButtons = document.querySelectorAll('.deleteButton');

          deleteButtons.forEach(button => {
              button.addEventListener('click', function () {
                  const magazineId = this.getAttribute('data-id');

                  Swal.fire({
                      title: 'Are you sure?',
                      text: 'You won\'t be able to revert this!',
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          // Perform delete action
                          deleteMagazine(magazineId);
                      }
                });
           });
        });

        async function deleteMagazine(magazineId) {
          try {
              const response = await fetch(`/magazines/delete/${magazineId}`, {
                  method: 'DELETE',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                  }
              });
              
              const data = await response.json();
              // Handle the response and possibly remove the row from the table
              if (response.ok) {
                  Swal.fire({
                      icon: 'success',
                      title: data.message,
                      toast: true,
                      position: 'top-end', // Position the toast notification at the top-right corner
                      showConfirmButton: false,
                      timer: 5000 // Display for 5 seconds
                  });
                  // Remove the deleted row from the table
                  const row = document.querySelector(`tr[data-id="${magazineId}"]`);
                  if (row) {
                      row.remove();
                  }
              } else {
                Swal.fire({
                      icon: 'error',
                      title: data.message,
                      toast: true,
                      position: 'top-end', // Position the toast notification at the top-right corner
                      showConfirmButton: false,
                      timer: 5000 // Display for 5 seconds
                  });
              }
            } catch (error) {
              console.error('An error occurred:', error);
            }
          }
        });

    document.addEventListener('DOMContentLoaded', function () {
      const searchInput = document.getElementById('searchInput');
      const tableRows = document.querySelectorAll('#magazineTable tbody tr');

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
        @include('partials._script')
        @if ($errors->any())
          @foreach ($errors->all() as $error)
            <script>
                Swal.fire({
                    icon: 'error',
                    title: '{{ $error }}',
                    toast: true,
                    position: 'top-end', // Position the toast notification at the top-right corner
                    showConfirmButton: false,
                    timer: 5000 // Display for 5 seconds
                });
            </script>
        @endforeach
      @endif

      @if(session('success'))
          <script>
            Swal.fire({
                icon: 'success',
                title: '{{ session('success') }}',
                toast: true,
                position: 'top-end', // Position the toast notification at the top-right corner
                showConfirmButton: false,
                timer: 3000 // Display for 3 seconds
            });
          </script>
        @endif
