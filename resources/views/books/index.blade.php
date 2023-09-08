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
                    <h4 class="card-title">Books Table</h4>
                    <div>
                      <button class="btn btn-primary rounded-pill px-4 scrollButton" >
                          <i class="mdi mdi-book-plus mr-2"></i> Add Book
                      </button>
                    </div>

                 </div>
                  <div class="table-responsive">
                    <table class="table table-striped" id="booksTable">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Author</th>
                                <th>Date Publish</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($books as $book)
                            <tr data-id="{{ $book->id }}">
                                <td>{{ $book->title }}</td>
                                <td style="color: {{ $book->description ? 'inherit' : 'blue' }};">{{ $book->description ? $book->description : 'N/A' }}</td>
                                <td style="color: {{ $book->author ? 'inherit' : 'blue' }};">{{ $book->author ? $book->author : 'N/A' }}</td>
                                <td style="color: {{ $book->publishdate ? 'inherit' : 'blue' }};">{{ $book->publishdate ? \Carbon\Carbon::parse($book->publishdate)->format('M d, Y') : 'N/A' }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary scrollButton editButton">
                                        <i class="mdi mdi-pencil"></i> Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger deleteButton" data-id="{{ $book->id }}">
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
                    <div class="pagination-container d-flex justify-content-center mt-3">
                      <ul class="pagination">
                          <!-- Pagination links will be added here dynamically -->
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card" id="Info">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title text-center">Book Information</h4><hr>
                  <form action="{{ route ('books.store') }}" method="POST" class="forms-sample">
                   @csrf

                    <input type="text" name="bookID" id="bookID" hidden>
                    <div class="form-group">
                        <label >Book Title</label>
                        <input type="text" class="form-control" id="bookTitleInput" name="title" placeholder="Book Title">
                    </div>
                    
                    <div class="form-group">
                        <label >Book Description</label>
                        <input type="text" class="form-control" id="bookDescInput" name="description" placeholder="Book Description">
                    </div>

                    <div class="form-group">
                        <label>Book Author</label>
                        <input type="text" class="form-control" id="bookAuthorInput" name="author" placeholder="Book Author">
                    </div>

                    <div class="form-group">
                    <label >Publish Date: </label>
                    <input type="date" class="form-control" id="bookPubDateInput" name="publishDate">
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
          $(document).ready(function(){
            $('#booksTable').DataTable();
          });

          const booksTable = document.getElementById('booksTable');
          const bookID = document.getElementById('bookID');
          const bookTitleInput = document.getElementById('bookTitleInput');
          const bookDescInput = document.getElementById('bookDescInput');
          const bookAuthorInput = document.getElementById('bookAuthorInput');
          const bookPubDateInput = document.getElementById('bookPubDateInput');

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
                    bookAuthorInput.value = bookData.author;
                    bookPubDateInput.value = bookData.publishdate;
                    bookID.value = bookId;
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
        

