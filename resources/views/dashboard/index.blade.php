@include('partials._styles')
<body>


  <!-- <div class="container-scroller"> -->
      @include('partials._header')
      @include('partials._sidebar')
     
        <!-- partial -->
      <div class="main-panel">
        
        <div class="content-wrapper">

          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="statistics-details d-flex align-items-center justify-content-between">
                          
                         <div>
                              <p class="statistics-title">Total Books</p>
                              <h3 class="rate-percentage">{{ $bookCount }}</h3>
                              <input type="text" value="{{ $bookCount }}"  id="bookCount" hidden>
                          </div>

                          <div>
                            <p class="statistics-title">Total Magazines</p>
                            <h3 class="rate-percentage">{{ $magazineCount }}</h3>
                            <input type="text" value="{{ $magazineCount }}"  id="magazineCount" hidden>
                          </div>

                          <div>
                            <p class="statistics-title">Total DVDs</p>
                            <h3 class="rate-percentage">{{ $dvdCount }}</h3>
                            <input type="text" value="{{ $dvdCount }}"  id="dvdCount" hidden>
                          </div>

                          <div class="d-none d-md-block">
                            <p class="statistics-title">Total User </p>
                            <h3 class="rate-percentage">{{ $userCount }}</h3>
                            <input type="text" value="{{ $userCount }}"  id="userCount" hidden>
                          </div>


                        </div>
                      </div>
                    </div> 
                    <div class="row">
                      <div class="col-lg-8 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Library Resources</h4>
                                  </div>
                                </div>
                                <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                                  <div class="d-sm-flex align-items-center mt-4 justify-content-between"><h2 class="me-2 fw-bold">Library Collection.</h2></div>
                                  <div class="me-3"><div id="marketing-overview-legend"></div></div>
                                </div>
                                <div class="chartjs-bar-wrapper mt-3">
                                  <canvas id="marketingOverview"></canvas>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-4 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                      <h4 class="card-title card-title-dash">Library Resources</h4>
                                    </div>
                                    <canvas class="my-auto" id="doughnutChart" height="200"></canvas>
                                    <div id="doughnut-chart-legend" class="mt-5 text-center"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        @include('partials._footer')
        
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

        @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{ session('error') }}', // Use session('error') here
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
            });
        </script>
	      @endif

        

