<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
);
?>
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
                    'name'=>'project_id',
                    'header'=>'<span style="white-space: nowrap;">Project Name &nbsp; &nbsp; &nbsp;</span>',
                    'value'=>'isset($data->project->name)?$data->project->name:""',
		),
		array(
                    'name'=>'to_time',
                    'header'=>'<span style="white-space: nowrap;">To Time &nbsp; &nbsp; &nbsp;</span>',
                    'value'=>'isset($data->to_time)?$data->to_time:""',
		),
            array(
                    'name'=>'from_time',
                    'header'=>'<span style="white-space: nowrap;">From Time &nbsp; &nbsp; &nbsp;</span>',
                    'value'=>'isset($data->from_time)?$data->from_time:""',
		),
            array(
                    'name'=>'description',
                    'header'=>'<span style="white-space: nowrap;">Description &nbsp; &nbsp; &nbsp;</span>',
                    'value'=>'isset($data->description)?$data->description:""',
		),  
             array(
                    'name'=>'updated_at',
                    'header'=>'<span style="white-space: nowrap;">Date Time &nbsp; &nbsp; &nbsp;</span>',
                    'value'=>'isset($data->updated_at)?$data->updated_at:""',
		),
            
	),
)); ?>
                    

      </div>
    </div>
