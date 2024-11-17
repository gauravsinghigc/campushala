<?php
$CheckVisits = CHECK("SELECT * FROM visitors where VisitEnquiryStatus='NEW' and VisitPesonMeetWith='" . LOGIN_UserId . "'");
if ($CheckVisits != null) {
  if (isset($_GET['hide_visit_pop'])) {
    $display = "none";
  } else {
    $display = "block";
  }
?>
  <section class="follow-up-reminder" style="display:<?php echo $display; ?>;">
    <div class="reminder-box w-50">
      <div class="container">
        <div class="card p-2" style="background-color: #fff5ed !important;">
          <div class="row" style="">
            <div class='col-md-12'>
              <h5 class='app-heading'>Visit Received</h5>
            </div>
            <div style="height:30em !important;overflow-y:scroll;width:100%;">
              <?php
              $AllVisitors = FETCH_DB_TABLE("SELECT * FROM visitors where VisitEnquiryStatus='NEW' and VisitPesonMeetWith='" . LOGIN_UserId . "' ORDER BY VisitorId DESC", true);
              if ($AllVisitors != null) {
                $SerialNo = 0;
                foreach ($AllVisitors as $Visitor) {
                  $SerialNo++;
              ?>
                  <div class='col-md-12'>
                    <p class='data-list p-2 flex-s-b'>
                      <span class='w-pr-5'><?php echo $SerialNo; ?></span>
                      <span class='w-pr-30'>
                        <a href="#" onclick="Databar('edit_<?php echo $Visitor->VisitorId; ?>')" class='text-primary'>
                          <span class='bold' style='font-size:1.2em !important;'><?php echo $Visitor->VisitorPersonName; ?></span><br>
                          <?php echo $Visitor->VisitorPersonPhone; ?><br>
                          <?php echo $Visitor->VisitorPersonEmailId; ?><BR>
                          <b>Details: </b><?php echo SECURE($Visitor->VisitPeronsDescription, "d"); ?>
                        </a>
                      </span>
                      <span class='w-pr-25 text-center'><?php echo $Visitor->VisitPersonType; ?></span>
                      <span class='w-pr-25 text-center'><?php echo DATE_FORMATE("d M, Y", $Visitor->VisitPersonCreatedAt); ?></span>
                      <span class='w-pr-15'><?php echo $Visitor->VisitEnquiryStatus; ?></span>
                      <span class='w-pr-10 text-right'>
                        <a href="#" onclick="Databar('edit_<?php echo $Visitor->VisitorId; ?>')" class='text-info'>Update</a>
                      </span>
                    </p>
                  </div>
              <?php
                  include $Dir . "/include/sections/VisitorUpdatePopWindow.php";
                }
              } else {
                NoData("No Visitor Found!");
              } ?>
            </div>
            <div class='col-md-12 mt-4 text-center'>
              <a href="?hide_visit_pop=false" class="btn btn-success btn-sm" style="border-radius:2rem !important;">Hide Window </a>
            </div>

            <!-- birthday animations -->
          </div>
        </div>
      </div>
    </div>
  </section>
<?php }
?>