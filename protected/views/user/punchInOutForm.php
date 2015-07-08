<?php if (!isset($punchInObject) || empty($punchInObject)): ?>
    <form class="form-horizontal" role="form" action="/user/getfunchinformsubmit" method="POST" onsubmit="return validation();">
        <div class="form-group">
            <label class="control-label col-sm-2" for="note">Select:</label>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" id="status" value="1" name="status">Yes</label>
                <label class="radio-inline"><input type="radio" id="status" value="0" name="status">No</label>
                <div style="color:red;" class="error-msg" id="error_status"></div> 
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="note">Note:</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="5" id="note" name="note"> </textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

    <script src="<?php echo Yii::app()->getBaseUrl(true); ?>/js/common.js" type="text/javascript"></script>
    <script type="text/javascript">
        function validation()
        {
            if (!$('input[name=status]:checked').length > 0) {
                $("#error_status").html("Please select Yes/No");
                return false;
            }
        }
    </script>
<?php else: ?>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <p> You already been Punched IN. </p>
        </div>
    </div>
<?php endif; ?>
