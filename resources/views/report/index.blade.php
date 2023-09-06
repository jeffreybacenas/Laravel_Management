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
                  <h4 class="card-title">Reports</h4>
                  <div class="form-group d-flex justify-content-between align-items-center">
                      <select id="data-source" name="reportType" class="form-control">
                          <option value="">Select a report</option>
                          <option value="books">Books Report</option>
                          <option value="magazines">Magazine Report</option>
                          <option value="dvds">DVD Report</option>
                          <option value="users">User Report</option>
                          <option value="systemLogs">System Logs Report</option>
                      </select>
                  </div>
                </div>

                  <div class="table-responsive">
                    <table class="table table-striped" id="data-table">
                      <thead>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @include('partials._footer')
        <script>
          $('#data-source').change(function() {
            var selectedSource = $(this).val();

            // Make an AJAX request to retrieve data for the selected source
            $.ajax({
                url: '/reports/getData', // Replace with the actual URL to fetch data
                method: 'GET',
                data: { source: selectedSource },
                success: function(response) {
                    // Extract headers and data from the response
                    var columnHeaders = response.headers;
                    var data = response.data;
                    if(columnHeaders != null)
                    {
                      // Populate the table with headers and data
                      populateTable(columnHeaders, data);
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
          });

          function populateTable(columnHeaders, data) {
              // Clear existing table content
              $('#data-table').empty();
              
              // Add table headers based on the received column headers
              var tableHeaders = '<thead><tr>';
              for (var key in columnHeaders) {
                  tableHeaders += '<th>' + columnHeaders[key] + '</th>';
              }
              tableHeaders += '</tr></thead>';
              $('#data-table').append(tableHeaders);
              
              // Add table rows with data
              var tableBody = '<tbody>';
              for (var i = 0; i < data.length; i++) {
                  tableBody += '<tr>';
                  for (var key in data[i]) {
                      tableBody += '<td>' + data[i][key] + '</td>';
                  }
                  tableBody += '</tr>';
              }
              tableBody += '</tbody>';
              $('#data-table').append(tableBody);
          }

        </script>  
        @include('partials._script')
