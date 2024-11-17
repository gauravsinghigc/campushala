<div class="row">
  <div class="col-md-12">
    <div class='flex-s-b'>
      <h3 class="app-heading w-pr-80 m-t-0"><i class="fa fa-home"></i>Dashboard</h3>
      <?php if (LOGIN_UserType == 'Admin') { ?>
        <form>
          <select name="view" onchange="form.submit()" class="form-control form-control-sm">
            <?php InputOptions(["Admin Dashboard", "ACCOUNT", 'Lead Dashboard', 'CRM Dashboard', 'HR Dashboard', 'Reception Dashboard', 'Digital Dashboard'], IfRequested('GET', 'view', 'Lead Dashboard', false)); ?>
          </select>
        </form>
      <?php } ?>
    </div>
  </div>
</div>

<!-- <div class="row">
  <?php
  $FetchCallStatus = FETCH_DB_TABLE(CONFIG_DATA_SQL("VISITOR_TYPES"), true);
  if ($FetchCallStatus != null) {
    foreach ($FetchCallStatus as $Status) { ?>
      <div class="col-md-3 col-6 mb-10px">
        <a href="visitors/?view_for=<?php echo $Status->ConfigValueDetails; ?>">
          <div class="card card-window card-body rounded-3 p-4 shadow-lg">
            <div class="flex-s-b">
              <h2 class="count mb-0 m-t-5 h1">
                <?php echo TOTAL("SELECT * FROM visitors where VisitPersonType like '%" . $Status->ConfigValueDetails . "%'"); ?>
              </h2>
            </div>
            <p class="mb-0 fs-14 text-black">All <?PHP echo $Status->ConfigValueDetails; ?></p>
          </div>
        </a>
      </div>

  <?php }
  } ?>


