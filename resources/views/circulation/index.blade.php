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
                  <form class="forms-sample">

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
        @include('partials._script')
