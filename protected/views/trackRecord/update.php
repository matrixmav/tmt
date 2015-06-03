<?php
/* @var $this TrackRecordController */
/* @var $model TrackRecord */

$this->breadcrumbs=array(
	'Track Records'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TrackRecord', 'url'=>array('index')),
	array('label'=>'Create TrackRecord', 'url'=>array('create')),
	array('label'=>'View TrackRecord', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TrackRecord', 'url'=>array('admin')),
);
?>

<h1>Update TrackRecord <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>