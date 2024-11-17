<?php
include __DIR__ . "/../../../config/processor.php";

$PageName = "Collect Fees"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo $PageName; ?> @ <?php echo SYS_INFO['app']['name']; ?></title>
  <meta name="robots" content="noindex, nofollow">
  <meta content="" name="description">
  <meta content="" name="keywords">
  <?php include __DIR__ . "/../../../assets/HeaderFiles.php"; ?>
</head>

<body>
  <?php
  include __DIR__ . "/../../../includes/Header.php";
  include __DIR__ . "/../../../includes/Sidebar.php";
  ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <div class="flex-s-b">
        <div>
          <h1><?php echo $PageName; ?></h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo DOMAIN; ?>/app">Home</a></li>
              <li class="breadcrumb-item"><a href="<?php echo DOMAIN; ?>/app">Students</a></li>
              <li class="breadcrumb-item active"><?php echo $PageName; ?></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <form action=''>
                <div class="form-group">
                  <label>Search Active Student</label>
                  <input type='search' name='' class="form-control">
                </div>
              </form>
              <ul class="record-list">
                <li>
                  <div>
                    <h6 class="bold mb-0">Rahul Sharma </h6>
                    <p class='flex-s-b mb-0'>
                      <span>
                        <span class="text-secondary">Course name</span><br>
                        <span>BCA (2022-2025)</span>
                      </span>
                      <span>
                        <span class="text-secondary">Semester</span><br>
                        <span>2nd Sem </span>
                      </span>
                    </p>
                    <p class="mb-0">
                      <i class="bi bi-building"></i> BIMT Institute
                    </p>
                  </div>
                </li>

                <li>
                  <div>
                    <h6 class="bold mb-0">Rahul Sharma </h6>
                    <p class='flex-s-b mb-0'>
                      <span>
                        <span class="text-secondary">Course name</span><br>
                        <span>BCA (2022-2025)</span>
                      </span>
                      <span>
                        <span class="text-secondary">Semester</span><br>
                        <span>2nd Sem </span>
                      </span>
                    </p>
                    <p class="mb-0">
                      <i class="bi bi-building"></i> BIMT Institute
                    </p>
                  </div>
                </li>

                <li>
                  <div>
                    <h6 class="bold mb-0">Rahul Sharma </h6>
                    <p class='flex-s-b mb-0'>
                      <span>
                        <span class="text-secondary">Course name</span><br>
                        <span>BCA (2022-2025)</span>
                      </span>
                      <span>
                        <span class="text-secondary">Semester</span><br>
                        <span>2nd Sem </span>
                      </span>
                    </p>
                    <p class="mb-0">
                      <i class="bi bi-building"></i> BIMT Institute
                    </p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Active Courses/Semester</h5>
              <ul class="record-list">
                <li>
                  <div>
                    <p class='flex-s-b mb-0'>
                      <span>
                        <span class="text-secondary">Semester</span><br>
                        <span>1st Sem </span>
                      </span>
                    </p>
                    <p class="mb-0 flex-s-b">
                      <span><i class="bi bi-inr"></i> Rs.50000</span>
                      <span class="text-success"><i class="bi bi-check"></i> Paid</span>
                    </p>
                  </div>
                </li>

                <li>
                  <div>
                    <p class='flex-s-b mb-0'>
                      <span>
                        <span class="text-secondary">Semester</span><br>
                        <span>2nd Sem </span>
                      </span>
                    </p>
                    <p class="mb-0 flex-s-b">
                      <span><i class="bi bi-inr"></i> Rs.50000</span>
                      <span class="text-success"><i class="bi bi-check"></i> Paid</span>
                    </p>
                  </div>
                </li>

                <li>
                  <div>
                    <p class='flex-s-b mb-0'>
                      <span>
                        <span class="text-secondary">Semester</span><br>
                        <span>2rd Sem </span>
                      </span>
                    </p>
                    <p class="mb-0 flex-s-b">
                      <span><i class="bi bi-inr"></i> Rs.50000</span>
                      <span class="text-danger"><i class="bi bi-times"></i> Pending</span>
                    </p>
                  </div>
                </li>

              </ul>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <form>
                <div class="form-group">
                  <label>Semester</label>
                  <input type='text' name='' class="form-control" value='1st'>
                </div>
                <div class="form-group">
                  <label>Fees (Rs)</label>
                  <input type='text' name='' class="form-control" value='50000'>
                </div>

                <div class="form-group">
                  <label>Pay Mode</label>
                  <input type='text' name='' class="form-control" value='cash'>
                </div>

                <div class="form-group">
                  <label>Notes</label>
                  <textarea name='' class="form-control" rows="4"></textarea>
                </div>
                <div>
                  <button class="btn btn-sm btn-primary">Collect Fees</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php
  include __DIR__ . "/../../../includes/Footer.php";
  include __DIR__ . "/../../../assets/FooterFiles.php";
  ?>
</body>

</html>