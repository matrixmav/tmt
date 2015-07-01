<?php
$action = 'Add';
if(!empty($projectObject)){
    $action = 'Edit';
}
$this->breadcrumbs = array(
    'Project' => array('/admin/user/'),
    $action
);
?>
<?php 
$mailObject = array();
if(!empty($error)){
    echo "<p>".$error."</p>";
}
?>

<form class="form-horizontal" role="form" id="form_admin_reservation" enctype="multipart/form-data" action="/admin/user/addproject" method="post" onsubmit="return validation()">
<div class="col-md-12 form-group">
    <label class="col-md-2">Project Name: *</label>
    <div class="col-md-6">
        <input type="text" class="form-control dvalid" name="project_name" id="project_name" size="60" maxlength="75" value="<?php echo (!empty($projectObject)) ? $projectObject->name : ""; ?>" />
        <span style="color:red" id="project_name_error"></span>
    </div>
</div>
<div class="col-md-12 form-group">
    <label class="col-md-2">Client Name*</label>
    <div class="col-md-6">
        <input type="text" class="form-control dvalid" name="client_name" id="client_name" size="60" maxlength="75" value="<?php echo (!empty($projectObject)) ? $projectObject->client_name : ""; ?>" />
        <span style="color:red" id="client_name_error"></span>
    </div>
</div>
<div class="col-md-12 form-group">
    <label class="col-md-2">Client Phone No. *</label>
    <div class="col-md-6">
        <input type="text" class="form-control" name="client_phone" id="client_phone" size="60" maxlength="11" value="<?php echo (!empty($projectObject)) ? $projectObject->client_phone: ""; ?>" />
        <span style="color:red"  id="client_phone_error"></span>
    </div>
</div>
<div class="col-md-12 form-group">
    <label class="col-md-2">Client Email*</label>
    <div class="col-md-6">
        <input type="text" class="form-control dvalid" name="client_email" id="client_email" size="60" maxlength="75" value="<?php echo (!empty($projectObject)) ? $projectObject->client_email : ""; ?>" />
        <span style="color:red"  id="client_email_error"></span>
    </div>
</div>
<div class="col-md-12 form-group">
    <label class="col-md-2"></label>
    <div class="col-md-6">
        <input type="submit" class="btn green" name="submit" id="submit" size="60" maxlength="75" class="textBox" value="Submit" />
    </div>
</div> 
</form>

<script src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/common.js" type="text/javascript"></script>
<script language = "Javascript">
   /* function validateForm(){
        if($("#project_name").val()==""){
            $("#project_name_error").html("Please Enter Project Name.!!!");
            return false;
        }
        if($("#client_name").val()==""){
            $("#client_name_error").html("Please Enter Client Name.!!!");
            return false;
        }
        if($("#client_phone").val()==""){
            $("#client_phone_error").html("Please Enter Client Phone.!!!");
            return false;
        }
        if($("#client_email").val()==""){
            $("#client_email_error").html("Please Enter Client Email.!!!");
            return false;
        }
    }*/
    
            function validation()
            {
                
             project_name = requiredField('project_name', 'project_name_error', 'Please enter Project Name.');
            if (!project_name) {
                return false;
            }
            client_name = requiredField('client_name', 'client_name_error', 'Please the Client enter Name.');
            if (!client_name) {
                return false;
            }
            phone = requiredField('client_phone', 'client_phone_error', 'Please enter contact number');
            if (!phone) {
                return false;
            }
            valid_phone = isValidPhone('client_phone', 'client_phone_error', 'Please enter valid contact number');
            if (!valid_phone) {
                return false;
            }
            email = requiredField('client_email', 'client_email_error', 'Please enter Email Id.');
            if (!email) {
                return false;
            }
            email_valid = isValidEmail('client_email', 'client_email_error', 'Please enter Valid Email Id.');
            if (!email_valid) {
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
                        $("#client_email_error").html("");
                        $("#Flag").val("0");
                    }
                    else
                    {
                        $("#client_email_error").html("Email id already exists");
                        $("#Flag").val("1");
                        $("#email").focus();
                    }
                }
            });
        }
    
</script>