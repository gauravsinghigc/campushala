<?php
include __DIR__ . "/../../config/processor.php";

$PageName = "Students"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo $PageName; ?> @ <?php echo SYS_INFO['app']['name']; ?></title>
  <meta name="robots" content="noindex, nofollow">
  <meta content="" name="description">
  <meta content="" name="keywords">
  <?php include __DIR__ . "/../../assets/HeaderFiles.php"; ?>
</head>

<body>
  <?php
  include __DIR__ . "/../../includes/Header.php";
  include __DIR__ . "/../../includes/Sidebar.php";
  ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <div class="flex-s-b">
        <div>
          <h1>All <?php echo $PageName; ?></h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $PageName; ?></li>
            </ol>
          </nav>
        </div>
        <div class="p-1">
          <a href="add/" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i> Add <?php echo $PageName; ?></a>
        </div>
      </div>
    </div>
    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-xxl-3 col-md-4">
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
                <div class="card-body">
                  <h5 class="card-title">All <?php echo $PageName; ?> <span>| Today</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bx bxs-school"></i></div>
                    <div class="ps-3">
                      <h6>145</h6> <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xxl-3 col-md-4">
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
                <div class="card-body">
                  <h5 class="card-title">Active <?php echo $PageName; ?> <span>| Today</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bx bxs-user"></i></div>
                    <div class="ps-3">
                      <h6>145</h6> <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xxl-3 col-md-4">
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
                <div class="card-body">
                  <h5 class="card-title">Inactive <?php echo $PageName; ?> <span>| Today</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"> <i class="bi bi-currency-rupee"></i></div>
                    <div class="ps-3">
                      <h6>3,264</h6> <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body pt-4">
              <table class="table datatable mt-3">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Students Name</th>
                    <th scope="col">Course Name</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Status</th>
                    <th scope="col">Fee Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>
                      <a href="details/">Rahul Sharma</a>
                    </td>
                    <td>BCA</td>
                    <td>3rd Sem</td>
                    <td>Active</td>
                    <td>Rs.45000/Rs.15000</td>
                    <td>
                      <a href="#" class="text-info"><i class='bi bi-gear-fill'></i></a>
                    </td>
                  </tr>

                  <tr>
                    <td>2</td>
                    <td>
                      <a href="details/">Rahul Sharma</a>
                    </td>
                    <td>BCA</td>
                    <td>3rd Sem</td>
                    <td>Active</td>
                    <td>Rs.45000/Rs.15000</td>
                    <td>
                      <a href="#" class="text-info"><i class='bi bi-gear-fill'></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>
                      <a href="details/">Rahul Sharma</a>
                    </td>
                    <td>BCA</td>
                    <td>3rd Sem</td>
                    <td>Active</td>
                    <td>Rs.45000/Rs.15000</td>
                    <td>
                      <a href="#" class="text-info"><i class='bi bi-gear-fill'></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>
                      <a href="details/">Rahul Sharma</a>
                    </td>
                    <td>BCA</td>
                    <td>3rd Sem</td>
                    <td>Active</td>
                    <td>Rs.45000/Rs.15000</td>
                    <td>
                      <a href="#" class="text-info"><i class='bi bi-gear-fill'></i></a>
                    </td>
                  </tr>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php
  include __DIR__ . "/../../includes/Footer.php";
  include __DIR__ . "/../../assets/FooterFiles.php";
  ?>
</body>

</html>