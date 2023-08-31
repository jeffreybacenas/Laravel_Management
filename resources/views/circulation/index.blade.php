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
                   <h4 class="card-title">Books And Returns</h4>
                   <button class="btn btn-primary scrollButton">Add borrow</button>
                 </div>
                  <div class="table-responsive">
                  <div class="table-controls d-flex text-center">
                      <div class="search-container ml-auto"> <!-- Add ml-auto to align to the right -->
                          <label for="searchInput" class="search-label">Search:</label>
                          <input type="text" id="searchInput" class="form-control form-control-sm search-input">
                      </div>
                    </div>
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> Book Title  </th>
                          <th> Date Barrowed </th>
                          <th> Status </th>
                          <th> Borrower </th>
                          <th> Deadline </th>
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
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card" id="Info">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title text-center">Books And Returns Information</h4><hr>
                  <form action="{{ route ('bookandreturn.store') }}" method="POST" class="forms-sample">
                   @csrf

                   <div class="form-group">
                      <label for="bookSelection">Select a Book: </label>
                      <select class="form-control" id="bookSelection">
                       <option value="the-notebook">The Notebook</option>
                       <option value="the-dog">The Dog</option>
                       <option value="the-cat">The Cat</option>
                       <option value="the-egg">The Egg</option>
                     </select>
                  </div>

                  <div class="form-group">
                      <label for="bookSelection">Select a User: </label>
                      <select class="form-control" id="bookSelection">
                       <option value="the-notebook">The Notebook</option>
                       <option value="the-dog">The Dog</option>
                       <option value="the-cat">The Cat</option>
                       <option value="the-egg">The Egg</option>
                     </select>
                  </div>

                  <div class="form-group">
                    <label for="dueDate">Due Date:</label>
                    <input type="date" class="form-control" id="dueDate">
                  </div><br>

                    <div class="text-center"> <!-- Added this div with "text-center" class -->
                      <button type="submit" class="btn btn-primary me-2 w-50">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        @include('partials._footer')
        <script>

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