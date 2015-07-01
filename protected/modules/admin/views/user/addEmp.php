<?php
$this->breadcrumbs = array(
    'Wallet' => array('/admin/mail'),
    'Recharge'
);
?>
<?php 
$mailObject = array();
if(!empty($error)){
    echo "<p>".$error."</p>";
}
?>
<style>
    .cerror
    {
        color: red;
    }
</style>
<form class="form-horizontal" role="form" id="form_admin_reservation" enctype="multipart/form-data" action="/admin/user/addemp" method="post" onsubmit="return validateForm()">
<input type="hidden" name="userId" id="userId" value="<?php echo (!empty($userObject))? $userObject->id : ""; ?>"/>
<div class="col-md-12 form-group">
    <label class="col-md-2">Full Name: </label>
    <div class="col-md-6">
        <input type="text" class="form-control dvalid" name="full_name" id="full_name" size="60" maxlength="75" value="<?php echo (!empty($empObject)) ? $empObject->touser->email : ""; ?>" />
        <span class="cerror" id="full_name_error"></span>
    </div>
</div>
<div class="col-md-12 form-group">
    <label class="col-md-2">Email *</label>
    <div class="col-md-6">
        <input type="text" class="form-control dvalid" name="email" id="email" size="60" maxlength="75" value="<?php echo (!empty($empObject)) ? $empObject->touser->email : ""; ?>" />
        <span class="cerror" id="email_error"></span>
    </div>
</div>
<div class="col-md-12 form-group">
    <label class="col-md-2">Emp No. *</label>
    <div class="col-md-6">
        <input type="text" class="form-control dvalid" name="emp_no" id="emp_no" size="60" maxlength="75" value="<?php echo (!empty($empObject)) ? $empObject->touser->email : ""; ?>" />
        <span class="cerror"  id="emp_no_error"></span>
    </div>
</div>
<div class="col-md-12 form-group">
    <label class="col-md-2">Address *</label>
    <div class="col-md-6">
        <textarea  class="form-control dvalid" name="address" id="address" ></textarea>
        <span class="cerror" id="address_error"></span>
    </div>
</div>
<div class="col-md-12 form-group">
    <label class="col-md-2">Phone No. *</label>
    <div class="col-md-6">
        <input type="text" class="form-control dvalid" name="phone" id="phone" size="60" maxlength="75" value="<?php echo (!empty($empObject)) ? $empObject->touser->email : ""; ?>" />
        <span class="cerror"   id="address_error"></span>
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
        if($("#full_name").val()==""){
            $("#full_name_error").html("Please Enter Full Name.!!!");
            return false;
        }
        if($("#email").val()==""){
            $("#email_error").html("Please Enter Email.!!!");
            return false;
        }
        if($("#emp_no").val()==""){
            $("#emp_no_error").html("Please Enter Emp No.!!!");
            return false;
        }
        if($("#phone").val()==""){
            $("#address_error").html("Please Enter Phone No.!!!");
            return false;
        }
    }
</script>