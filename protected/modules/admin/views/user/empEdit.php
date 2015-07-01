<?php
$this->breadcrumbs = array(
    'User Edit',
);
?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />

<?php
$actionUrl = "/admin/user/addemp";
if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
    $actionUrl = "/admin/user/empedit?id=" . $_REQUEST['id'];
}
?>
<?php if (isset($error) && !empty($error)): ?>
    <div class="error">
        <?php echo $error; ?>
    </div>
<?php endif; ?>

<div class="col-md-7 col-sm-7">
    <form name="user-add-edit" action="<?php echo $actionUrl; ?>" method="post" class="form-horizontal" onsubmit="return validation();">
        <fieldset>
            <legend> Edit <?php echo $userText; ?> </legend>

            <!-- Start Of User fields -->
            <div class="form-group">
                <label class="col-lg-4 control-label" for="email">Email<span class="require">*</span></label>
                <div class="col-lg-8">
                    <input type="text" id="email" class="form-control" name="email" value="<?php echo (!empty($projectObject)) ? $projectObject->email : ""; ?>" readonly>
                    <div style="color:red;" class="error-msg" id="error_email"> </div>
                    <input type="hidden" id="Flag" value="0">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label" for="full_name">Name<span class="require">*</span></label>
                <div class="col-lg-8">
                    <input type="text" id="full_name" class="form-control" name="full_name" value="<?php echo (!empty($projectObject)) ? $projectObject->full_name : ""; ?>">
                    <div style="color:red;" class="error-msg" id="error_full_name"> </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label" for="password">Password</label>
                <div class="col-lg-8">
                    <input type="password" id="password" class="form-control" name="password">
                    <div style="color:red;" class="error-msg" id="error_password"> </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label" for="confirm-password">Confirm Password</label>
                <div class="col-lg-8">
                    <input type="password" id="confirm-password" class="form-control" name="confirm-password">
                    <div style="color:red;" class="error-msg" id="error_confirm-password"> </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label" for="phone">Phone<span class="require">*</span></label>
                <div class="col-lg-8">
                    <input type="text" id="phone" class="form-control" name="phone" value="<?php echo (!empty($projectObject)) ? $projectObject->phone : ""; ?>">
                    <div style="color:red;" class="error-msg" id="error_phone"> </div> 
                </div>
            </div>

       
            <div class="form-group">
                <label class="col-lg-4 control-label" for="address">Address<span class="require">*</span></label>
                <div class="col-lg-8">
                    <textarea id="address" name="address" class="form-control" ><?php echo (!empty($projectObject)) ? $projectObject->address : ""; ?></textarea>
                    <div style="color:red;" class="error-msg" id="error_address_1"> </div> 
                </div>
            </div>

          
           

        </fieldset>
        <div class="row">
            <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20">                        
                <input type="submit" name="submit" value="Submit" class="btn red">
            </div>
        </div>
    </form>
</div>

<script src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/common.js" type="text/javascript"></script>
<script type="text/javascript">
        function validation()
        {
            email = requiredField('email', 'error_email', 'Please enter Email Id.');
            if (!email) {
                return false;
            }
            email_valid = isValidEmail('email', 'error_email', 'Please enter Valid Email Id.');
            if (!email_valid) {
                return false;
            }
            full_name = requiredField('full_name', 'error_full_name', 'Please enter Name.');
            if (!full_name) {
                return false;
            }
            valid_password = validatePasswsord('password', 'confirm-password', 'error_password', '');
            if (!valid_password) {
                return false;
            }
            phone = requiredField('phone', 'error_phone', 'Please enter contact number');
            if (!phone) {
                return false;
            }
            valid_phone = isValidPhone('phone', 'error_phone', 'Please enter valid contact number');
            if (!valid_phone) {
                return false;
            }
           
            address = requiredField('address', 'error_address_1', 'Please enter address');
            if (!address) {
                return false;
            }
          
            
        }
        function isEmailExist(emailId) {
            $.ajax({
                type: "POST",
                url: "/user/isemailexist",
                data: {emailId: emailId},
                cache: false,
                success: function (data) {
                    if (data == "0") {
                        $("#email_error").html("");
                        $("#Flag").val("0");
                    }
                    else
                    {
                        $("#error_email").html("Email id already exists");
                        $("#Flag").val("1");
                        $("#email").focus();
                    }
                }
            });
        }
</script>



