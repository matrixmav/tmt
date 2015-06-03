<?php
$this->breadcrumbs=array(
	'Bug'=>array('index'),'Create'
);
?>
<div class="expiration margin-topDefault">
    <!--<p>Client/ Hotel/ Bill : <?php //echo $clientObject->name; ?></p>-->
    <div class="col-md-9">
        <!--<input type="text" name="search" id="search" class="form-control" value="" />-->
        <p><h3>Project Name: <span style="color:blue; "><b><?php echo ($projectObject->name)?$projectObject->name:""; ?></b></span></h3></p>
    </div>
    <div class="col-md-6">
        <a href="/BugReport" class="btn green" name="submit" id="submit" size="60" maxlength="75" class="textBox">Open</a>
        <a href="/BugReport/fixed" class="btn green" name="submit" id="submit" size="60" maxlength="75" class="textBox">Fixed</a>
        <a href="/BugReport/closed" class="btn green" name="submit" id="submit" size="60" maxlength="75" class="textBox">Closed</a>
        <a href="/BugReport/reopen" class="btn green" name="submit" id="submit" size="60" maxlength="75" class="textBox">Re-Open</a>
        <a href="/BugReport/create" class="btn green" name="submit" id="submit" size="60" maxlength="75" class="textBox">Create</a>
    </div>
</div>
<div class="col-md-7 col-sm-7">
    <div class="error" id="error_msg" style="display: none;"></div>
    <?php if(!empty(Yii::app()->session['smg'])){?><div class="success" id="error_msg"><?php echo Yii::app()->session['smg'];Yii::app()->session['smg']="";?></div><?php }?>
    <form action="/BugReport/create" method="post" class="form-horizontal" onsubmit="return validation();">
        <fieldset>
            <legend>Create Bug</legend>
            
            <div class="form-group">
                <label class="col-lg-4 control-label" for="title">Title</label>
                <div class="col-lg-8">
                    <input type="text" id="title" class="form-control" name="title" value="">
                </div>
            </div>
            
           <div class="form-group">
                <label class="col-lg-4 control-label" for="description">Description</label>
                <div class="col-lg-8">
                    <textarea id="description" name="description" class="form-control"></textarea>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-4 control-label" for="lastname">Priority<span class="require">*</span></label>
                <div class="col-lg-8">
                    <select id="priority" name="priority" class="form-control">
                        <option value="1">Critical</option>
                        <option value="2">High</option>
                        <option value="3">Medium</option>
                        <option value="4">Low</option>
                    </select>
                </div>
            </div>
            
        </fieldset>

    <div class="row">
            <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20">                        
                <input type="submit" name="submit" value="Update" class="btn red">
                 
            </div>
        </div>
    </form>
</div>





<script type="text/javascript">
    function validation()
    {
        if(document.getElementById("title").value=='')
        {
            document.getElementById("error_msg").style.display="block";
            document.getElementById("error_msg").innerHTML = "Please enter Bug Title.";
            document.getElementById("title").focus();
            return false;
        }
        if(document.getElementById("description").value=='')
        {
            document.getElementById("error_msg").style.display="block";
            document.getElementById("error_msg").innerHTML = "Please enter Bug Description.";
            document.getElementById("description").focus();
            return false;
        }
        
    }
    </script>
     
     