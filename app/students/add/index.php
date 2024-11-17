<?php
include __DIR__ . "/../../../config/processor.php";

$PageName = "Add Students"; ?>
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
        <div class="col-lg-12">
          <form action="<?php echo DOMAIN; ?>/app/students" method="GET" class="row">
            <input type="hidden" name="msg" value="true">
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Student Primary Details</h5>

                  <div class="row mb-2">
                    <div class="col form-group">
                      <label>Student Name</label>
                      <input type="text" class="form-control" id="universityName" placeholder="">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-4 form-group">
                      <label>Phone Number</label>
                      <input type="tel" class="form-control" id="universityPhone" placeholder="">
                    </div>
                    <div class="col-8 form-group">
                      <label>Email-ID</label>
                      <input type="email" class="form-control" id="universityEmailId" placeholder="">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col form-group">
                      <label>Father name</label>
                      <input type="text" class="form-control" id="universityAffName" placeholder="">
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col form-group">
                      <label>Date of Birth</label>
                      <input type="date" value='<?php echo date('Y-m-d'); ?>' class="form-control" id="universityRegNo" placeholder="">
                    </div>
                    <div class="col form-group">
                      <label>Gender</label>
                      <select name="comissiontype" class="form-control">
                        <option>Male</option>
                        <option>Female</option>
                        <option>Others</option>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col form-group">
                      <label>Category</label>
                      <select name="comissiontype" class="form-control">
                        <option>General</option>
                        <option>SC</option>
                        <option>ST</option>
                        <option>OBC</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Current Address</h5>

                  <div class="row mb-2">
                    <div class="col form-group">
                      <label>Address</label>
                      <textarea name="universityAddressLine1" class="form-control" rows="4"></textarea>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col form-group">
                      <label>Area Locality</label>
                      <input type="text" class="form-control" id="universityAreaLocality" placeholder="">
                    </div>
                    <div class="col form-group">
                      <label>Landmark</label>
                      <input type="text" class="form-control" id="universityLandmark" placeholder="">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col form-group">
                      <label>City</label>
                      <input type="text" class="form-control" id="universityAreaLocality" placeholder="">
                    </div>
                    <div class="col form-group">
                      <label>State</label>
                      <input type="text" class="form-control" id="universityLandmark" placeholder="">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-6 col-md-6 col-lg-6 col-xs-6 form-group">
                      <label>Pincode</label>
                      <input type="text" class="form-control" id="universityAreaLocality" placeholder="">
                    </div>

                    <div class="col-6 col-md-6 col-lg-6 col-xs-6 form-group">
                      <br>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1">
                        <label class="form-check-label" for="gridCheck1"> Have same address </label>
                      </div>
                    </div>
                  </div>


                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Permanent Address</h5>

                  <div class="row mb-2">
                    <div class="col form-group">
                      <label>Address</label>
                      <textarea name="universityAddressLine1" class="form-control" rows="4"></textarea>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col form-group">
                      <label>Area Locality</label>
                      <input type="text" class="form-control" id="universityAreaLocality" placeholder="">
                    </div>
                    <div class="col form-group">
                      <label>Landmark</label>
                      <input type="text" class="form-control" id="universityLandmark" placeholder="">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col form-group">
                      <label>City</label>
                      <input type="text" class="form-control" id="universityAreaLocality" placeholder="">
                    </div>
                    <div class="col form-group">
                      <label>State</label>
                      <input type="text" class="form-control" id="universityLandmark" placeholder="">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-6 col-md-6 col-lg-6 col-xs-6 form-group">
                      <label>Pincode</label>
                      <input type="text" class="form-control" id="universityAreaLocality" placeholder="">
                    </div>

                  </div>


                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Previous Education</h5>

                  <div class="row mb-2">
                    <div class="col-9 form-group">
                      <label>10th From</label>
                      <input type="text" class="form-control" id="universityAreaLocality" placeholder="">
                    </div>
                    <div class="col-3 form-group">
                      <label>Passed Out</label>
                      <input type="number" value='2000' max='2023' min='2000' class="form-control" id="universityLandmark" placeholder="">
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-9 form-group">
                      <label>12th From</label>
                      <input type="text" class="form-control" id="universityAreaLocality" placeholder="">
                    </div>
                    <div class="col-3 form-group">
                      <label>Passed Out</label>
                      <input type="number" value='2000' max='2023' min='2000' class="form-control" id="universityLandmark" placeholder="">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-9 form-group">
                      <label>Course Name</label>
                      <input type="text" class="form-control" id="universityAreaLocality" placeholder="">
                    </div>
                    <div class="col-3 form-group">
                      <label>Passed Out</label>
                      <input type="number" value='2000' max='2023' min='2000' class="form-control" id="universityLandmark" placeholder="">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-9 form-group">
                      <label>Course Name</label>
                      <input type="text" class="form-control" id="universityAreaLocality" placeholder="">
                    </div>
                    <div class="col-3 form-group">
                      <label>Passed Out</label>
                      <input type="number" value='2000' max='2023' min='2000' class="form-control" id="universityLandmark" placeholder="">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-9 form-group">
                      <label>Course Name</label>
                      <input type="text" class="form-control" id="universityAreaLocality" placeholder="">
                    </div>
                    <div class="col-3 form-group">
                      <label>Passed Out</label>
                      <input type="number" value='2000' max='2023' min='2000' class="form-control" id="universityLandmark" placeholder="">
                    </div>
                  </div>

                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">University Name</h5>

                  <div class="row mb-2">
                    <div class="col-12 col-xs-12 col-sm-12">
                      <div class="form-group">
                        <label>Select University</label>
                        <select name="comissiontype" class="form-control">
                          <option>BIMT</option>
                          <option>CIMT</option>
                          <option>GIMT</option>
                          <option>IIM</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="p-2 mt-3 shadow-sm">
                        <h5 class="bold">Brij Mohan Institute </h5>
                        <p class="mb-0">B-11, 2nd florr, setcor 64 noida up 201301</p>
                      </div>
                    </div>
                  </div>

                </div>

              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Courses Available</h5>

                  <div class="row mb-2">
                    <div class="col-6 col-xs-6 col-sm-6">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="gridCheck1">
                        <label class="form-check-label" for="gridCheck1"> MBA (IT) </label>
                      </div>
                    </div>
                    <div class="col-6 col-xs-6 col-sm-6">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="gridCheck1">
                        <label class="form-check-label" for="gridCheck1"> MBA (HR) </label>
                      </div>
                    </div>
                    <div class="col-6 col-xs-6 col-sm-6">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="gridCheck1">
                        <label class="form-check-label" for="gridCheck1"> MBA (SALES) </label>
                      </div>
                    </div>
                    <div class="col-6 col-xs-6 col-sm-6">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="gridRadios">
                        <label class="form-check-label" for="gridCheck1">BBA</label>
                      </div>
                    </div>
                    <div class="col-6 col-xs-6 col-sm-6">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="gridRadios">
                        <label class="form-check-label" for="gridCheck1"> BCA </label>
                      </div>
                    </div>
                    <div class="col-6 col-xs-6 col-sm-6">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="gridRadios">
                        <label class="form-check-label" for="gridCheck1"> B-Tech </label>
                      </div>
                    </div>
                    <div class="col-6 col-xs-6 col-sm-6">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="gridRadios">
                        <label class="form-check-label" for="gridCheck1"> MCA </label>
                      </div>
                    </div>
                    <div class="col-6 col-xs-6 col-sm-6">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="gridRadios">
                        <label class="form-check-label" for="gridCheck1"> B.Sc (CS) </label>
                      </div>
                    </div>
                    <div class="col-6 col-xs-6 col-sm-6">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="gridRadios">
                        <label class="form-check-label" for="gridCheck1"> M.Sc (CS) </label>
                      </div>
                    </div>
                    <div class="col-6 col-xs-6 col-sm-6">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" id="gridRadios">
                        <label class="form-check-label" for="gridCheck1"> P.hd (CS) </label>
                      </div>
                    </div>
                  </div>

                </div>

              </div>
            </div>

            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Select BDE</h5>
                  <div class="row">
                    <div class='col-md-12 form-group'>
                      <label>Select team member </label>
                      <select name="comissiontype" class="form-control">
                        <option>Admin</option>
                        <option>Rahul</option>
                        <option>Rajni</option>
                        <option>Roshni</option>
                      </select>
                    </div>
                  </div>

                </div>

              </div>
            </div>

            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Registration Status</h5>
                  <div class="row">
                    <div class='col-md-6 form-group'>
                      <label>Select Status </label>
                      <select name="comissiontype" class="form-control">
                        <option>Done</option>
                        <option>Pending</option>
                      </select>
                    </div>
                    <div class='col-md-6 form-group'>
                      <label>Registration No</label>
                      <input type='text' name='value' class="form-control" min='1'>
                    </div>
                    <div class='col-md-6 form-group'>
                      <label>Registration Amount</label>
                      <input type='number' name='value' class="form-control" min='1'>
                    </div>
                    <div class='col-md-6 form-group'>
                      <label>Notes/Remarks</label>
                      <input type='text' name='value' class="form-control" min='1'>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12 p-2 pull-right">
                      <button class="btn btn-md btn-success" name='SaveUniversity'>Save Record</button>
                      <button type="reset" class="btn btn-md btn-secondary">Reset</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
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