@extends('layouts.app2')
@section('content')
    <div class="row">
              <div class="col-sm-6">
                @guest
                <h3 class="mb-0 font-weight-bold">Guest</h3>
                @else
                <h3 class="mb-0 font-weight-bold">{{ Auth::user()->name }}</h3>
                @endguest
                <p>Your last login: 21h ago from newzealand.</p>
              </div>
              <div class="col-sm-6">
                <div class="d-flex align-items-center justify-content-md-end">
                  <div class="mb-3 mb-xl-0 pr-1">
                      <div class="dropdown">
                        <button class="btn bg-white btn-sm dropdown-toggle btn-icon-text border mr-2" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="typcn typcn-calendar-outline mr-2"></i>Last 7 days
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3" data-x-placement="top-start">
                          <h6 class="dropdown-header">Last 14 days</h6>
                          <a class="dropdown-item" href="#">Last 21 days</a>
                          <a class="dropdown-item" href="#">Last 28 days</a>
                        </div>
                      </div>
                  </div>
                  <div class="pr-1 mb-3 mr-2 mb-xl-0">
                    <button type="button" class="btn btn-sm bg-white btn-icon-text border"><i class="typcn typcn-arrow-forward-outline mr-2"></i>Export</button>
                  </div>
                  <div class="pr-1 mb-3 mb-xl-0">
                    <button type="button" class="btn btn-sm bg-white btn-icon-text border"><i class="typcn typcn-info-large-outline mr-2"></i>info</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="row  mt-3">
              <div class="col-xl-5 d-flex grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-between">
                      <h4 class="card-title mb-3">Input Stats This Week</h4>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <canvas id="myChart"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div>
            
          </div>

          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

          <script>
            async function loadChart() {
              const response = await fetch("/chart/blog-data");
              const result = await response.json();

              const ctx = document.getElementById('myChart').getContext('2d');

              new Chart(ctx, {
                type: 'bar',
                data: {
                  labels: result.labels,
                  datasets: [{
                    label: 'Blogs / Day',
                    data: result.data,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                  }]
                },
                options: {
                  responsive: true,
                  scales: {
                    y: {
                      beginAtZero: true,
                      ticks: {
                        stepSize: 1,
                        precision: 0
                      }
                    }
                  }
                }
              });
            }

            loadChart();
          </script>
@endsection