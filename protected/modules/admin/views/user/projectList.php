<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Project' => array('/admin/user/wallet'),
);
?>


<div class="expiration margin-topDefault">
    <!--<p>Client/ Hotel/ Bill : <?php //echo $clientObject->name;  ?></p>-->
    <form id="user_filter_frm" name="user_filter_frm" method="post" action="/admin/user/projectlist" />
    <div class="col-md-3">
        <input type="text" name="search" id="search" class="form-control" placeholder="Project Name" value="" />
    </div>
    <input type="submit" class="btn btn-primary" value="OK" name="submit" id="submit"/>
</form>
<a href="/admin/user/addproject"  class="btn btn-primary pull-right" name="submit">ADD</a>

</div>
<div class="row">
    <div class="col-md-12">
        <form id="user_filter_frm" name="user_filter_frm" method="post" action="/admin/user/projectlist" />
            <input type="submit" class="span-3 btn btn-danger btn-xs" value="Export CSV" name="exportByAll" id="exportByAll"/>
        </form>
            <div class="expiration margin-topDefault">
    <a class="btn blue margin-right-20" style="float:left" href="/admin/user/projectlist/">Open</a>
<!--    <a class="btn btn-warning margin-right-20" style="float:left" href="/admin/user/progressprojectlist">In-Progress</a>-->
    <a class="btn green margin-right-20" style="float:left" href="/admin/user/completeprojectlist">Completed</a>
            </div>
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
                    'name' => 'client_email',
                    'header' => '<span style="white-space: nowrap;">Client Email</span>',
                    'value' => '$data->client_email',
                ),
                array(
                    'name' => 'status',
                    'value' => '($data->status == 0) ? Yii::t(\'translation\', \'Progress\') : Yii::t(\'translation\', \'Completed\')',
                    
                ),
//                array(
//                    'class' => 'CButtonColumn',
//                    'template' => '{Complete}',
//                    'htmlOptions' => array('width' => '23%'),
//                    'buttons' => array(
//                        'Complete' => array(
//                            'label' => 'Complete',
//                            'options' => array('class' => 'btn purple fa fa-check margin-right15'),
//                            'url' => 'Yii::app()->createUrl("/user/ChangeApprovalStatus", array("id"=>$data->id))',
//                        ),
//                        
//                    ),
//                ),
                array(
                     'name'=>'action',
                     'header'=>'<span style="white-space: nowrap;"> &nbsp; &nbsp; &nbsp;</span>',
                     'value'=>array($this,'GetOpenButtonTitle'),
                    'htmlOptions' => array('width' => '10%', 'align' => 'center'),
                        
                     ),
                array(
                    'class' => 'CButtonColumn',
                    'template' => '{Edit}',
                    'htmlOptions' => array('width' => '10%'),
                    'buttons' => array(
//                        'Change' => array(
//                            'label' => Yii::t('translation', 'Change Status'),
//                            'options' => array('class' => 'fa fa-success btn default black delete'),
//                            'url' => 'Yii::app()->createUrl("admin/user/changestatus", array("id"=>$data->id, "flag" => "user"))',
//                        ),
                        'Edit' => array(
                            'label' => Yii::t('translation', 'Edit'),
                            'options' => array('class' => 'fa fa-success fa fa-edit btn default green delete'),
                            'url' => 'Yii::app()->createUrl("/admin/user/edit", array("id"=>$data->id))',
                        ),
                    ),
                    ),
                

            ),
        ));
        ?>
    </div>
</div>
