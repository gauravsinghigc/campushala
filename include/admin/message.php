<style>
  .notification-box {
    position: fixed;
    right: 1rem;
    top: 1rem;
    width: 70%;
    min-width: 250px;
    max-width: 350px;
    z-index: 1 !important;
    padding: 1rem !important;
    box-shadow: 0px 0px 10px black;
    border-radius: 5px;
    background-color: white !important;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    -ms-border-radius: 5px;
    -o-border-radius: 5px;
    z-index: 999999999999999999999999999999999999999999999999999999 !important;
  }

  .notification-box h4 {
    cursor: pointer;
    padding: 0.37rem !important;
    margin-top: 0.2rem !important;
    border-radius: 5px !important;
  }

  .notification-box p {
    padding: 0.2% !important;
    padding-left: 0% !important;
  }

  .notification-box h4 i.fa-times {
    float: right !important;
    margin-right: 2% !important;
  }
</style>
<?php
if (CONTROL_NOTIFICATION == "true") {
    $Time = CONTROL_MSG_DISPLAY_TIME;
    $APP_DOMAIN = STORAGE_URL_D . "";?>
  <?php if (isset($_SESSION['success'])) {?>
    <div class="notification-box" id="MsgArea1">
      <?php if (CONTROL_NOTIFICATION_SOUND == "true") {?>
        <audio controls autoplay hidden="">
          <source src="<?php echo $APP_DOMAIN; ?>/sys-tone/success.mp3" type="audio/ogg">
          <source src="<?php echo $APP_DOMAIN; ?>/sys-tone/success.mp3" type="audio/ogg">
        </audio>
      <?php }?>
      <h4 class="bg-success p-3 text-white" onclick="HideMsgNote()"><i class="fa fa-check-circle"></i> Success!
        <i class="fa fa-times"></i>
      </h4>
      <p class="mb-0">
        <span class="font-14">
          <?php echo $_SESSION['success']; ?>
        </span>
        <br><br>
      </p>

      <script>
        setTimeout(function() {
          $("#MsgArea1").fadeOut("slow");
        }, <?php echo $Time; ?>);
      </script>
    </div>
    <script>
      function HideMsgNote() {
        document.getElementById("MsgArea1").style.display = "none";
      }
    </script>

  <?php
unset($_SESSION['success']);
    } elseif (isset($_SESSION['info'])) { ?>
    <div class="notification-box" id="MsgArea2">
      <?php if (CONTROL_NOTIFICATION_SOUND == "true") { ?>
        <audio controls autoplay hidden="">
          <source src="<?php echo $APP_DOMAIN; ?>/sys-tone/info.mp3" type="audio/ogg">
          <source src="<?php echo $APP_DOMAIN; ?>/sys-tone/info.mp3" type="audio/ogg">
        </audio>
      <?php } ?>
      <h4 class="bg-info p-3 text-white" onclick="HideMsgNote()"><i class="fa fa-bell"></i> Notification
        <i class="fa fa-times"></i>
      </h4>
      <p class="mb-0">
        <span class="font-14">
          <?php echo $_SESSION['info']; ?>
        </span>
        <br><br>
      </p>
      <script>
        setTimeout(function() {
          $("#MsgArea2").fadeOut("slow");
        }, <?php echo $Time; ?>);
      </script>
    </div>
    <script>
      function HideMsgNote() {
        document.getElementById("MsgArea2").style.display = "none";
      }
    </script>
    <?php if (!empty($_SESSION['info'])) {
        unset($_SESSION['info']);
    }
    } elseif (isset($_SESSION['warning'])) { ?>
    <div class="notification-box" id="MsgArea3">
      <?php if (CONTROL_NOTIFICATION_SOUND == "true") {?>
        <audio controls autoplay hidden="">
          <source src="<?php echo $APP_DOMAIN; ?>/sys-tone/danger.mp3" type="audio/ogg">
          <source src="<?php echo $APP_DOMAIN; ?>/sys-tone/danger.mp3" type="audio/ogg">
        </audio>
      <?php }?>
      <h4 class="bg-danger p-3 text-white" onclick="HideMsgNote()">Failed
        <i class="fa fa-times"></i>
      </h4>
      <p class="mb-0">
        <span class="font-14">
          <?php echo $_SESSION['warning']; ?>
        </span>
        <br><br>
      </p>
      <script>
        setTimeout(function() {
          $("#MsgArea3").fadeOut("slow");
        }, <?php echo $Time; ?>);
      </script>
    </div>
    <script>
      function HideMsgNote() {
        document.getElementById("MsgArea3").style.display = "none";
      }
    </script>
    <?php if (!empty($_SESSION['warning'])) {
        unset($_SESSION['warning']);
    }
    } elseif (isset($_SESSION['danger'])) {?>
    <div class="notification-box" id="MsgArea4">
      <?php if (CONTROL_NOTIFICATION_SOUND == "true") {?>
        <audio controls autoplay hidden="">
          <source src="<?php echo $APP_DOMAIN; ?>/sys-tone/warning.mp3" type="audio/ogg">
          <source src="<?php echo $APP_DOMAIN; ?>/sys-tone/warning.mp3" type="audio/ogg">
        </audio>
      <?php }?>
      <h4 class="bg-danger p-3 text-white" onclick="HideMsgNote()"> <i class="fa fa-warning"></i> Something Went Wrong!
        <i class="fa fa-times"></i>
      </h4>
      <p class="mb-0">
        <span class="font-14">
          <?php echo $_SESSION['danger']; ?>
        </span>
        <br><br>
      </p>
      <script>
        setTimeout(function() {
          $("#MsgArea4").fadeOut("slow");
        }, <?php echo $Time; ?>);
      </script>
    </div>
    <script>
      function HideMsgNote() {
        document.getElementById("MsgArea4").style.display = "none";
      }
    </script>
<?php if (!empty($_SESSION['danger'])) {
        unset($_SESSION['danger']);
    }
    }
} ?>