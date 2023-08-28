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
                                    <a href="" class="btn btn-sm btn-danger">
                                        <i class="mdi mdi-delete"></i> Delete
                                    </a>
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
        }

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
        

