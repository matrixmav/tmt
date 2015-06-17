<?php
$this->breadcrumbs = array(
    'Bug' => array('index'), 'Write Comment'
);
?>

<div class="col-md-7 col-sm-7">
    <div class="error" id="error_msg" style="display: none;"></div>
    <?php if (!empty(Yii::app()->session['smg'])) { ?><div class="success" id="error_msg"><?php echo Yii::app()->session['smg'];
    Yii::app()->session['smg'] = ""; ?></div><?php } ?>
    <form action="/BugReport/changestatus" method="post" class="form-horizontal" onsubmit="return validation();">
        <fieldset>
            <legend>Write a Comment</legend>

            <div class="form-group">
                <label class="col-lg-4 control-label" for="title">Title</label>
                <div class="col-lg-8">
                    <input type="text" disabled="true" id="title" class="form-control" name="title" value="<?= $bugReportObject->title; ?>">
                    <input type="hidden" id="bug_id" class="form-control" name="big_id" value="<?= $bugReportObject->id; ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label" for="add-comment">Add Comment</label>
                <div class="col-lg-8">
                    <textarea id="add-comment" name="add-comment" class="form-control"></textarea>
                </div>
            </div>

        </fieldset>

        <div class="row">
            <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20">                        
                <input type="submit" name="submit" onclick="return confirm('Are you sure you want to submit ?');" value="submit" class="btn red" />                 
            </div>
        </div>
    </form>
</div>


<script type="text/javascript">
    function validation()
    {
        if (document.getElementById("add-comment").value == '')
        {
            document.getElementById("error_msg").style.display = "block";
            document.getElementById("error_msg").innerHTML = "Please add a comment.";
            document.getElementById("add-comment").focus();
            return false;
        }

    }
</script>

