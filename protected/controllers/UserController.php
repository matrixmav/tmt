<?php

class UserController extends Controller
{
    public $layout='inner';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
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
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','savetrack','tracklist','logout','isprojectexisted'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionIndex()
	{  
            $projectObject = Project::model()->findAll();
            $this->render('index',array('projectObject'=>$projectObject));
	}

        public function actionSaveTrack(){
            date_default_timezone_set('Asia/Calcutta');
            if($_POST){ 
                $userId = Yii::app()->session['userid'];
                
                $projectDate = date('Y-m-d');
                $projectId = $_POST['project_id'];          
                $trackRecordObject = TrackRecord::model()->findByAttributes(array('user_id' => $userId, 'project_id' => $projectId, 'created_at' => $projectDate, 'from_time'=>''));
                if(!empty($trackRecordObject)) {
                    $trackRecordObject->from_time = date('h:i a');
                    $trackRecordObject->updated_at = new CDbExpression('NOW()');
                    $trackRecordObject->save(false);
                    
                } else {
                    $trackObject = new TrackRecord;
                    $trackObject->user_id = $userId;
                    $trackObject->attributes = $_POST;
                    $trackObject->created_at = new CDbExpression('NOW()');
                    if(!$trackObject->save(false)){
                        echo "<pre>"; print_r($trackObject->getErrors());exit;
                    }
                    $userHasTrackRecordObject = new UserHasTrackRecord;
                    $userHasTrackRecordObject->user_id = $userId;
                    $userHasTrackRecordObject->track_record_id = $trackObject->id;
                    $userHasTrackRecordObject->created_at = new CDbExpression('NOW()');
                    $userHasTrackRecordObject->updated_at = new CDbExpression('NOW()');
                    if(!$userHasTrackRecordObject->save(false)){
                        echo "<pre>"; print_r($userHasTrackRecordObject->getErrors());exit;
                    } 
                }
                Yii::app()->session['smg'] = "Record added successfully";
                $rul = Yii::app()->createUrl("/user?id=".$projectId);
                $this->redirect($rul);
            }
        }
        
        public function actionIsProjectExisted(){
            if($_POST){
                $projectDate = date('Y-m-d');
                $projectId = $_POST['projectId'];  
                $userId= Yii::app()->session['userid'];
                $trackRecordObject = TrackRecord::model()->findByAttributes(array('user_id' => $userId, 'project_id' => $projectId, 'created_at' => $projectDate,'from_time'=>''));
                if(!empty($trackRecordObject)){ 
                     echo CJSON::encode(array('to_time'=>$trackRecordObject->to_time,'description'=>$trackRecordObject->description));exit;
                } else {
                    echo "0";
                }
                
            }
        }

        public function actionTrackList(){
            $model = new TrackRecord;
            $pageSize = 10;
            $userId= Yii::app()->session['userid'];
            $dataProvider = new CActiveDataProvider($model,array(
                            'criteria'=>array( 'condition'=> ('status = 1 AND user_id = '.$userId ),'order'=>'id DESC',
                ),'pagination' => array('pageSize' => $pageSize),));
            
            $this->render('trackList',array(
                    'dataProvider'=>$dataProvider,
            ));
        }
        
        public function actionLogout() {
            Yii::app()->session['userid'] = ""; 
            Yii::app()->user->logout();
            $this->redirect('/');
        }
        // Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}