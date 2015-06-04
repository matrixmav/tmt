<link rel="stylesheet" type="text/css" href="/metronic/assets/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="/metronic/assets/plugins/select2/select2-metronic.css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />

<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Users/TrackAdd',
);

$this->menu = array(
    array('label' => 'Create User', 'url' => array('create')),
    array('label' => 'Manage User', 'url' => array('admin')),
);
?>
<?php if (!empty(Yii::app()->session['smg'])) { ?>
    <div class="col-md-4">
        <span id="project_id_error" class="success" ><?php
            echo Yii::app()->session['smg'];
            Yii::app()->session['smg'] = "";
            ?></span>
        <br /><br /></div>
<?php } ?>
<form class="form-horizontal" role="form" id="form_admin_reservation" enctype="multipart/form-data" action="/admin/user/savetrackadd" method="post" onsubmit="return validateForm()">
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
        <label class="col-md-2">User Name: </label>
        <div class="col-md-6">
            <select class="form-control input-small pull-left select2me" data-placeholder="Select..." name="user_id" id="user_id">
                <option value="">Select UserName</option>
                <?php foreach ($userObject as $user) { ?>
                    <option value="<?php echo $user->id; ?>" > <?php echo $user->full_name; ?> </option>";
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
              <option value="07:15AM">07 : 15 AM</option>
              <option value="07:30AM">07 : 30 AM</option>
              <option value="07:45AM">07 : 45 AM</option>
              <option value="08:00AM">08 : 00 AM</option>
              <option value="08:15AM">08 : 15 AM</option>
              <option value="08:30AM">08 : 30 AM</option>
              <option value="08:45AM">08 : 45 AM</option>
              <option value="09:00AM">09 : 00 AM</option>
              <option value="09:15AM">09 : 15 AM</option>
              <option value="09:30AM">09 : 30 AM</option>
              <option value="08:45AM">09 : 45 AM</option>
              <option value="10:00AM">10 : 00 AM</option>
              <option value="10:15AM">10 : 15 AM</option>
              <option value="10:30AM">10 : 30 AM</option>
              <option value="10:45AM">10 : 45 AM</option>
              <option value="11:00AM">11 : 00 AM</option>
              <option value="11:15AM">11 : 15 AM</option>
              <option value="11:30AM">11 : 30 AM</option>
              <option value="11:45AM">11 : 45 AM</option>
              <option value="12:00PM">12 : 00 PM</option>
              <option value="12:15PM">12 : 15 PM</option>
              <option value="12:30PM">12 : 30 PM</option>
              <option value="12:45PM">12 : 45 PM</option>
              <option value="01:00PM">01 : 00 PM</option>
              <option value="01:15PM">01 : 15 PM</option>
              <option value="01:30PM">01 : 30 PM</option>
              <option value="01:45PM">01 : 45 PM</option>
              <option value="02:00PM">02 : 00 PM</option>
              <option value="02:15PM">02 : 15 PM</option>
              <option value="02:30PM">02 : 30 PM</option>
              <option value="02:45AM">02 : 45 PM</option>
              <option value="03:00PM">03 : 00 PM</option>
              <option value="03:15AM">03 : 15 PM</option>
              <option value="03:30PM">03 : 30 PM</option>
              <option value="03:45PM">03 : 45 PM</option>
              <option value="04:00PM">04 : 00 PM</option>
              <option value="04:15PM">04 : 15 PM</option>
              <option value="04:30PM">04 : 30 PM</option>
              <option value="04:45PM">04 : 45 PM</option>
              <option value="05:00PM">05 : 00 PM</option>
              <option value="05:15PM">05 : 15 PM</option>
              <option value="05:30PM">05 : 30 PM</option>
              <option value="05:45PM">05 : 45 PM</option>
              <option value="06:00PM">06 : 00 PM</option>
              <option value="06:15PM">06 : 15 PM</option>
              <option value="06:30PM">06 : 30 PM</option>
              <option value="06:45PM">06 : 45 PM</option>
              <option value="07:00PM">07 : 00 PM</option>
              <option value="07:15PM">07 : 15 PM</option>
              <option value="07:30PM">07 : 30 PM</option>
              <option value="07:45AM">07 : 45 PM</option>
              <option value="08:00PM">08 : 00 PM</option>
              <option value="08:15AM">08 : 15 PM</option>
              <option value="08:30PM">08 : 30 PM</option>
              <option value="08:45PM">08 : 45 PM</option>
              <option value="09:00PM">09 : 00 PM</option>
              <option value="09:15PM">09 : 15 PM</option>
              <option value="09:30PM">09 : 30 PM</option>
              <option value="09:45PM">09 : 45 PM</option>
              <option value="10:00PM">10 : 00 PM</option>
              <option value="10:15PM">10 : 15 PM</option>
              <option value="10:30PM">10 : 30 PM</option>
              <option value="10:45PM">10 : 45 PM</option>
              <option value="11:00PM">11 : 00 PM</option>
              <option value="11:15PM">11 : 15 PM</option>
              <option value="11:30PM">11 : 30 PM</option>
              <option value="11:45PM">11 : 45 PM</option>
            </select>
        </div>
    </div>
    <div class="col-md-12 form-group">
        <label class="col-md-2">End Time: </label>
        <div class="col-md-6">
            <select class="form-control input-small pull-left select2me" data-placeholder="Select..." name="from_time" id="from_time">
              <option value="07:00AM">07 : 00 AM</option>
              <option value="07:15AM">07 : 15 AM</option>
              <option value="07:30AM">07 : 30 AM</option>
              <option value="07:45AM">07 : 45 AM</option>
              <option value="08:00AM">08 : 00 AM</option>
              <option value="08:15AM">08 : 15 AM</option>
              <option value="08:30AM">08 : 30 AM</option>
              <option value="08:45AM">08 : 45 AM</option>
              <option value="09:00AM">09 : 00 AM</option>
              <option value="09:15AM">09 : 15 AM</option>
              <option value="09:30AM">09 : 30 AM</option>
              <option value="08:45AM">09 : 45 AM</option>
              <option value="10:00AM">10 : 00 AM</option>
              <option value="10:15AM">10 : 15 AM</option>
              <option value="10:30AM">10 : 30 AM</option>
              <option value="10:45AM">10 : 45 AM</option>
              <option value="11:00AM">11 : 00 AM</option>
              <option value="11:15AM">11 : 15 AM</option>
              <option value="11:30AM">11 : 30 AM</option>
              <option value="11:45AM">11 : 45 AM</option>
              <option value="12:00PM">12 : 00 PM</option>
              <option value="12:15PM">12 : 15 PM</option>
              <option value="12:30PM">12 : 30 PM</option>
              <option value="12:45PM">12 : 45 PM</option>
              <option value="01:00PM">01 : 00 PM</option>
              <option value="01:15PM">01 : 15 PM</option>
              <option value="01:30PM">01 : 30 PM</option>
              <option value="01:45PM">01 : 45 PM</option>
              <option value="02:00PM">02 : 00 PM</option>
              <option value="02:15PM">02 : 15 PM</option>
              <option value="02:30PM">02 : 30 PM</option>
              <option value="02:45AM">02 : 45 PM</option>
              <option value="03:00PM">03 : 00 PM</option>
              <option value="03:15AM">03 : 15 PM</option>
              <option value="03:30PM">03 : 30 PM</option>
              <option value="03:45PM">03 : 45 PM</option>
              <option value="04:00PM">04 : 00 PM</option>
              <option value="04:15PM">04 : 15 PM</option>
              <option value="04:30PM">04 : 30 PM</option>
              <option value="04:45PM">04 : 45 PM</option>
              <option value="05:00PM">05 : 00 PM</option>
              <option value="05:15PM">05 : 15 PM</option>
              <option value="05:30PM">05 : 30 PM</option>
              <option value="05:45PM">05 : 45 PM</option>
              <option value="06:00PM">06 : 00 PM</option>
              <option value="06:15PM">06 : 15 PM</option>
              <option value="06:30PM">06 : 30 PM</option>
              <option value="06:45PM">06 : 45 PM</option>
              <option value="07:00PM">07 : 00 PM</option>
              <option value="07:15PM">07 : 15 PM</option>
              <option value="07:30PM">07 : 30 PM</option>
              <option value="07:45AM">07 : 45 PM</option>
              <option value="08:00PM">08 : 00 PM</option>
              <option value="08:15AM">08 : 15 PM</option>
              <option value="08:30PM">08 : 30 PM</option>
              <option value="08:45PM">08 : 45 PM</option>
              <option value="09:00PM">09 : 00 PM</option>
              <option value="09:15PM">09 : 15 PM</option>
              <option value="09:30PM">09 : 30 PM</option>
              <option value="09:45PM">09 : 45 PM</option>
              <option value="10:00PM">10 : 00 PM</option>
              <option value="10:15PM">10 : 15 PM</option>
              <option value="10:30PM">10 : 30 PM</option>
              <option value="10:45PM">10 : 45 PM</option>
              <option value="11:00PM">11 : 00 PM</option>
              <option value="11:15PM">11 : 15 PM</option>
              <option value="11:30PM">11 : 30 PM</option>
              <option value="11:45PM">11 : 45 PM</option>
            </select>
        </div>
    </div>
    <div class="col-md-12 form-group">
        <label class="col-md-2">Date *</label>
        <div class="col-md-4">
            <input type="text" name="created_at"  placeholder="Date" class="datepicker form-control input-sm">
        </div>
        <div class="col-md-2">
            <span id="description_error" style="display:none;" class="error" ></span>
        </div>
    </div>

    <div class="col-md-12 form-group">
        <label class="col-md-2">Description *</label>
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
    function validateForm() {
        if ($("#project_id").val() == "") {
            $("#project_id_error").show();
            $("#project_id_error").html("Please Select Project!!!.");
            return false;
        }
        if ($("#description").val() == "") {
            $("#description_error").show();
            $("#description_error").html("Please Enter Description!!!.");
            return false;
        }
    }
</script>
<script>
    $(function () {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
</script>
