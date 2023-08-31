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
                    @forelse($users as $user)
                        <tr data-id="{{ $user->id }}">
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email  }}</td>
                            <td>{{  \Carbon\Carbon::parse($user->created_at)->format('M d, Y')  }}</td>
                            <td >{{ \Carbon\Carbon::parse($user->updated_at)->format('M d, Y') }}</td>
                            <td>
                                <a class="btn btn-sm btn-primary scrollButton editButton">
                                    <i class="mdi mdi-pencil"></i> Edit
                                </a>
                                <button class="btn btn-sm btn-danger deleteButton" data-id="{{ $user->id }}">
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
            
          </div>
        </div>
        @include('partials._footer')
