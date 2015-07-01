<?php
$this->breadcrumbs = array(
    'User Edit',
);
?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />

<?php
$actionUrl = "/admin/user/addproject";
if (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) {
    $actionUrl = "/admin/user/edit?id=" . $_REQUEST['id'];
}

?>
<?php if (isset($error) && !empty($error)): ?>
    <div class="error">
        <?php echo $error; ?>
    </div>
<?php endif; ?>

<div class="col-md-7 col-sm-7">
    <form  action="<?php echo $actionUrl; ?>" method="post" class="form-horizontal" onsubmit="return validation();">
        <fieldset>
            <legend> Edit <?php echo $userText; ?> </legend>

            <div class="form-group">
                <label class="col-lg-4 control-label" for="client_email">Client Email<span class="require">*</span></label>
                <div class="col-lg-8">
                    <input type="text" id="email" class="form-control" name="client_email" value="<?php echo (!empty($projectObject)) ? $projectObject->client_email : ""; ?>" >
                    <div style="color:red;" class="error-msg" id="error_email"> </div>
                    <input type="hidden" id="Flag" value="0">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-4 control-label" for="name">Project Name<span class="require">*</span></label>
                <div class="col-lg-8">
                    <input type="text" id="project_name" class="form-control" name="name" value="<?php echo (!empty($projectObject)) ? $projectObject->name : ""; ?>" >
                    <div style="color:red;" class="error-msg" id="error_project_name"> </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-4 control-label" for="client_name">Client Name<span class="require">*</span></label>
                <div class="col-lg-8">
                    <input type="text" id="client_name" class="form-control" name="client_name" value="<?php echo (!empty($projectObject)) ? $projectObject->client_name : ""; ?>" >
                    <div style="color:red;" class="error-msg" id="error_client_name"> </div>
                </div>
            </div>

            
            <div class="form-group">
                <label class="col-lg-4 control-label" for="client_phone">Client Phone<span class="require">*</span></label>
                <div class="col-lg-8">
                    <input type="text" id="phone" class="form-control" name="client_phone" value="<?php echo (!empty($projectObject)) ? $projectObject->client_phone : ""; ?>">
                    <div style="color:red;" class="error-msg" id="error_phone"> </div> 
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
            project_name = requiredField('project_name', 'error_project_name', 'Please enter Project Name.');
            if (!project_name) {
                return false;
            }
            client_name = requiredField('client_name', 'error_client_name', 'Please the Client enter Name.');
            if (!client_name) {
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

<script>
    $(function () {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
</script>


