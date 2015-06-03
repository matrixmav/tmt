<?php
/* @var $this TrackRecordController */
/* @var $model TrackRecord */

$this->breadcrumbs=array(
	'Track Records'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TrackRecord', 'url'=>array('index')),
	array('label'=>'Create TrackRecord', 'url'=>array('create')),
	array('label'=>'Update TrackRecord', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TrackRecord', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TrackRecord', 'url'=>array('admin')),
);
?>

<h1>View TrackRecord #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'project_id',
		'description',
		'to_time',
		'from_time',
		'status',
		'created_at',
		'updated_at',
	),
)); ?>
