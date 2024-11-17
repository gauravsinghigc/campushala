<?php
include __DIR__ . "/../../../config/processor.php";

$PageName = "Add Invoices"; ?>
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
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Primary Details</h5>
                  <form class="row g-3">
                    <div class="col-md-12"> <label for="inputName5" class="form-label">Your Name</label> <input type="text" class="form-control" id="inputName5"></div>
                    <div class="col-md-6"> <label for="inputEmail5" class="form-label">Email</label> <input type="email" class="form-control" id="inputEmail5"></div>
                    <div class="col-md-6"> <label for="inputPassword5" class="form-label">Password</label> <input type="password" class="form-control" id="inputPassword5"></div>
                    <div class="col-12"> <label for="inputAddress5" class="form-label">Address</label> <input type="text" class="form-control" id="inputAddres5s" placeholder="1234 Main St"></div>
                    <div class="col-12"> <label for="inputAddress2" class="form-label">Address 2</label> <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor"></div>
                    <div class="col-md-6"> <label for="inputCity" class="form-label">City</label> <input type="text" class="form-control" id="inputCity"></div>
                    <div class="col-md-4"> <label for="inputState" class="form-label">State</label> <select id="inputState" class="form-select">
                        <option selected>Choose...</option>
                        <option>...</option>
                      </select></div>
                    <div class="col-md-2"> <label for="inputZip" class="form-label">Zip</label> <input type="text" class="form-control" id="inputZip"></div>
                    <div class="col-12">
                      <div class="form-check"> <input class="form-check-input" type="checkbox" id="gridCheck"> <label class="form-check-label" for="gridCheck"> Check me out </label></div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Course Details</h5>
                  <form class="row g-3">
                    <div class="col-md-12"> <label for="inputName5" class="form-label">Your Name</label> <input type="text" class="form-control" id="inputName5"></div>
                    <div class="col-md-6"> <label for="inputEmail5" class="form-label">Email</label> <input type="email" class="form-control" id="inputEmail5"></div>
                    <div class="col-md-6"> <label for="inputPassword5" class="form-label">Password</label> <input type="password" class="form-control" id="inputPassword5"></div>
                    <div class="col-12"> <label for="inputAddress5" class="form-label">Address</label> <input type="text" class="form-control" id="inputAddres5s" placeholder="1234 Main St"></div>
                    <div class="col-12"> <label for="inputAddress2" class="form-label">Address 2</label> <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor"></div>
                    <div class="col-md-6"> <label for="inputCity" class="form-label">City</label> <input type="text" class="form-control" id="inputCity"></div>
                    <div class="text-center"> <button type="submit" class="btn btn-primary">Submit</button> <button type="reset" class="btn btn-secondary">Reset</button></div>
                  </form>
                </div>
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