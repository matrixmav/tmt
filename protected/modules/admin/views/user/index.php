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

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />

<script>
    $(function () {
        $("#project_name").autocomplete({
            source: "/admin/user/autocompletebypid",
            minLength: 2,
            select: function (event, ui) {
                event.preventDefault();
                $("#project_name").val(ui.item.label);
                $("#searchPid").val(ui.item.value);
            },
            focus: function (event, ui) {
                event.preventDefault();
                $(this).val(ui.item.label);
            },
            html: true, // optional (jquery.ui.autocomplete.html.js required)

            // optional (if other layers overlap autocomplete list)
            open: function (event, ui) {
                $(".ui-autocomplete").css("z-index", 1000);
            }
        });

        $("#full_name").autocomplete({
            source: "/admin/user/autocompletebyname",
            minLength: 2,
            select: function (event, ui) {
                event.preventDefault();
                $("#full_name").val(ui.item.label);
                $("#searchUid").val(ui.item.value);
            },
            focus: function (event, ui) {
                event.preventDefault();
                $(this).val(ui.item.label);
            },
            html: true, // optional (jquery.ui.autocomplete.html.js required)

            // optional (if other layers overlap autocomplete list)
            open: function (event, ui) {
                $(".ui-autocomplete").css("z-index", 1000);
            }
        });

    });
</script>

<form id="regervation_filter_frm" name="regervation_filter_frm" method="post" action="/admin/user">
    <div class="row">
        <div class="col-xs-8 col-sm-6 col-md-6 col-sm-offset-">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Search Projects ....</h3>
                </div>
                <div class="panel-body">
                    <form role="form">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="hidden" name="searchPid" id="searchPid" value="0">
                                    <input type="text" class="form-control input-sm" name="project_name" id="project_name" placeholder="Project Name"/>                                    
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="hidden" name="searchUid" id="searchUid" value="0">
                                    <input type="text" class="form-control input-sm" name="full_name" id="full_name" placeholder="Full Name"/>                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="from" placeholder="To Date" class="datepicker form-control input-sm">
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="to"  placeholder="From Date" class="datepicker form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Search" name="submit" id="submit"/>
                        <?php if($totalTimeSpent):?> 
                            &nbsp;<span class="text-danger"> Time Spent on : <?=$totalTimeSpent;?>  Hrs.  </span>
                        <?php endif;?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>

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
                    'value' => 'isset($data->project->name)?$data->project->name:""',
                ),
                array(
                    'name' => 'user_id',
                    'header' => '<span style="white-space: nowrap;">From Time &nbsp; &nbsp; &nbsp;</span>',
                    'value' => 'isset($data->to_time)?$data->to_time:""',
                ),
                array(
                    'name' => 'user_id',
                    'header' => '<span style="white-space: nowrap;">To Time &nbsp; &nbsp; &nbsp;</span>',
                    'value' => 'isset($data->from_time)?$data->from_time:""',
                ),
                array(
                    'name' => 'user_id',
                    'header' => '<span style="white-space: nowrap;">Description &nbsp; &nbsp; &nbsp;</span>',
                    'value' => '$data->description',
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
