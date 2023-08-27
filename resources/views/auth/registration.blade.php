@include('partials._styles')

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
              <div class="text-center mt-5 fw-light ">
                  <h3 class="text-primary">Library Software Login</h3> 
                </div>
              </div>
              <form action="{{ route('registration.store') }}" method="POST" class="pt-3">
               @csrf
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="fname" value="{{ old('fname') }}" placeholder="FirstName">
                </div>
                
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" name="lname" value="{{ old('lname') }}"  placeholder="LastName">
                </div>
                
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" placeholder="email">
                </div>

                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" placeholder="Password">
                </div>

                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="ConfirmPassword">
                </div>

                <div class="mt-3 text-center">
                    <button type="submit" class="btn btn-block btn-facebook auth-form-btn center">
                    <i class="fa fa-facebook"></i> SIGN UP
                    </button>
                </div>

                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                  </div>
                </div>
                <div class="text-center mt-4 fw-light">
                   Already have an account? <a href="{{ route('login') }}" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
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


