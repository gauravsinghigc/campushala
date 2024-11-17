<?php
$Dir = "../..";
require $Dir . '/require/modules.php';
require $Dir . '/require/admin/access-control.php';


//pagevariables
$PageName = "ADD New team Member";
$PageDescription = "Manage all team";

$GetLatestEmpID = FETCH_DB_TABLE("SELECT * FROM user_employment_details ORDER BY UserEmpDetailsId DESC", true);
if ($GetLatestEmpID != null) {
  $EmpCodeArray = [];
  foreach ($GetLatestEmpID as $EmpCode) {
    $EmpCodes = $EmpCode->UserEmpJoinedId;
    $EmpNumbers = GetNumbers($EmpCodes);
    if ($EmpNumbers != 0) {
      array_push($EmpCodeArray, $EmpNumbers);
    }
  }
  $SortedArray = sort($EmpCodeArray, SORT_NUMERIC);
  foreach ($EmpCodeArray as $Code) {
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
  <meta name="keywords" content="<?php echo APP_NAME; ?>">
  <meta name="description" content="<?php echo SHORT_DESCRIPTION; ?>">
  <?php include $Dir . "/include/admin/header_files.php"; ?>
  <script type="text/javascript">
    function SidebarActive() {
      document.getElementById("teams").classList.add("active");
    }
    window.onload = SidebarActive;
  </script>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include $Dir . "/include/admin/loader.php"; ?>

    <?php
    include $Dir . "/include/admin/header.php";
    include $Dir . "/include/admin/sidebar.php"; ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <h4 class="app-heading"><?php echo $PageName; ?></h4>
                      <a href="index.php" class="btn btn-sm btn-default"><i class="fa fa-angle-left"></i> Back to ALL Users</a>
                    </div>
                  </div>
                  <form action="<?php echo CONTROLLER; ?>/UserController.php" method="POST" enctype="multipart/form-data">
                    <?php FormPrimaryInputs(true); ?>
                    <div class="row">
                      <div class="col-md-7">
                        <h5 class="app-sub-heading">Team Member Information</h5>
                        <div class="row">
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-12">
                            <label>Sal *</label>
                            <select class="form-control" name="UserSalutation" required="">
                              <option value="Mr.">Mr.</option>
                              <option value="Mrs.">Mrs.</option>
                              <option value="Miss">Miss</option>
                              <option value="M/s">M/s</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                            <label>User First Name *</label>
                            <input type="text" name="UserFirstName" class="form-control" required="" placeholder="First Name">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-12">
                            <label>User Full Name *</label>
                            <input type="text" name="UserLastName" class="form-control" required="" placeholder="Last Name">
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                            <label>Primary Contact Number *</label>
                            <input type="phone" name="UserPhoneNumber" class="form-control" value="+91" placeholder="+91">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-12">
                            <label>Primary Contact Email-ID *</label>
                            <input type="email" name="UserEmailId" class="form-control" required="">
                          </div>
                        </div>
                        <div class="row mb-10px">
                          <div class="form-group col-lg-12 col-lg-12 col-sm-12">
                            <label>Notes/Remarks</label>
                            <textarea class="form-control" rows="3" name="UserNotes"></textarea>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label>User Status</label>
                            <select class="form-control" name="UserStatus">
                              <option value="1" selected="">Active</option>
                              <option value="0">Inactive</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label>User Type</label>
                            <select class="form-control" name="UserType">
                              <?php InputOptions(USER_ROLES); ?>
                            </select>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-12">
                            <label>Date of Birth</label>
                            <input type="date" name="UserDateOfBirth" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                          </div>
                        </div>
                        <h5 class="app-sub-heading">Employement Information</h5>
                        <div class="row">
                          <div class="col-md-3 form-group">
                            <label>Current Empl ID</label>
                            <input type="text" value='RNA-<?php echo $Code + 1; ?>' class="form-control" name="UserEmpJoinedId">
                          </div>
                          <div class="col-md-4 form-group">
                            <label>Background</label>
                            <input type="text" class="form-control" name="UserEmpBackGround">
                          </div>
                          <div class="col-md-5 form-group">
                            <label>Total Work Experience (in Years)</label>
                            <input type="text" class="form-control" name="UserEmpTotalWorkExperience">
                          </div>
                          <div class="col-md-4 form-group">
                            <label>Previous Organisation</label>
                            <input type="text" class="form-control" name="UserEmpPreviousOrg">
                          </div>
                          <div class="col-md-4 form-group">
                            <label>Blood Groups</label>
                            <input type="text" class="form-control" name="UserEmpBloodGroup">
                          </div>
                          <div class="col-md-4 form-group">
                            <label>Rera ID (If Have)</label>
                            <input type="text" class="form-control" name="UserEmpReraId">
                          </div>
                          <div class="form-group col-md-4">
                            <label>Reporting Manager</label>
                            <select class="form-control" name="UserEmpReportingMember">
                              <option value="0">Select Manager</option>
                              <?php
                              $Users = FETCH_DB_TABLE("SELECT * FROM users ORDER BY UserFullName ASC", true);
                              foreach ($Users as $User) {
                                if ($User->UserId == LOGIN_UserId) {
                                  $selected = "selected";
                                } else {
                                  $selected = "";
                                }
                                echo "<option value='" . $User->UserId . "' $selected>" . $User->UserFullName . " @ " . $User->UserPhoneNumber . "</option>";
                              }
                              ?>
                            </select>
                          </div>
                          <div class="col-md-4 form-group">
                            <label>CRM Status</label>
                            <select class="form-control" name="UserEmpCRMStatus">
                              <?php InputOptions(["Yes" => "Yes", "No" => "No"], "No"); ?>
                            </select>
                          </div>
                          <div class="col-md-4 form-group">
                            <label>Visiting Card</label>
                            <select class="form-control" name="UserEmpVisitingCard">
                              <?php InputOptions(["Yes" => "Yes", "No" => "No"], "No"); ?>
                            </select>
                          </div>
                          <div class="col-md-4 form-group">
                            <label>Employee Group </label>
                            <select class="form-control" name="UserEmpGroupName">
                              <?php CONFIG_VALUES("WORK_GROUP"); ?>
                            </select>
                          </div>
                          <div class="col-md-4 form-group">
                            <label>Employement Type</label>
                            <select class="form-control" name="UserEmpType">
                              <?php InputOptions(["RA Direct" => "RA DIRECT", "Business Modal" => "Business Modal"], "RA DIRECT"); ?>
                            </select>
                          </div>
                          <div class="col-md-4 form-group">
                            <label>Work Location</label>
                            <select class="form-control" name="UserEmpLocations">
                              <?php InputOptions(["Noida" => "Noida", "Gurgaon" => "Gurgaon"], "Noida"); ?>
                            </select>
                          </div>
                          <div class="col-md-4 form-group">
                            <label>(OnRole/OffRole) Status</label>
                            <select class="form-control" name="UserEmpRoleStatus">
                              <?php InputOptions(["On Role" => "On Role", "Off Role" => "Off Role"], "On Role"); ?>
                            </select>
                          </div>
                          <div class="col-md-8 form-group">
                            <label>Work Email-ID</label>
                            <input type="text" class="form-control" name="UserEmpWorkEmailId">
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-5">
                        <div class="row">
                          <div class="col-md-12">
                            <h5 class="app-sub-heading">Address Details</h5>
                          </div>
                        </div>

                        <div class="row mb-10px">
                          <div class="form-group col-lg-12 col-md-12 col-12">
                            <label>Street Address</label>
                            <textarea class="form-control" name="UserStreetAddress" rows="2"></textarea>
                          </div>
                        </div>

                        <div class="row mb-10px">
                          <div class="form-group col-lg-6 col-md-6 col-12">
                            <label>Sector/Locality/Area/Landmark</label>
                            <input type="text" name="UserLocality" class="form-control">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-12">
                            <label>City</label>
                            <input type="text" name="UserCity" class="form-control">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-12">
                            <label>State</label>
                            <input type="text" name="UserState" class="form-control">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-12">
                            <label>Country</label>
                            <input type="text" name="UserCountry" class="form-control">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-12">
                            <label>Pincode</label>
                            <input type="text" name="UserPincode" class="form-control">
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-12">
                            <label>Address Type</label>
                            <select class="form-control" name="UserAddressType">
                              <?php InputOptions(["Office Address", "Home Address"], null); ?>
                            </select>
                          </div>
                          <div class="form-group col-lg-8 col-md-8 col-12">
                            <label>Contact Person At Address</label>
                            <input type="text" name="UserAddressContactPerson" class="form-control">
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <h5 class="app-sub-heading">Upload Documents</h5>
                          </div>
                          <div class="form-group col-lg-4">
                            <label>PAN CARD No</label>
                            <input type="text" name="PancardNo" class="form-control">
                          </div>
                          <div class="form-group col-lg-8">
                            <label>Attach PAN CARD</label>
                            <input type="FILE" value="null" name="PancardFile" class="form-control">
                          </div>
                          <div class="form-group col-lg-4">
                            <label>Adhaar CARD No</label>
                            <input type="text" name="AdhaarNo" class="form-control">
                          </div>
                          <div class="form-group col-lg-8">
                            <label>Attach Adhaar CARD</label>
                            <input type="FILE" value="null" name="AdhaarFile" class="form-control">
                          </div>
                          <div class="col-md-12">
                            <h5 class="app-sub-heading">Bank Account Details</h5>
                          </div>
                          <div class="form-group col-md-6">
                            <label>Bank Name</label>
                            <input type="text" name="UserBankName" class="form-control">
                          </div>
                          <div class="form-group col-md-6">
                            <label>Account No</label>
                            <input type="text" name="UserBankAccountNo" class="form-control">
                          </div>
                          <div class="form-group col-md-6">
                            <label>IFSC Code</label>
                            <input type="text" name="UserBankIFSC" class="form-control">
                          </div>
                          <div class="form-group col-md-6">
                            <label>Account Holder Name</label>
                            <input type="text" name="UserBankAccoundHolderName" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-10px mb-20px">
                      <div class="form-group col-lg-12 col-md-12 col-12">
                        <div class="action-btn">
                          <button class="btn btn-md btn-success" type="submit" name="SaveCustomer"><i class="fa fa-check-circle"></i> Save Team Member</button>
                          <button class="btn btn-md btn-default" type="reset"><i class="fa fa-refresh"></i> Reset</button><br>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <?php include $Dir . "/include/admin/footer.php"; ?>
  </div>

  <?php include $Dir . "/include/admin/footer_files.php"; ?>

</body>

</html>