<?php

class BugReportController extends Controller {

    public $layout = 'inner';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    public function init() {
        //BaseClass::isLoggedIn();
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'savetrack',
                    'fixed', 'closed', 'reopen', 'create', 'logout', 'changestatus'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $model = new BugReport;
        $pageSize = 100;
        $projectId = 1; //default UR Webby
        if (!empty($_GET['pid'])) {
            $projectId = $_GET['pid'];
        }
        $projectObject = Project::model()->findByPk($projectId);
        $dataProvider = new CActiveDataProvider($model, array(
            'criteria' => array('condition' => ('status = 1 AND project_id = ' . $projectId), 'order' => 'update_at DESC',
            ), 'pagination' => array('pageSize' => $pageSize),));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'projectObject' => $projectObject
        ));
    }

    public function actionFixed() {
        $model = new BugReport;
        $pageSize = 100;
        $projectId = 1; //default UR Webby
        if (!empty($_GET['pid'])) {
            $projectId = $_GET['pid'];
        }
        $projectObject = Project::model()->findByPk($projectId);
        $dataProvider = new CActiveDataProvider($model, array(
            'criteria' => array('condition' => ('status = 3 AND project_id = ' . $projectId), 'order' => 'update_at DESC',
            ), 'pagination' => array('pageSize' => $pageSize),));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'projectObject' => $projectObject
        ));
    }

    public function actionClosed() {
        $model = new BugReport;
        $pageSize = 100;
        $projectId = 1; //default UR Webby
        if (!empty($_GET['pid'])) {
            $projectId = $_GET['pid'];
        }
        $projectObject = Project::model()->findByPk($projectId);
        $dataProvider = new CActiveDataProvider($model, array(
            'criteria' => array('condition' => ('status = 2 AND project_id = ' . $projectId), 'order' => 'update_at DESC',
            ), 'pagination' => array('pageSize' => $pageSize),));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'projectObject' => $projectObject
        ));
    }

    public function actionReOpen() {
        $model = new BugReport;
        $pageSize = 100;
        $projectId = 1; //default UR Webby
        if (!empty($_GET['pid'])) {
            $projectId = $_GET['pid'];
        }
        $projectObject = Project::model()->findByPk($projectId);
        $dataProvider = new CActiveDataProvider($model, array(
            'criteria' => array('condition' => ('status = 4 AND project_id = ' . $projectId), 'order' => 'update_at DESC',
            ), 'pagination' => array('pageSize' => $pageSize),));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'projectObject' => $projectObject
        ));
    }

    public function getPriority($data, $row) {
        //1:Critical,2:High,3:Medium,4:Low
        switch ($data->priority) {
            case 1:
                echo "<p style='color:red'>Critical</p>";
                break;
            case 2:
                echo "High";
                break;
            case 3:
                echo "Medium";
                break;
            case 4:
                echo "Low";
                break;
        }
    }

    public function actionCreate() {
        $error = "";
        $success = "";
        $projectId = 1; //default UR Webby
        if (!empty($_GET['pid'])) {
            $projectId = $_GET['pid'];
        }
        $projectObject = Project::model()->findByPk($projectId);
        if ($_POST) {
            $userId = Yii::app()->session['userid'];
            $bugTrackObject = new BugReport;
            $bugTrackObject->project_id = $projectId;
            $bugTrackObject->user_id = $userId;
            $bugTrackObject->updated_by = $userId;
            $bugTrackObject->title = $_POST['title'];
            $bugTrackObject->description = $_POST['description'];
            $bugTrackObject->priority = $_POST['priority'];
            $bugTrackObject->status = 1;
            $bugTrackObject->created_at = new CDbExpression('NOW()');
            $bugTrackObject->update_at = new CDbExpression('NOW()');
            if (!$bugTrackObject->save(false)) {
                echo "<pre>";
                print_r($bugTrackObject->getErrors());
                exit;
            }
            Yii::app()->session['smg'] = "Record added successfully";
            $this->redirect('create', array('projectObject' => $projectObject));
        }

        $this->render('create', array('projectObject' => $projectObject));
    }

    public function getStatus($data, $row) {
        //1:Open,2:Close,3:Fixed,4:Reopen
        switch ($data->status) {
            case 1:
                echo "Open";
                break;
            case 2:
                echo "Close";
                break;
            case 3:
                echo "Fixed";
                break;
            case 4:
                echo "Reopen";
                break;
        }
    }

    public function getActionButton($data, $row) {
        $url = Yii::app()->createUrl("/BugReport/changestatus?id=" . $data->id);
        switch ($data->status) {
            case 1:
                echo '<a href=' . $url . '&status=3' . ' class="fa fa-success btn default red delete" />Fixed</a>';
                echo '<a href=' . $url . '&status=2' . ' class="fa fa-success btn default black delete" />Close</a>';
                break;
            case 2:
                echo '<a href=' . $url . '&status=1' . ' class="fa fa-success btn default green delete" />Open</a>';
                echo '<a href=' . $url . '&status=4' . ' class="fa fa-success btn default black delete" />Re-Open</a>';
                break;
            case 3:
                echo '<a href=' . $url . '&status=1' . ' class="fa fa-success btn default blue delete" />Open</a>';
                echo '<a href=' . $url . '&status=2' . ' class="fa fa-success btn default black delete" />Close</a>';
                break;
            case 4:
                echo '<a href=' . $url . '&status=1' . ' class="fa fa-success btn default blue delete" />Open</a>';
                echo '<a href=' . $url . '&status=2' . ' class="fa fa-success btn default black delete" />Close</a>';
                break;
        }
    }

    public function actionChangeStatus() {

        if(!empty($_POST['add-comment'])) {
            $model = new BugFixedComments();
            $comment = $_POST['add-comment'];

           /* $bugId = $_POST['big_id'];
            $userId = Yii::app()->session['userid'];
            
            $model->bug_id = $bugId;
            $model->user_id = $userId;
            $model->created_at = date("Y/m/d");*/
        }

        $projectId = 1; //default UR Webby
        if (!empty($_GET['pid'])) {
            $projectId = $_GET['pid'];
        }
        $projectObject = Project::model()->findByPk($projectId);
        if ($_GET['id']) {
            $id = $_GET['id'];
            $bugReportObject = BugReport::model()->findByPk($id);
            $this->render('addcomment', array('bugReportObject' => $bugReportObject));
            echo "<pre>";
            print_r($bugReportObject);
            exit;
            $bugReportObject->status = $_GET['status'];
            if (!$bugReportObject->save(false)) {
                echo "<pre>";
                print_r($bugReportObject->getErrors());
                exit;
            }
        }
        $this->redirect('index', array('projectObject' => $projectObject));
    }

}
