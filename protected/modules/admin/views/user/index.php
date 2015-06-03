<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('/admin/user')
);
$model = new User;
?>
<style>
    .confirmBtn{left: 333px;
                position: absolute;
                top: 0;}

    .confirmOk{left:350px;
               position: absolute;
               top: 8px;}
    .confirmMenu{position: relative;}
</style>
<div class="col-md-12">

    <div class="expiration margin-topDefault confirmMenu">

        <form id="regervation_filter_frm" name="regervation_filter_frm" method="post" action="/admin/user">
            <div class="input-group input-large date-picker input-daterange">
                <input type="text" name="from" data-provide="datepicker"  placeholder="To Date" class="datepicker form-control">
                <span class="input-group-addon">
                    to </span>
                <input type="text" name="to" data-provide="datepicker" placeholder="From Date" class="datepicker form-control">
            </div>
            <?php
            $statusId = 1;
            if (isset($_REQUEST['res_filter'])) {
                $statusId = $_REQUEST['res_filter'];
            }
            $projectListObject = Project::model()->findAll();
            ?>

<!--            <select class="customeSelect howDidYou form-control input-medium select2me confirmBtn" id="ui-id-5" name="project_id">
                <option value="0" >Select Project</option>
                <?php //foreach ($projectListObject as $projectObject) { ?>
                    <option value="<?php //echo $projectObject->id; ?>"><?php //echo $projectObject->name; ?></option>
                <?php ///} ?>
            </select>-->
    </div>
    <input type="submit" class="btn btn-primary confirmOk" value="OK" name="submit" id="submit"/>
</form>

</div>
<!--<div class="expiration margin-topDefault">
    <p>Client/ Hotel/ Bill : <?php //echo $clientObject->name;  ?></p>
    <form id="user_filter_frm" name="user_filter_frm" method="post" action="/admin/user" />
    <div class="col-md-3">
        <input type="text" name="search" id="search" class="form-control" value="" />
    </div>
    <input type="submit" class="btn btn-primary" value="OK" name="submit" id="submit"/>
    </form>
</div>-->
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
                    'name' => 'user_id',
                    'header' => '<span style="white-space: nowrap;">Full Name &nbsp; &nbsp; &nbsp;</span>',
                    'value' => '$data->user->full_name',
                ),
                array(
                    'name' => 'user_id',
                    'header' => '<span style="white-space: nowrap;">Project &nbsp; &nbsp; &nbsp;</span>',
                    'value' => 'isset($data->trackRecord->project->name)?$data->trackRecord->project->name:""',
                ),
                array(
                    'name' => 'user_id',
                    'header' => '<span style="white-space: nowrap;">To Time &nbsp; &nbsp; &nbsp;</span>',
                    'value' => 'isset($data->trackRecord->to_time)?$data->trackRecord->to_time:""',
                ),
                array(
                    'name' => 'user_id',
                    'header' => '<span style="white-space: nowrap;">From Time &nbsp; &nbsp; &nbsp;</span>',
                    'value' => 'isset($data->trackRecord->from_time)?$data->trackRecord->from_time:""',
                ),
                array(
                    'name' => 'user_id',
                    'header' => '<span style="white-space: nowrap;">Description &nbsp; &nbsp; &nbsp;</span>',
                    'value' => '$data->trackRecord->description',
                ),
                array(
                    'name' => 'updated_at',
                    'header' => '<span style="white-space: nowrap;">Date & Time &nbsp; &nbsp; &nbsp;</span>',
                    'value' => '$data->updated_at',
                ),
            ),
        ));
        ?>
    </div>
</div>
<script>
    $(function () {
                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd'
                });
            });
    </script>
