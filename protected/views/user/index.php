<link rel="stylesheet" type="text/css" href="/metronic/assets/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="/metronic/assets/plugins/select2/select2-metronic.css"/>
<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Users',
);

$this->menu = array(
    array('label' => 'Create User', 'url' => array('create')),
    array('label' => 'Manage User', 'url' => array('admin')),
);
?>
<?php
date_default_timezone_set('Asia/Calcutta');
$curtime = date("h:i a");
$projectId = "";
if (isset($_GET['id'])) {
    $projectId = $_GET['id'];
}
?>
<?php if (!empty(Yii::app()->session['smg'])) { ?>
    <div class="col-md-4" id="col-md-4-msg">
        <span id="project_id_error" class="success" ><?php
            echo Yii::app()->session['smg'];
            Yii::app()->session['smg'] = "";
            ?></span>
        <br /><br /></div>
<?php } ?>

<?php if (Yii::app()->user->hasFlash('success')): ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>

<?php if (Yii::app()->user->hasFlash('error')): ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>

<form class="form-horizontal" role="form" id="form_admin_reservation" enctype="multipart/form-data" action="/user/savetrack" method="post" onsubmit="return validateForm();">
    <div class="col-md-12 form-group">
        <button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal" type="button" data-target="#funchinModel" onclick='return getContent("funchinModel")'>Punch In</button>
        <label class="col-md-2">Project: *</label>
        <div class="col-md-6">
            <select class="form-control input-small pull-left select2me" data-placeholder="Select..." name="project_id" id="project_id" onchange="isProjectExisted(this.value);">
                <option value="">Select Project</option>
                <?php foreach ($projectObject as $project) { ?>
                    <option value="<?php echo $project->id; ?>" <?php echo ($project->id == $projectId) ? "selected" : ""; ?>> <?php echo $project->name; ?> </option>";
                <?php } ?>
            </select>
        </div>
        <div class="col-md-4">
            <span id="project_id_error" style="display:none;" class="error" ></span>
        </div>
    </div>
    <div class="col-md-12 form-group">
        <label class="col-md-2">Description: *</label>
        <div class="col-md-6">
            <textarea class="form-control dvalid" id="description" name="description" value=""></textarea>

        </div>
        <div class="col-md-4">
            <span id="description_error" style="display:none;" class="error" ></span>
        </div>
    </div>
    <div id="time-frame" style="display:none;">
        <div class="col-md-12 form-group" >
            <label class="col-md-2">Start Time: </label>
            <div class="col-md-6" id="to-time-field">
                <input type="hidden" class="form-control input-small pull-left select2me" data-placeholder="Select..." name="to_time" id="to_time" value="<?php echo $curtime; ?>">
                <span id="started_time"></span>
            </div>
            <div class="col-md-6" id="to-time-button">
                <input type="submit" class="btn green" name="submit" id="submit" size="60" maxlength="75" class="textBox"  value="Start" onclick="" />
                <?php echo $curtime; ?>
            </div>
        </div>
        <div class="col-md-12 form-group" id="from-time-button">
            <label class="col-md-2">End Time: </label>
            <div class="col-md-6"  id="from-time-field">
                <Input type="hidden" class="form-control input-small pull-left select2me" data-placeholder="Select..." name="from_time" id="from_time" value="">
            </div>
            <div class="col-md-6"  id="from-time-button">
                <input type="submit" class="btn green" name="submit" id="submit" size="60" maxlength="75" class="textBox"  value="End"/>
                <?php echo $curtime; ?>
            </div>
        </div>
    </div>
</form>
<?php if (isset($projectId)) { ?>
    <script language = "Javascript">
        isProjectExisted(<?php echo $projectId; ?>);
        function isProjectExisted(projectId) {
            $.ajax({
                url: "/user/isprojectexisted",
                type: "post",
                dataType: 'json',
                data: {'projectId': projectId},
                success: function (data) {
                    $("#time-frame").show();
                    if (data == 0) {
                        $("#time-frame").show();
                        $("#to-time-button").show();
                        $("#from-time-button").hide();
                        $("#started_time").html('');
                        $("#description").html('');
                    } else {
                        $("#started_time").html(data.to_time);
                        $("#description").html(data.description);
                        $("#to-time-button").hide();
                        $("#from-time-button").show();
                    }

                },
                error: function () {
                    alert("failure");
                    $("#project_id_error").html('There is error while submit');
                }
            });
        }
    </script>
<?php }
?>
<script language = "Javascript">
    setTimeout(function () {
        $('#project_id_error').fadeOut('fast');
    }, 5000);
</script>
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

    function isProjectExisted(projectId) {
        $.ajax({
            url: "/user/isprojectexisted",
            type: "post",
            dataType: 'json',
            data: {'projectId': projectId},
            success: function (data) {
                $("#time-frame").show();
                if (data == 0) {
                    $("#time-frame").show();
                    $("#to-time-button").show();
                    $("#from-time-button").hide();
                    $("#started_time").html('');
                    $("#description").html('');
                } else {
                    $("#started_time").html(data.to_time);
                    $("#description").html(data.description);
                    $("#to-time-button").hide();
                    $("#from-time-button").show();
                }

            },
            error: function () {
                alert("failure");
                $("#project_id_error").html('There is error while submit');
            }
        });
    }

    function getContent(divId) {
        $.ajax({
            url: '/user/getfunchinform',
            success: function (data) {
                $("#model-window").html(data);
            }
        });
        return false;
    }
</script>


<!-- Modal Window-->
<div class="modal fade modal-vertical-centered" style="" id="funchinModel" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">PuchIn/PuchOut Information</h4>
            </div>

            <div class="modal-body" id="model-window">
            </div>
            <div class="modal-footer">                
            </div>
        </div>
    </div>
</div>