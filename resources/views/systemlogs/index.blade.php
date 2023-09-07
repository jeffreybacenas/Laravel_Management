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
                   <h4 class="card-title">System Logs</h4>
                 </div>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> Module Name </th>
                          <th> Action Name  </th>
                          <th> Status </th>
                          <th> Remarks </th>
                          <th> Date Created </th>
                          <th> Date Updated </th>
                        </tr>
                      </thead>
                      <tbody>
                      @forelse($systemlogs as $systemlog)
                        <tr data-id="{{ $systemlog->id }}">
                            <td>{{ $systemlog->modulename }}</td>
                            <td>{{ $systemlog->actionname }}</td>
                            <td>{{ $systemlog->status  }}</td>
                            <td>{{ $systemlog->remarks  }}</td>
                            <td>{{  \Carbon\Carbon::parse($systemlog->created_at)->format('M d, Y')  }}</td>
                            <td >{{ \Carbon\Carbon::parse($systemlog->updated_at)->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No records found.</td>
                        </tr>
                        @endforelse                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @include('partials._footer')
        
        @include('partials._script')
