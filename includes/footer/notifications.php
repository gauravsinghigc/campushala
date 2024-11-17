<?php if (isset($_GET['msg'])) { ?>
  <section class="notifications">
    <div class="msg-container">
      <ul>
        <li id='msg'>
          <div class="msg-box">
            <div class='msg-header'>
              <h5 class='text-success'>Record Saved Successfully!</h5>
            </div>
            <div class="msg-body">
              <p>details are saved successfully!</p>
            </div>
            <div class="msg-footer">
              <a href="index.php" onclick="document.getElementById('msg').style.display='none';" class="btn btn-sm btn-default">Close</a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </section>
<?php } ?>