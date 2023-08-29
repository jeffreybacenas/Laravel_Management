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
                   <h4 class="card-title">DVD</h4>
                   <button class="btn btn-primary scrollButton">Add DVD</button>
                 </div>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> DVD ID  </th>
                          <th> DVD Name </th>
                          <th> DVD Description </th>
                          <th> Date Created </th>
                          <th> Date Updated </th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                            @forelse($dvds as $dvd)
                            <tr data-id="{{ $dvd->id }}">
                            <td>{{ $dvd->id }}</td>
                                <td>{{ $dvd->name }}</td>
                                <td style="color: {{ $dvd->description ? 'inherit' : 'blue' }};">{{ $dvd->description ? $dvd->description : 'N/A' }}</td>
                                <td style="color: {{ $dvd->created_at ? 'inherit' : 'blue' }};">{{ $dvd->created_at ? \Carbon\Carbon::parse($dvd->created_at)->format('M d, Y') : 'N/A' }}</td>
                                <td style="color: {{ $dvd->created_at ? 'inherit' : 'blue' }};">{{ $dvd->created_at ? \Carbon\Carbon::parse($dvd->created_at)->format('M d, Y') : 'N/A' }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary scrollButton editButton">
                                        <i class="mdi mdi-pencil"></i> Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger deleteButton" data-id="{{ $dvd->id }}">
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
                  <h4 class="card-title text-center">DVD Information</h4><hr>
                  <form action="{{ route('dvd.store') }}" method="POST" class="forms-sample">
                    @csrf
                    <input type="text" name="dvdId" id="dvdId" hidden>
                    <div class="form-group">
                          <label>DVD Name</label>
                          <input type="text" class="form-control" id="name" name="name" placeholder="DVD Name">
                    </div>
                    <div class="form-group">
                          <label>DVD Description</label>
                          <input type="text" class="form-control" id="desc" name="dvdDesc" placeholder="DVD Description">
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
