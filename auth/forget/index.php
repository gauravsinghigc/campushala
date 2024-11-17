<?php
include  __DIR__ . "/../../config/processor.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Recove Password @ <?php echo SYS_INFO['app']['name']; ?></title>
  <meta name="robots" content="noindex, nofollow">
  <meta content="" name="description">
  <meta content="" name="keywords">
  <?php include __DIR__ . "/../../assets/HeaderFiles.php"; ?>
</head>

<body>
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="d-flex justify-content-center py-4"> <a href="index.html" class="d-flex align-items-center w-auto"> <img src="<?php echo SYS_INFO['app']['logo']; ?>" width="200" style='height:80px !important;' alt=""></a></div>
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Recove Password</h5>
                  </div>
                  <form action="<?php echo DOMAIN; ?>/app/" class="row g-3 needs-validation" novalidate>
                    <div class="col-12"> <label for="yourUsername" class="form-label">Enter Registered mail-id</label>
                      <div class="input-group has-validation"> <span class="input-group-text" id="inputGroupPrepend">@</span> <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>
                    <div class="col-12"> <button class="btn btn-primary w-100" type="submit">Search Account</button></div>
                    <div class="col-12">
                      <p class="small mb-0">Know Password? <a href="<?php echo DOMAIN; ?>/auth/login">Login Now</a></p>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>

  <?php __DIR__ . "/../../assets/FooterFiles.php"; ?>
</body>

</html>