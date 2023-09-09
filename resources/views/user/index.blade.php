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

                    <table class="table table-striped" id="userTable">
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
                            <td>{{ $user->fname . ' ' . $user->mname . ' ' . $user->lname }}</td>
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
                          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                      </div>
                      <div class="col">
                          <label for="exampleInputFirstName">Confirm Password</label>
                          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
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
        <script>
          
          $(document).ready(function(){
            $('#userTable').DataTable();
          });
          const userTable = document.getElementById('userTable');
          const userID = document.getElementById('userID');
          const fname = document.getElementById('fname');
          const mname = document.getElementById('mname');
          const lname = document.getElementById('lname');
          const email = document.getElementById('email');

          document.addEventListener('DOMContentLoaded', function () {
            
            userTable.addEventListener('click', async function (event) {

              const clickedElement = event.target;
              const row = clickedElement.closest('tr');

            if (clickedElement.classList.contains('editButton')) {

                const userId = row.getAttribute('data-id');
                try {
                    const userData = await fetchUserData(userId);

                    fname.value = userData.fname;
                    mname.value = userData.mname;
                    lname.value = userData.lname;
                    email.value = userData.email;
                    userID.value = userId;
                    
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

        async function fetchUserData(userId) {
            try {
                const response = await fetch(`/user/edit/${userId}`);

                if (response.ok) {
                    const userData = await response.json();
                    return userData;
                } else {
                    throw new Error('Failed to fetch book data');
                }
            } catch (error) {
                throw error;
            }
        }

        function clearInputFields() {
          fname.value = '';
          mname.value = '';
          lname.value = '';
          email.value = '';
          userID.value = '';
        }

         // Delete button click event
         document.addEventListener('DOMContentLoaded', function () {
          const deleteButtons = document.querySelectorAll('.deleteButton');

          deleteButtons.forEach(button => {
              button.addEventListener('click', function () {
                  const userId = this.getAttribute('data-id');

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
                          deleteUser(userId);
                      }
                });
           });
        });

        async function deleteUser(userId) {
          try {
              const response = await fetch(`/user/delete/${userId}`, {
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
                  const row = document.querySelector(`tr[data-id="${userId}"]`);
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
          const tableRows = document.querySelectorAll('#userTable tbody tr');

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
