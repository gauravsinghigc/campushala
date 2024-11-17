<div class="row">
  <div class="col-md-12">
    <div class='flex-s-b'>
      <h3 class="app-heading w-pr-80 m-t-0"><i class="fa fa-home"></i> Reception Dashboard </h3>
      <?php if (LOGIN_UserType == 'Admin') { ?>
        <form>
          <select name="view" onchange="form.submit()" class="form-control form-control-sm">
            <?php InputOptions(["Admin Dashboard","ACCOUNT", 'Lead Dashboard', 'CRM Dashboard', 'HR Dashboard', 'Reception Dashboard', 'Digital Dashboard'], IfRequested('GET', 'view', 'Lead Dashboard', false)); ?>
          </select>
        </form>
      <?php } ?>
    </div>
  </div>
</div>

<div class="row">

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


</div>