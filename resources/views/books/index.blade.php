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
                    <button class="btn btn-primary" id="addButton">Add Book</button>
                 </div>
                  <div class="table-responsive">
                    <table class="table table-striped">
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
                        <tr>
                        @forelse($books as $book)
                          <td>{{ $book->title }}</td>
                          <td>Herman Beck</td>
                          <td>$ 77.99</td>
                          <td>$ 77.99</td>
                          <td>May 15, 2015</td>
                        @empty
                          <td colspan="5" class="text-center">No records found.</td>
                        @endforelse
                        </tr>
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
                   
                    <div class="form-group">
                        <label >Book Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Book Title">
                    </div>
                    
                    <div class="form-group">
                        <label >Book Description</label>
                        <input type="text" class="form-control" name="description" placeholder="Book Description">
                    </div>

                    <div class="form-group">
                        <label>Book Author</label>
                        <input type="text" class="form-control" name="author" placeholder="Book Author">
                    </div>

                    <div class="form-group">
                    <label >Date Publish: </label>
                    <input type="date" class="form-control" name="datePublish">
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
