<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Bug'=>array('index'),'Closed'
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
<div class="main">
      <div class="container">

        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">

          <!-- END SIDEBAR -->
          <!-- BEGIN CONTENT -->
          <div class="col-md-10 col-sm-9">
       
        <?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'city-grid',
	'dataProvider'=>$dataProvider,
	'enableSorting'=>'true',
	'ajaxUpdate'=>true,
	'summaryText'=>'Showing {start} to {end} of {count} entries',
	'template'=>'{items} {summary} {pager}',
	'itemsCssClass'=>'table table-striped table-bordered table-hover table-full-width',
	'pager'=>array(
		'header'=>false,
		'firstPageLabel' => "<<",
		'prevPageLabel' => "<",
		'nextPageLabel' => ">",
		'lastPageLabel' => ">>",
	),	
	'columns'=>array(
		//'idJob',
		array(
                    'name' => 'id',
                    'header'=>'No.',
                    'value'=>'$row+1',
                ),
		array(
                    'name'=>'user_id',
                    'header'=>'<span style="white-space: nowrap;">Reported By &nbsp; &nbsp; &nbsp;</span>',
                    'value'=>'isset($data->user->full_name)?$data->user->full_name:""',
		),
            array(
                    'name'=>'updated_by',
                    'header'=>'<span style="white-space: nowrap;">From Time &nbsp; &nbsp; &nbsp;</span>',
                    'value'=>'isset($data->updatedby->full_name)?$data->updatedby->full_name:""',
		),
            array(
                    'name'=>'title',
                    'header'=>'<span style="white-space: nowrap;">Title &nbsp; &nbsp; &nbsp;</span>',
                    'value'=>'isset($data->title)?$data->title:""',
		), 
            array(
                    'name'=>'description',
                    'header'=>'<span style="white-space: nowrap;">Description &nbsp; &nbsp; &nbsp;</span>',
                    'value'=>'isset($data->description)?$data->description:""',
		), 
             array(
                    'name'=>'priority',
                    'header'=>'<span style="white-space: nowrap;">Priority &nbsp; &nbsp; &nbsp;</span>',
                    'value'=>array($this,'getPriority'),
		), 
             array(
                    'name'=>'status',
                    'header'=>'<span style="white-space: nowrap;">Status &nbsp; &nbsp; &nbsp;</span>',
                    'value'=>array($this,'getStatus'),
		), 
             array(
                    'name'=>'update_at',
                    'header'=>'<span style="white-space: nowrap;">Date Time &nbsp; &nbsp; &nbsp;</span>',
                    'value'=>'isset($data->update_at)?$data->update_at:""',
		),
            
	),
)); ?>
                    

      </div>
    </div>
