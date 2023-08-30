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
                   <h4 class="card-title">User Table</h4>
                   <button class="btn btn-primary scrollButton">Add User</button>
                  </div>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> User ID</th>
                          <th> Full Name </th>
                          <th> Email </th>
                          <th> Date Created </th>
                          <th> Date Updated </th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody>
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
            <div class="col-md-12 grid-margin stretch-card" id="Info">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title text-center">User Information</h4><hr>
                  <form action="{{ route('user.store') }}" method="POST" class="forms-sample">
                  @csrf
                  <input type="text" name="userID" id="userID" hidden>
                  <div class="form-group">
                    <div class="row">
                      <div class="col">
                        <label>First Name</label>
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name">
                      </div>
                      <div class="col">
                        <label for="exampleInputMiddleName">Middle Name</label>
                        <input type="text" class="form-control" id="mname" name="mname" placeholder="Middle Name">
                      </div>
                      <div class="col">
                        <label for="exampleInputLastName">Last Name</label>
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                      <label for="exampleInputPassword1">Email</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>

                    <div class="form-group">
                     <div class="row">
                      <div class="col">
                          <label for="exampleInputFirstName">Password</label>
                          <input type="text" class="form-control" id="password" name="password" placeholder="Password">
                      </div>
                      <div class="col">
                          <label for="exampleInputFirstName">Confirm Password</label>
                          <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password">
                      </div>
                     </div>
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
