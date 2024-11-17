<?php
include __DIR__ . "/../../../config/processor.php";

$PageName = "University Details"; ?>
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
    <section class="section dashboard">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-3 text-center">
                  <img src="<?php echo STORAGE_URL; ?>/lib/university.png" class="img-fluid w-100 rounded-2 shadow-sm p-2">
                </div>
                <div class="col-md-9 text-left">
                  <div class="p-1">
                    <h5>Brij Mohan Institute of Management & Technology

                      <span class="pull-right float-end text-secondary italic">JHAJJAR</span>
                    </h5>
                    <p class="flex-s-b mb-2">
                      <span>
                        <span class="text-secondary">Reg No:</span><br>
                        <span>RTDCFG1VHFHFHHFH</span>
                      </span>
                      <span>
                        <span class="text-secondary">Tax No:</span><br>
                        <span>GHSVHGVGHFW12YU</span>
                      </span>
                    </p>
                    <p class="mb-2">
                      <span class="text-secondary">Address</span><br>
                      <span>B-11, 2nd floor, sector 64 noida UP 201301</span>
                      <br>
                    </p>
                    <p class="mb-2 flex-s-b">
                      <span>
                        <span class="text-secondary">Phone:</span><br>
                        <span>+918789788675 (Vikash Arya)</span>
                      </span>
                      <span>
                        <span class="text-secondary">Commission:</span><br>
                        <span>10% per fee or semester fee</span>
                      </span>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <h1>1450</h1>
                <p>Students</p>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <h1>56</h1>
                <p>Invoices</p>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <h1>14</h1>
                <p>Paid Invoices</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <h1>42</h1>
                <p>Un-Paid Invoices</p>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="card">
            <div class="card-body">
              <a href="" class="btn btn-sm btn-default">All Students</a>
              <a href="" class="btn btn-sm btn-default">All Courses</a>
              <a href="" class="btn btn-sm btn-default">All Invoices</a>
              <a href="" class="btn btn-sm btn-default">All Transactions</a>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body pt-4">
                <h5 class="card-title">All Students</h5>
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
                        Rahul Sharma
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
                        Rahul Sharma
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
                        Rahul Sharma
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
                        Rahul Sharma
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
      </div>
    </section>
  </main>

  <?php
  include __DIR__ . "/../../../includes/Footer.php";
  include __DIR__ . "/../../../assets/FooterFiles.php";
  ?>
</body>

</html>