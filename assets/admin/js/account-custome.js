
/** Add More Previouse Educations */
$(document).ready(function () {
  $(".add-more-edu-btn").click(function (e) {
    e.preventDefault();
    $("#multiPrevEdu").prepend(`<div class="card-body" id="multiPrevEdu">
                <div class="row">
                  <div class="col-md-4 form-group">
                    <label>Course name <?php echo $req; ?></label>
                    <select name="stud_prev_course_name[]" class="form-control form-control-sm" required="">
                      <option>10th</option>
                      <option>SC</option>
                      <option>ST</option>
                      <option>OBC</option>
                    </select>
                  </div>
                  <div class="col-md-4 form-group">
                    <label>Course Type <?php echo $req; ?></label>
                    <select name="stud_prev_course_type[]" class="form-control form-control-sm" required="">
                      <option>Regular</option>
                      <option>Part Time</option>
                      <option>Professional</option>
                    </select>
                  </div>
                  <div class='col-md-4 form-group'>
                    <label>University/Board <?php echo $req; ?></label>
                    <input type="text" name="stud_prev_university_board[]" class="form-control form-control-sm" required="">
                  </div>
                  <div class='col-md-7 form-group'>
                    <label>School/College/University Name <?php echo $req; ?></label>
                    <input type="text" name="stud_prev_university_name[]" class="form-control form-control-sm" required="">
                  </div>
                  <div class='col-md-5 form-group'>
                    <label>Marks(%) <?php echo $req; ?></label>
                    <input type="text" name="stud_prev_mark[]" class="form-control form-control-sm" required="">
                  </div>
                  <div class='col-md-4 form-group'>
                    <label>Passed Out <?php echo $req; ?></label>
                    <input type="text" name="stud_prev_passed_out[]" class="form-control form-control-sm" required="">
                  </div>
                  <div class='col-md-4 form-group'>
                    <label></label>
                    <i class="btn btn-outline-danger fa-solid fa-plus mt-4 remove-more-edu-btn"></i>
                  </div>
                </div>
              </div>`);
  });
  $(document).on("click", ".remove-more-edu-btn", function (e) {
    e.preventDefault();
    let row_item = $(this).parent().parent();
    $(row_item).remove();
  });
});

//Add University Primary Contact Person//
$(document).ready(function () {
    $(".add-more-univ-contact-person-btn").click(function (e) {
      e.preventDefault();
      $("#univcontactperson")
        .prepend(` <div class="card-body" id="univcontactperson">
                <div class="row">
                  <div class='col-md-7 form-group'>
                    <label>Full Name <?php echo $req; ?></label>
                    <input type="text" name="univ_primary_contact_person_full_name[]" class="form-control form-control-sm" required="">
                  </div>
                  <div class='col-md-5 form-group'>
                    <label>Designation </label>
                    <input type="text" name="univ_primary_contact_designation[]" class="form-control form-control-sm">
                  </div>
                  <div class='col-md-5 form-group'>
                    <label>Phone Number <?php echo $req; ?></label>
                    <input type="text" name="univ_primary_contact_no[]" class="form-control form-control-sm" required="">
                  </div>
                  <div class='col-md-5 form-group'>
                    <label>Email-id</label>
                    <input type="text" name="univ_primary_contact_email_id[]" class="form-control form-control-sm">
                  </div>
                  <div class='col-md-2 form-group'>
                    <label></label>
                    <i class="btn btn-outline-danger fa-solid fa-plus mt-4 remove-more-univ-contact-person-btn"></i>
                  </div>
                </div>
              </div>`);
    });
   $(document).on("click", ".remove-more-univ-contact-person-btn",function (e) {
       e.preventDefault();
       let row_item = $(this).parent().parent();
       $(row_item).remove();
     }
   );
})

