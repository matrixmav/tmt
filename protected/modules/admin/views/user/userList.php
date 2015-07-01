<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Wallet' => array('/admin/user/wallet'),
);
?>

<div class="expiration margin-topDefault">
    <!--<p>Client/ Hotel/ Bill : <?php //echo $clientObject->name;                   ?></p>-->
    <form id="user_filter_frm" name="user_filter_frm" method="post" action="/admin/user/list" />
        <div class="col-md-3">
            <input type="text" name="search" id="search" class="form-control" placeholder="Full Name" value="" />
        </div>
        <input type="submit" class="btn btn-primary" value="OK" name="submit" id="submit"/>       
    </form>
    <a href="/admin/user/addemp"  class="btn btn-primary pull-right" name="submit">ADD</a>
</div>

<div class="row">
    <div class="col-md-12">
        <form id="user_filter_frm" name="user_filter_frm" method="post" action="/admin/user/list" />
            <input type="submit" class="span-3 btn btn-danger btn-xs" value="Export CSV" name="exportByAll" id="exportByAll"/>
        </form>
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
                    'name' => 'full_name',
                    'header' => '<span style="white-space: nowrap;">Full Name &nbsp; &nbsp; &nbsp;</span>',
                    'value' => '$data->full_name',
                ),
                array(
                    'name' => 'phone',
                    'header' => '<span style="white-space: nowrap;">Phone &nbsp; &nbsp; &nbsp;</span>',
                    'value' => '$data->phone',
                ),
                 array(
                    'name' => 'address',
                    'header' => '<span style="white-space: nowrap;">Address &nbsp; &nbsp; &nbsp;</span>',
                    'value' => '$data->address',
                ),
                array(
                    'name' => 'email',
                    'header' => '<span style="white-space: nowrap;">Email &nbsp; &nbsp; &nbsp;</span>',
                    'value' => '$data->email',
                ),
                array(
                    'name' => 'status',
                    'value' => '($data->status == 1) ? Yii::t(\'translation\', \'Active\') : Yii::t(\'translation\', \'Inactive\')',
                ),
                array(
                    'class' => 'CButtonColumn',
                    'template' => '{Edit}',
                    'htmlOptions' => array('width' => '10%'),
                    'buttons' => array(
                        'Edit' => array(
                            'label' => 'Edit',
                            'options' => array('class' => 'btn purple fa fa-edit margin-right15'),
                            'url' => 'Yii::app()->createUrl("/admin/user/empedit", array("id"=>$data->id))',
                        ),
                        
                    ),
                ),
            ),
        ));
        ?>
    </div>
</div>