</div> -->
<main id="main" class="main">
  <section class="section account-dashboard">
    <div class="row">
      <div class="col-lg-8">
        <div class="row">
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
              <div class="filter"> <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>
                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
              <?php $AllUniversity = FETCH("SELECT COUNT(university_id) AS TotalUniversity FROM universities_primary_details ", "TotalUniversity");
              ?>
              <div class="card-body account-card-body">
                <h5 class="card-title">All Universities <span>| Today</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bx bxs-school"></i></div>
                  <div class="ps-3">
                    <h6><?= $AllUniversity ?></h6> <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
              <div class="filter"> <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>
                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
              <?php $AllStudents = FETCH("SELECT COUNT(student_id) AS TotalStudents FROM students_primary_details ", "TotalStudents");
              ?>
              <div class="card-body account-card-body">
                <h5 class="card-title">All Students <span>| Today</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bx bxs-user"></i></div>
                  <div class="ps-3">
                    <h6><?= $AllStudents ?></h6> <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
              <div class="filter"> <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>
                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body account-card-body">
                <h5 class="card-title">Fees <span>| Today</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-currency-rupee"></i></div>
                  <div class="ps-3">
                    <h6>3,264</h6> <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
              <div class="filter"> <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>
                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
              <div class="card-body account-card-body">
                <h5 class="card-title">Fees Pending <span>| This month</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-currency-rupee"></i></div>
                  <div class="ps-3">
                    <h6>3,264</h6> <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
              <div class="filter"> <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>
                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
              <div class="card-body account-card-body">
                <h5 class="card-title">Invoices Paid <span>| This month</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-currency-rupee"></i></div>
                  <div class="ps-3">
                    <h6>3,264</h6> <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
              <div class="filter"> <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>
                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
              <div class="card-body account-card-body">
                <h5 class="card-title">Invoices Pending <span>| This month</span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-currency-rupee"></i></div>
                  <div class="ps-3">
                    <h6>3,264</h6> <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="col-12">
            <div class="card">
              <div class="filter"> <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>
                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
              <div class="card-body">
                <h5 class="card-title">Reports <span>/Today</span></h5>
                <div id="reportsChart"></div>
                <script>
                  document.addEventListener("DOMContentLoaded", () => {
                    new ApexCharts(document.querySelector("#reportsChart"), {
                      series: [{
                        name: 'Invoices',
                        data: [31, 40, 28, 51, 42, 82, 56],
                      }, {
                        name: 'Fees',
                        data: [11, 32, 45, 32, 34, 52, 41]
                      }, {
                        name: 'Revenue',
                        data: [15, 11, 32, 18, 9, 24, 11]
                      }],
                      chart: {
                        height: 350,
                        type: 'area',
                        toolbar: {
                          show: false
                        },
                      },
                      markers: {
                        size: 5
                      },
                      colors: ['#4154f1', '#2eca6a', '#ff771d'],
                      fill: {
                        type: "gradient",
                        gradient: {
                          shadeIntensity: 1,
                          opacityFrom: 0.3,
                          opacityTo: 0.4,
                          stops: [0, 90, 100]
                        }
                      },
                      dataLabels: {
                        enabled: false
                      },
                      stroke: {
                        curve: 'smooth',
                        width: 1
                      },
                      xaxis: {
                        type: 'datetime',
                        categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                      },
                      tooltip: {
                        x: {
                          format: 'dd/MM/yy HH:mm'
                        },
                      }
                    }).render();
                  });
                </script>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="col-lg-4">
        <div class="card">
          <div class="filter"> <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
                <h6>Filter</h6>
              </li>
              <li><a class="dropdown-item" href="#">Today</a></li>
              <li><a class="dropdown-item" href="#">This Month</a></li>
              <li><a class="dropdown-item" href="#">This Year</a></li>
            </ul>
          </div>
          <div class="card-body report-card-body">
            <h5 class="card-title report-card-title">Recent Transactions <span>| Today</span></h5>
            <div class="activity account-dashboard">
              <div class="activity-item d-flex">
                <div class="activite-label">32 min</div> <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                <div class="activity-content"> Quia quae rerum <a href="#" class="fw-bold text-dark">explicabo officiis</a> beatae</div>
              </div>
              <div class="activity-item d-flex">
                <div class="activite-label">56 min</div> <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                <div class="activity-content"> Voluptatem blanditiis blanditiis eveniet</div>
              </div>
              <div class="activity-item d-flex">
                <div class="activite-label">2 hrs</div> <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                <div class="activity-content"> Voluptates corrupti molestias voluptatem</div>
              </div>
              <div class="activity-item d-flex">
                <div class="activite-label">1 day</div> <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                <div class="activity-content"> Tempore autem saepe <a href="#" class="fw-bold text-dark">occaecati voluptatem</a> tempore</div>
              </div>
              <div class="activity-item d-flex">
                <div class="activite-label">2 days</div> <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                <div class="activity-content"> Est sit eum reiciendis exercitationem</div>
              </div>
              <div class="activity-item d-flex">
                <div class="activite-label">4 weeks</div> <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                <div class="activity-content"> Dicta dolorem harum nulla eius. Ut quidem quidem sit quas</div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="filter"> <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
              <li class="dropdown-header text-start">
                <h6>Filter</h6>
              </li>
              <li><a class="dropdown-item" href="#">Today</a></li>
              <li><a class="dropdown-item" href="#">This Month</a></li>
              <li><a class="dropdown-item" href="#">This Year</a></li>
            </ul>
          </div>
          <div class="card-body pb-0">
            <h5 class="card-title">Revenue Report <span>| This Month</span></h5>
            <div id="budgetChart" style="min-height: 400px;" class="echart"></div>
            <script>
              document.addEventListener("DOMContentLoaded", () => {
                var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                  legend: {
                    data: ['Allocated Budget', 'Actual Spending']
                  },
                  radar: {
                    // shape: 'circle',
                    indicator: [{
                        name: 'Fee Collected',
                        max: 6500
                      },
                      {
                        name: 'Payment Sent',
                        max: 12000
                      },
                      {
                        name: 'Revenue',
                        max: 1000
                      },
                    ]
                  },
                  series: [{
                    name: 'Budget vs spending',
                    type: 'radar',
                    data: [{
                        value: [4200, 3000],
                        name: 'Fee Collected'
                      },
                      {
                        value: [5000, 14000],
                        name: 'Payment Sent'
                      }
                    ]
                  }]
                });
              });
            </script>
          </div>
        </div>

      </div>
    </div>
  </section>
</main>