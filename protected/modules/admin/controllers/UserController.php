<?php

class UserController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'main';

    function init() {
        //BaseClass::isAdmin();
    }

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'changestatus', 'wallet',
                    'creditwallet', 'addproject', 'addemp', 'list', 'projectlist', 'autocompletebypid', 'autocompletebyname', 'trackadd', 'savetrackAdd', 'export', 'getexportfile'),
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

    public function actionAddProject() {
        if ($_POST) {
            $empObject = new Project;
            $empObject->name = $_POST['project_name'];
            $empObject->client_name = $_POST['client_name'];
            $empObject->client_phone = $_POST['client_phone'];
            $empObject->created_at = new CDbExpression('NOW()');
            $empObject->update_at = new CDbExpression('NOW()');
            if (!$empObject->save()) {
                echo "<pre>";
                print_r($empObject->getErrors());
                exit;
            }
            $this->redirect('projectList');
        }
        $this->render('addProject');
    }

    public function actionProjectList() {
        require_once Yii::app()->basePath . '/extensions/csv/ECSVExport.php';
        $model = new Project;
        $pageSize = 100;
        $dataProvider = new CActiveDataProvider($model, array(
            'pagination' => array('pageSize' => $pageSize),
        ));
        if (!empty($_POST['search'])) {
            $dataProvider = CommonHelper::search(isset($_REQUEST['search']) ? $_REQUEST['search'] : "", $model, array('name', 'client_name', 'client_phone'), array(), isset($_REQUEST['selected']) ? $_REQUEST['selected'] : "");
        }

        // CSV Export.
        if (isset($_POST['exportByAll']) && $_POST['exportByAll'] == "Export CSV") {
            $filename = "project-list" . date('d-m-Y') . '.csv';
            $csv = new ECSVExport($dataProvider);
            //Headers.
            $csv->setHeaders(array('name' => 'Project Name',
                'client_name' => 'Client Name',
                'client_email' => 'Client Email',
                'client_phone' => "Contact Number",
                'phone' => 'Contact Number',
                'contact_person' => 'Contact Person',
                'status' => 'Status(1 : In-Progress & 0 : Completed')
            );
            //Exclude Columns.
            $csv->setExclude(array('id', 'created_at', 'update_at', 'sales_user_id'));

            $content = $csv->toCSV(); // returns string by default
            Yii::app()->getRequest()->sendFile($filename, $content, "text/csv", false);
            exit();
        }


        $this->render('projectList', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAddEmp() {
        if ($_POST) {
            $empObject = new User;
            $empObject->password = md5("mav@" . $_POST['emp_no']);
            $empObject->attributes = $_POST;
            $empObject->created_at = new CDbExpression('NOW()');
            $empObject->updated_at = new CDbExpression('NOW()');
            if (!$empObject->save()) {
                echo "<pre>";
                print_r($empObject->getErrors());
                exit;
            }
            $this->redirect('list');
        }
        $this->render('addEmp');
    }

    public function actionChangeStatus() {
        if ($_REQUEST['id']) {
            $userObject = User::model()->findByPk($_REQUEST['id']);
            if ($userObject->status == 1) {
                $userObject->status = 0;
            } else {
                $userObject->status = 1;
            }
            $userObject->save(false);
            $this->redirect('/admin/user');
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new User;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the modael to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        require_once Yii::app()->basePath . '/extensions/csv/ECSVExport.php';
        $model = new TrackRecord();
        $pageSize = 100;
        $todayDate = date('Y-m-22');
        $fromDate = date('Y-m-d');

        $searchByPid = null;
        $searchByUid = null;
        if (!empty($_POST)) {
            $todayDate = date("Y-m-d", strtotime($_POST['from']));
            $fromDate = date("Y-m-d", strtotime($_POST['to']));
            $searchByPid = $_POST['searchPid'];
            $searchByUid = $_POST['searchUid'];
        }

        // Default  Condition.
        $condition = "" . 'updated_at >= "' . $todayDate . '" AND updated_at <= "' . $fromDate . '"' . "";

        // Add ProjectId to Condition.
        if ($searchByPid) {
            $condition .= 'AND project_id = ' . $searchByPid;
        }

        // Add Userid to Condition.
        if ($searchByUid) {
            $condition .= ' AND user_id = ' . $searchByUid;
        }

        $dataProvider = new CActiveDataProvider($model, array(
            'criteria' => array(
                'condition' => ($condition),
                'order' => 'id DESC',
            ), 'pagination' => array('pageSize' => $pageSize),));

        // Time spent on project.
        $totalTimeSpent = 0;
        foreach ($dataProvider->data as $obj) {
            $from_time = strtotime($obj->from_time);
            $to_time = strtotime($obj->to_time);

            // $totalTimeSpent += strtotime($obj->from_time) - strtotime($obj->to_time);
            $totalTimeSpent += intval((gmdate("h:i", ($from_time - $to_time))));
        }

        if (isset($_POST['export-csv']) && !empty($_POST['export-csv'])) {
            $data = array();
            foreach ($dataProvider->data as $obj) {
                $data[] = array(
                    'Full Name' => $obj->user->full_name,
                    'Project Name' => $obj->project->name,
                    'Description' => $obj->description,
                    'From' => $obj->to_time,
                    'To' => $obj->from_time,
                    'Update Date' => $obj->updated_at,
                    'Time Spent' => gmdate("h:i", (strtotime($obj->from_time) - strtotime($obj->to_time))) . " Hrs",
                );
            }
            
            $data[] = array('', '', '', '', '', '', '');
            $data[] = array('', '', '', '', '', 'Total Time Spent', $totalTimeSpent . " Hrs.");
            
            $filename = "File - " . date('d-m-Y') . '.csv';
            $csv = new ECSVExport($data);
            $csv->setHeaders(array('description' => 'Project Description', 'to_time' => 'From', 'from_time' => 'To', 'updated_at' => "Updated At"));
            $csv->setExclude(array('id', 'created_at', 'status'));

            $content = $csv->toCSV(); // returns string by default
            Yii::app()->getRequest()->sendFile($filename, $content, "text/csv", false);
            exit();
        }

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'totalTimeSpent' => $totalTimeSpent,
        ));
    }

    public function actionList() {
        require_once Yii::app()->basePath . '/extensions/csv/ECSVExport.php';
        $model = new User();
        $pageSize = 10;
        $dataProvider = new CActiveDataProvider($model, array(
            'pagination' => array('pageSize' => $pageSize),
        ));

        if (!empty($_POST['search'])) {
            $dataProvider = CommonHelper::search(isset($_REQUEST['search']) ? $_REQUEST['search'] : "", $model, array('full_name', 'email', 'phone', 'emp_no'), array(), isset($_REQUEST['selected']) ? $_REQUEST['selected'] : "");
        }

        // CSV Export.
        if (isset($_POST['exportByAll']) && $_POST['exportByAll'] == "Export CSV") {
            $filename = Yii::app()->params['emp_exp_filename'] . date('d-m-Y') . '.csv';
            $csv = new ECSVExport($dataProvider);
            $csv->setHeaders(array('id' => 'Id', 'full_name' => 'Full Name', 'email' => 'Email', 'emp_no' => 'Emp Id', 'address' => "Address", 'phone' => 'Contact Number'));
            $csv->setExclude(array('password', 'created_at', 'updated_at', 'status', 'role_id'));

            $content = $csv->toCSV(); // returns string by default
            Yii::app()->getRequest()->sendFile($filename, $content, "text/csv", false);
            exit();
        }

        $this->render('userList', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionCreditWallet() {
        if ($_POST) {
            $walletObject = new Wallet;
            $walletObject->user_id = Yii::app()->session['userid'];
            $walletObject->fund = $_POST['fund'];
            $walletObject->type = 3; //fund added by admin
            $walletObject->status = 1; //success
            $walletObject->created_at = new CDbExpression('NOW()');
            $walletObject->updated_at = new CDbExpression('NOW()');
            if (!$walletObject->save()) {
                echo "<pre>";
                print_r($walletObject->getErrors());
                exit;
            }
            $this->redirect('/user/wallet');
        }
        $userId = $_GET['id'];
        $userObject = User::model()->findByPk($userId);
        $this->render('wallet', array('userObject' => $userObject));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Perform automplete project titles.
     * @param type $term
     */
    public function actionAutoCompleteByPid($term) {
        $match = $term;
        $projectObject = Project::model()->findAll(
                'name LIKE :match', array(':match' => "%$match%")
        );
        $list = array();
        foreach ($projectObject as $q) {
            $data['value'] = $q['id'];
            $data['label'] = $q['name'];
            $list[] = $data;
            unset($data);
        }
        echo json_encode($list);
    }

    /**
     * Perform automplete for usernames.
     * @param type $term
     */
    public function actionAutoCompleteByName($term) {
        $match = $term;
        $userObject = User::model()->findAll(
                'full_name LIKE :match', array(':match' => "%$match%")
        );

        $list = array();
        foreach ($userObject as $q) {
            $data['value'] = $q['id'];
            $data['label'] = $q['full_name'];
            $list[] = $data;
            unset($data);
        }
        echo json_encode($list);
    }

    /**
     * Form for addtrack on behalf of users.
     */
    public function actionTrackAdd() {
        $projectObject = Project::model()->findAll();
        $userObject = User::model()->findAll();

        $this->render('trackadd', array('projectObject' => $projectObject, 'userObject' => $userObject));
    }

    /**
     * Perform track on behalf of users. 
     */
    public function actionSaveTrackAdd() {
        if ($_POST) {
            $_POST['created_at'] = date('d-m-Y', strtotime($_POST['created_at']));

            $userId = $_POST['user_id'];
            $trackObject = new TrackRecord;
            $trackObject->user_id = $userId;
            $trackObject->attributes = $_POST;
            $trackObject->updated_at = new CDbExpression('NOW()');
            if (!$trackObject->save(false)) {
                echo "<pre>";
                print_r($trackObject->getErrors());
                exit;
            }
            $userHasTrackRecordObject = new UserHasTrackRecord;
            $userHasTrackRecordObject->user_id = $userId;
            $userHasTrackRecordObject->track_record_id = $trackObject->id;
            $userHasTrackRecordObject->created_at = new CDbExpression('NOW()');
            $userHasTrackRecordObject->updated_at = new CDbExpression('NOW()');
            if (!$userHasTrackRecordObject->save(false)) {
                echo "<pre>";
                print_r($userHasTrackRecordObject->getErrors());
                exit;
            }
            Yii::app()->session['smg'] = "Record added successfully";
            $this->redirect('trackadd');
        }
    }

}
