<h1 align="center">Track My Time @ Maverick</h1>
<div class="main">
  <div class="container">
    <!-- BEGIN SIDEBAR & CONTENT -->
    <div class="row margin-bottom-40">
      <!-- BEGIN CONTENT -->
      <div class="col-md-9 col-sm-9">
        <?php print_r($msg);  ?>
        <h1>Login</h1>
        <div class="content-form-page">
          <div class="row">
            <div class="col-md-7 col-sm-7">
                <form class="form-horizontal form-without-legend" method="post" name="LoginForm" id=LoginForm" role="form" onsubmit="return validateFrm()">
                <div class="form-group">
                  <label for="email" class="col-lg-4 control-label">User Name <span class="require">*</span></label>
                  <div class="col-lg-8">
                      <input type="text" class="form-control" id="name" name="name">
                      <span id="name_error" style="color:red;"></span>
                  </div>.
                </div>
                <div class="form-group">
                  <label for="password" class="col-lg-4 control-label">Password <span class="require">*</span></label>
                  <div class="col-lg-8">
                      <input type="password" class="form-control" id="password" name="password">
                      <span id="password_error" style="color:red;"></span>
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20">
                    <button type="submit" class="btn btn-primary">Login</button>
                  </div>
                </div>
         
              </form>
            </div>

          </div>
        </div>
      </div>
      <!-- END CONTENT -->
    </div>
    <!-- END SIDEBAR & CONTENT -->
  </div>
</div>
<script>
 function validateFrm() {
    $("#name_error").html("");
    if ($("#name").val() == "") {
      $("#name_error").html("Enter User Name");
      $("#name").focus();            
      return false;
    }
       
    $("#password_error").html("");
    if ($("#password").val() == "") {
        $("#password_error").html("Enter Password");
        $("#password").focus();
        return false;
    } 
 }        
</script>