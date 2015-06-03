<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Project' => array('/admin/user/wallet'),
);
?>

<div class="expiration margin-topDefault">
    <!--<p>Client/ Hotel/ Bill : <?php //echo $clientObject->name; ?></p>-->
    <form id="user_filter_frm" name="user_filter_frm" method="post" action="/admin/user/projectlist" />
    <div class="col-md-3">
        <input type="text" name="search" id="search" class="form-control" value="" />
    </div>
    <input type="submit" class="btn btn-primary" value="OK" name="submit" id="submit"/>
    </form>
    <a href="/admin/user/addproject"  class="btn btn-primary pull-right" name="submit">ADD</a>
</div>
<div class="row">
    <div class="col-md-12">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'state-grid',
            'dataProvider' => $dataProvider,
            'enableSorting' => 'true',
            'ajaxUpdate' => true,
            'summaryText' => 'Showing {start} to {end} of {count} entries',
            'template' => '{items} {summary} {pager}',
            'itemsCssClass' => 'table table-striped table-bordered table-hover table-full-width',
            'pager' => array(
                'header' => false,
                'firstPageLabel' => "<<",
                'prevPageLabel' => "<",
                'nextPageLabel' => ">",
                'lastPageLabel' => ">>",
            ),
            'columns' => array(
                //'idJob',
                array(
                    'name' => 'name',
                    'header' => '<span style="white-space: nowrap;">Project Name &nbsp; &nbsp; &nbsp;</span>',
                    'value' => '$data->name',
                ),
                array(
                    'name' => 'client_name',
                    'header' => '<span style="white-space: nowrap;">Client Name &nbsp; &nbsp; &nbsp;</span>',
                    'value' => '$data->client_name',
                ),
                array(
                    'name' => 'client_phone',
                    'header' => '<span style="white-space: nowrap;">Client Phone &nbsp; &nbsp; &nbsp;</span>',
                    'value' => '$data->client_phone',
                ),
                array(
                    'name' => 'status',
                    'value' => '($data->status == 1) ? Yii::t(\'translation\', \'In-Progress\') : Yii::t(\'translation\', \'Completed\')',
                ),
//                array(
//                    'class' => 'CButtonColumn',
//                    'template' => '{Edit}{Delete}',
//                    'htmlOptions' => array('width' => '23%'),
//                    'buttons' => array(
//                        'Edit' => array(
//                            'label' => 'Edit',
//                            'options' => array('class' => 'btn purple fa fa-edit margin-right15'),
//                            'url' => 'Yii::app()->createUrl("admin/user/creditwallet", array("id"=>$data->id))',
//                        ),
//                        'Delete' => array(
//                            'label' => Yii::t('translation', 'Change Status'),
//                            'options' => array('class' => 'fa fa-success btn default black delete'),
//                            'url' => 'Yii::app()->createUrl("admin/user/debitwallet", array("id"=>$data->id))',
//                        ),
//                    ),
//                ),
            ),
        ));
        ?>
    </div>
</div>
