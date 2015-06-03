<?php
$this->breadcrumbs = array(
    'Admin' => array('/admin/user/'),
    'Add Project'
);
?>
<?php 
$mailObject = array();
if(!empty($error)){
    echo "<p>".$error."</p>";
}
?>

<form class="form-horizontal" role="form" id="form_admin_reservation" enctype="multipart/form-data" action="/admin/user/addproject" method="post" onsubmit="return validateForm()">
<div class="col-md-12 form-group">
    <label class="col-md-2">Project Name: *</label>
    <div class="col-md-6">
        <input type="text" class="form-control dvalid" name="project_name" id="project_name" size="60" maxlength="75" value="<?php echo (!empty($empObject)) ? $empObject->touser->email : ""; ?>" />
        <span style="color:red" id="project_name_error"></span>
    </div>
</div>
<div class="col-md-12 form-group">
    <label class="col-md-2">Client Name*</label>
    <div class="col-md-6">
        <input type="text" class="form-control dvalid" name="client_name" id="client_name" size="60" maxlength="75" value="<?php echo (!empty($empObject)) ? $empObject->touser->email : ""; ?>" />
        <span style="color:red" id="client_name_error"></span>
    </div>
</div>
<div class="col-md-12 form-group">
    <label class="col-md-2">Client Phone No. *</label>
    <div class="col-md-6">
        <input type="text" class="form-control dvalid" name="client_phone" id="client_phone" size="60" maxlength="75" value="<?php echo (!empty($empObject)) ? $empObject->touser->email : ""; ?>" />
        <span style="color:red"  id="client_phone_error"></span>
    </div>
</div>
<div class="col-md-12 form-group">
    <label class="col-md-2"></label>
    <div class="col-md-6">
        <input type="submit" class="btn green" name="submit" id="submit" size="60" maxlength="75" class="textBox" value="Submit" />
    </div>
</div> 
</form>
<script language = "Javascript">
    function validateForm(){
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
    }
</script>