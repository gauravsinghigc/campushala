<?php
include __DIR__ . "/../../../config/processor.php";

$PageName = "Student Details"; ?>
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
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <a href="" class="btn btn-sm btn-default">Add Course</a>
              <a href="" class="btn btn-sm btn-default">Move Semester</a>
              <a href="" class="btn btn-sm btn-default">Collect Fee</a>
              <a href="" class="btn btn-sm btn-default">Upload Documents</a>
              <a href="" class="btn btn-sm btn-default">Edit Profile</a>
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-3 text-center">
                  <img src="<?php echo STORAGE_URL; ?>/lib/student.png" class="img-fluid w-100 rounded-2 shadow-sm p-2">
                </div>
                <div class="col-md-9 text-left">
                  <div class="p-1">
                    <p class="mb-2 small"><span class="text-secondary">Reg No :</span> CAMO12I989</p>
                    <h4>Rahul Sharma
                      <span class="pull-right float-end text-secondary italic small">Gurgaon</span>
                    </h4>
                    <p class="mb-2"><span class="text-secondary">Father Name :</span> MD Sharma</p>
                    <p class="flex-s-b mb-2">
                      <span>
                        <span class="text-secondary">University Name:</span><br>
                        <span>brij Mohan Institute of Management & Technology</span>
                      </span>
                      <span>
                        <span class="text-secondary">COURSE/Semeset:</span><br>
                        <span>BCA/2nd Sem</span>
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
                        <span>+918789788675</span>
                      </span>
                      <span>
                        <span class="text-secondary">Emailid</span><br>
                        <span>rahulshram24@gmail.com</span>
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
                <h3>1</h3>
                <p>Courses</p>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <h3>Rs.2,60,000</h3>
                <p>Payable Fees</p>
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <h3>Rs.1,60,000</h1>
                  <p>Paid fees</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <h3>Rs.1,00,000</h3>
                <p>Pending</p>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="card">
            <div class="card-body">
              <a href="" class="btn btn-sm btn-default">All Courses</a>
              <a href="" class="btn btn-sm btn-default">All Semesters</a>
              <a href="" class="btn btn-sm btn-default">All Transactions</a>
              <a href="" class="btn btn-sm btn-default">All Documents</a>
              <a href="" class="btn btn-sm btn-default">All Certificates</a>
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
                      <th scope="col">Course Name</th>
                      <th scope="col">Semesters</th>
                      <th scope="col">Total fee</th>
                      <th scope="col">Paid</th>
                      <th scope="col">Balance</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>BCA
                      </td>
                      <td>6 Sems/2nd</td>
                      <td class="text-primary">Rs.320000</td>
                      <td class="text-success">Rs.20000</td>
                      <td class="text-danger">Rs.300000</td>
                      <td class="text-success">Active</td>
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