<?php
/* @var $this TrackRecordController */
/* @var $model TrackRecord */

$this->breadcrumbs=array(
	'Track Records'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TrackRecord', 'url'=>array('index')),
	array('label'=>'Manage TrackRecord', 'url'=>array('admin')),
);
?>

<h1>Create TrackRecord</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>