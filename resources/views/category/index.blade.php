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
                   <h4 class="card-title">Category Table</h4>
                   <button class="btn btn-primary scrollButton">Add Category</button>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> Category ID</th>
                          <th> Category Name </th>
                          <th> Category Description </th>
                          <th> Date Created </th>
                          <th> Date Updated </th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                            @forelse($categories as $category)
                            <tr data-id="{{ $category->id }}">
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td style="color: {{ $category->description ? 'inherit' : 'blue' }};">{{ $category->description ? $category->description : 'N/A' }}</td>
                                <td style="color: {{ $category->created_at ? 'inherit' : 'blue' }};">{{ $category->created_at ? \Carbon\Carbon::parse($category->created_at)->format('M d, Y') : 'N/A' }}</td>
                                <td style="color: {{ $category->updated_at ? 'inherit' : 'blue' }};">{{ $category->updated_at ? \Carbon\Carbon::parse($category->updated_at)->format('M d, Y') : 'N/A' }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary scrollButton editButton">
                                        <i class="mdi mdi-pencil"></i> Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger deleteButton" data-id="{{ $category->id }}">
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
                  <h4 class="card-title text-center">Category Information</h4><hr>
                  <form action="{{ route('category.store') }}" method="POST" class="forms-sample">
                  @csrf

                    <input type="text" name="catID" id="catID" hidden>
                    <div class="form-group">
                        <label for="exampleInputFirstName">Category Name</label>
                        <input type="text" class="form-control" id="categoryName" name="name" placeholder="Category Name">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFirstName">Category Description</label>
                        <input type="text" class="form-control" id="desc" name="desc" placeholder="Category Description">
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
