<link rel="stylesheet" type="text/css" href="/metronic/assets/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="/metronic/assets/plugins/select2/select2-metronic.css"/>
<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Users',
);

$this->menu=array(
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);

?>
<?php if(!empty(Yii::app()->session['smg'])) { ?>
<div class="col-md-4">
    <span id="project_id_error" class="success" ><?php echo Yii::app()->session['smg']; Yii::app()->session['smg']="";?></span>
    <br /><br /></div>
<?php } ?>
<form class="form-horizontal" role="form" id="form_admin_reservation" enctype="multipart/form-data" action="/user/savetrack" method="post" onsubmit="return validateForm()">
<div class="col-md-12 form-group">
    <label class="col-md-2">Project: </label>
    <div class="col-md-6">
        <select class="form-control input-small pull-left select2me" data-placeholder="Select..." name="project_id" id="project_id">
            <option value="">Select Project</option>
            <?php foreach ($projectObject as $project) { ?>
                <option value="<?php echo $project->id; ?>" > <?php echo $project->name; ?> </option>";
            <?php } ?>
        </select>
    </div>
    <div class="col-md-4">
    <span id="project_id_error" style="display:none;" class="error" ></span>
    </div>
</div>
<div class="col-md-12 form-group">
    <label class="col-md-2">Start Time: </label>
    <div class="col-md-6">
        <select class="form-control input-small pull-left select2me" data-placeholder="Select..." name="to_time" id="to_time">
              <option value="07:00AM">07 : 00 AM</option>
              <option value="07:30AM">07 : 30 AM</option>
              <option value="08:00AM">08 : 00 AM</option>
              <option value="08:30AM">08 : 30 AM</option>
              <option value="09:00AM">09 : 00 AM</option>
              <option value="09:30AM">09 : 30 AM</option>
              <option value="10:00AM">10 : 00 AM</option>
              <option value="10:30AM">10 : 30 AM</option>
              <option value="11:00AM">11 : 00 AM</option>
              <option value="11:30AM">11 : 30 AM</option>
              <option value="12:00PM">12 : 00 PM</option>
              <option value="12:30PM">12 : 30 PM</option>
              <option value="01:00PM">01 : 00 PM</option>
              <option value="01:30PM">01 : 30 PM</option>
              <option value="02:00PM">02 : 00 PM</option>
              <option value="02:30PM">02 : 30 PM</option>
              <option value="03:00PM">03 : 00 PM</option>
              <option value="03:30PM">03 : 30 PM</option>
              <option value="04:00PM">04 : 00 PM</option>
              <option value="04:30PM">04 : 30 PM</option>
              <option value="05:00PM">05 : 00 PM</option>
              <option value="05:30PM">05 : 30 PM</option>
              <option value="06:00PM">06 : 00 PM</option>
              <option value="06:30PM">06 : 30 PM</option>
              <option value="07:00PM">07 : 00 PM</option>
              <option value="07:30PM">07 : 30 PM</option>
              <option value="08:00PM">08 : 00 PM</option>
              <option value="08:30PM">08 : 30 PM</option>
              <option value="09:00PM">09 : 00 PM</option>
              <option value="09:30PM">09 : 30 PM</option>
              <option value="10:00PM">10 : 00 PM</option>
              <option value="10:30PM">10 : 30 PM</option>
              <option value="11:00PM">11 : 00 PM</option>
              <option value="11:30PM">11 : 30 PM</option>
            </select>
    </div>
</div>
<div class="col-md-12 form-group">
    <label class="col-md-2">End Time: </label>
    <div class="col-md-6">
        <select class="form-control input-small pull-left select2me" data-placeholder="Select..." name="from_time" id="from_time">
              <option value="07:00AM">07 : 00 AM</option>
              <option value="07:30AM">07 : 30 AM</option>
              <option value="08:00AM">08 : 00 AM</option>
              <option value="08:30AM">08 : 30 AM</option>
              <option value="09:00AM">09 : 00 AM</option>
              <option value="09:30AM">09 : 30 AM</option>
              <option value="10:00AM">10 : 00 AM</option>
              <option value="10:30AM">10 : 30 AM</option>
              <option value="11:00AM">11 : 00 AM</option>
              <option value="11:30AM">11 : 30 AM</option>
              <option value="12:00PM">12 : 00 PM</option>
              <option value="12:30PM">12 : 30 PM</option>
              <option value="01:00PM">01 : 00 PM</option>
              <option value="01:30PM">01 : 30 PM</option>
              <option value="02:00PM">02 : 00 PM</option>
              <option value="02:30PM">02 : 30 PM</option>
              <option value="03:00PM">03 : 00 PM</option>
              <option value="03:30PM">03 : 30 PM</option>
              <option value="04:00PM">04 : 00 PM</option>
              <option value="04:30PM">04 : 30 PM</option>
              <option value="05:00PM">05 : 00 PM</option>
              <option value="05:30PM">05 : 30 PM</option>
              <option value="06:00PM">06 : 00 PM</option>
              <option value="06:30PM">06 : 30 PM</option>
              <option value="07:00PM">07 : 00 PM</option>
              <option value="07:30PM">07 : 30 PM</option>
              <option value="08:00PM">08 : 00 PM</option>
              <option value="08:30PM">08 : 30 PM</option>
              <option value="09:00PM">09 : 00 PM</option>
              <option value="09:30PM">09 : 30 PM</option>
              <option value="10:00PM">10 : 00 PM</option>
              <option value="10:30PM">10 : 30 PM</option>
              <option value="11:00PM">11 : 00 PM</option>
              <option value="11:30PM">11 : 30 PM</option>
            </select>
    </div>
</div>
<div class="col-md-12 form-group">
    <label class="col-md-2">Add Fund *</label>
    <div class="col-md-6">
        <textarea class="form-control dvalid" id="description" name="description"></textarea>
        
    </div>
    <div class="col-md-4">
    <span id="description_error" style="display:none;" class="error" ></span>
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
        if($("#project_id").val()==""){
            $("#project_id_error").show();
            $("#project_id_error").html("Please Select Project!!!.");
            return false;
        }
        if($("#description").val()==""){
            $("#description_error").show();
            $("#description_error").html("Please Enter Description!!!.");
            return false;
        }
        
        
        
    }
</script>