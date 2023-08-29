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
                                <td colspan="5" class="text-center">No records found.</td>
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
                  <form class="forms-sample">

                  <div class="form-group">
                        <label for="exampleInputFirstName">Magazine Name</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Magazine Name">
                  </div>
                  <div class="form-group">
                        <label for="exampleInputFirstName">Magazine Description</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Magazine Description">
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
          const bookTitleInput = document.getElementById('bookTitleInput');
          const bookDescInput = document.getElementById('bookDescInput');

          document.addEventListener('DOMContentLoaded', function () {
            
            booksTable.addEventListener('click', async function (event) {

              const clickedElement = event.target;
              const row = clickedElement.closest('tr');

            if (clickedElement.classList.contains('editButton')) {

                const bookId = row.getAttribute('data-id');
                try {
                    const bookData = await fetchBookData(bookId);
                    bookTitleInput.value = bookData.title;
                    bookDescInput.value = bookData.description;
                    magazineID.value = bookId;
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

        async function fetchBookData(bookId) {
            try {
                const response = await fetch(`/books/edit/${bookId}`);

                if (response.ok) {
                    const bookData = await response.json();
                    return bookData;
                } else {
                    throw new Error('Failed to fetch book data');
                }
            } catch (error) {
                throw error;
            }
        }

        function clearInputFields() {
          bookTitleInput.value = '';
          bookDescInput.value = '';
          bookAuthorInput.value = '';
          bookPubDateInput.value = '';
          bookID.value = '';

        }

        // Delete button click event
        document.addEventListener('DOMContentLoaded', function () {
          const deleteButtons = document.querySelectorAll('.deleteButton');

          deleteButtons.forEach(button => {
              button.addEventListener('click', function () {
                  const bookId = this.getAttribute('data-id');

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
                          deleteBook(bookId);
                      }
                });
           });
        });

        async function deleteBook(bookId) {
          try {
              const response = await fetch(`/books/delete/${bookId}`, {
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
                  const row = document.querySelector(`tr[data-id="${bookId}"]`);
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
        @include('partials._script')
