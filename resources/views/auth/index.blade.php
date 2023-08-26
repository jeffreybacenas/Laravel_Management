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
              <form action="{{ route('performLogin')}}" method="POST" class="pt-3" >
              @csrf
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" name="email" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" name="password" placeholder="Password">
                </div>
                <div class="mt-3 text-center">
                <button type="submit" class="btn btn-block btn-facebook auth-form-btn center">
                  <i class="fa fa-facebook"></i> SIGN IN
                </button>

                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                  </div>
                </div>
                <div class="text-center mt-4 fw-light">
                  Don't have an account? <a href="{{ route('registration') }}" class="text-primary">Create</a>
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
