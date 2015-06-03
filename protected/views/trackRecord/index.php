<?php
/* @var $this TrackRecordController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Track Records',
);

$this->menu=array(
	array('label'=>'Create TrackRecord', 'url'=>array('create')),
	array('label'=>'Manage TrackRecord', 'url'=>array('admin')),
);
?>

<h1>Track Records</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
