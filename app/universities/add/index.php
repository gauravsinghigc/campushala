<?php
include __DIR__ . "/../../../config/processor.php";

$PageName = "Add Universities"; ?>
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
          <form action="<?php echo DOMAIN; ?>/app/universities" method="GET" class="row">
            <input type="hidden" name="msg" value="true">
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">University Primary Details</h5>

                  <div class="row mb-2">
                    <div class="col form-group">
                      <label>University Name</label>
                      <input type="text" class="form-control" id="universityName" placeholder="">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col form-group">
                      <label>Phone Number</label>
                      <input type="tel" class="form-control" id="universityPhone" placeholder="">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col form-group">
                      <label>Email-ID</label>
                      <input type="email" class="form-control" id="universityEmailId" placeholder="">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col form-group">
                      <label>Affiliation Name</label>
                      <input type="text" class="form-control" id="universityAffName" placeholder="">
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col form-group">
                      <label>Reg.No</label>
                      <input type="text" class="form-control" id="universityRegNo" placeholder="">
                    </div>
                    <div class="col form-group">
                      <label>GST or Taxation No</label>
                      <input type="text" class="form-control" id="universityTaxNo" placeholder="">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Registered Address</h5>

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
                  <h5 class="card-title">Primary Contact Person</h5>

                  <div class="row mb-2">
                    <div class="col form-group">
                      <label>Full Name</label>
                      <input type="text" class="form-control" id="universityAreaLocality" placeholder="">
                    </div>
                    <div class="col form-group">
                      <label>Designation</label>
                      <input type="text" class="form-control" id="universityLandmark" placeholder="">
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col form-group">
                      <label>Phone Number</label>
                      <input type="tel" min="10" max="12" class="form-control" id="universityAreaLocality" placeholder="">
                    </div>
                    <div class="col form-group">
                      <label>Email-id</label>
                      <input type="email" class="form-control" id="universityLandmark" placeholder="">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Courses Offer</h5>

                  <div class="row mb-2">
                    <div class="col-6 col-xs-6 col-sm-6">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1">
                        <label class="form-check-label" for="gridCheck1"> MBA (IT) </label>
                      </div>
                    </div>
                    <div class="col-6 col-xs-6 col-sm-6">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1">
                        <label class="form-check-label" for="gridCheck1"> MBA (HR) </label>
                      </div>
                    </div>
                    <div class="col-6 col-xs-6 col-sm-6">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1">
                        <label class="form-check-label" for="gridCheck1"> MBA (SALES) </label>
                      </div>
                    </div>
                    <div class="col-6 col-xs-6 col-sm-6">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1">
                        <label class="form-check-label" for="gridCheck1">BBA</label>
                      </div>
                    </div>
                    <div class="col-6 col-xs-6 col-sm-6">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1">
                        <label class="form-check-label" for="gridCheck1"> BCA </label>
                      </div>
                    </div>
                    <div class="col-6 col-xs-6 col-sm-6">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1">
                        <label class="form-check-label" for="gridCheck1"> B-Tech </label>
                      </div>
                    </div>
                    <div class="col-6 col-xs-6 col-sm-6">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1">
                        <label class="form-check-label" for="gridCheck1"> MCA </label>
                      </div>
                    </div>
                    <div class="col-6 col-xs-6 col-sm-6">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1">
                        <label class="form-check-label" for="gridCheck1"> B.Sc (CS) </label>
                      </div>
                    </div>
                    <div class="col-6 col-xs-6 col-sm-6">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1">
                        <label class="form-check-label" for="gridCheck1"> M.Sc (CS) </label>
                      </div>
                    </div>
                    <div class="col-6 col-xs-6 col-sm-6">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1">
                        <label class="form-check-label" for="gridCheck1"> P.hd (CS) </label>
                      </div>
                    </div>
                  </div>

                </div>

              </div>
            </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Commission Details</h5>
                  <div class="row">
                    <div class='col-md-6 form-group'>
                      <label>Commission Type <span class="text-secondary">as per fees receive from students</span></label>
                      <select name="comissiontype" class="form-control">
                        <option>Percentage</option>
                        <option>Amount</option>
                      </select>
                    </div>
                    <div class='col-md-6 form-group'>
                      <label>Commission Value </label>
                      <input type='number' name='value' class="form-control" min='1'>
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