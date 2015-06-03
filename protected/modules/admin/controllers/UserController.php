<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='main';
        
        function init() {
            BaseClass::isAdmin();
        }
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

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','changestatus','wallet',
                                    'creditwallet','addproject','addemp','list','projectlist'),
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

        public function actionAddProject(){
            if($_POST){ 
                $empObject = new Project;
                $empObject->name = $_POST['project_name'];
                $empObject->client_name=$_POST['client_name'];
                $empObject->client_phone=$_POST['client_phone'];
                $empObject->created_at = new CDbExpression('NOW()');
                $empObject->update_at = new CDbExpression('NOW()');
                if(!$empObject->save()){
                    echo "<pre>"; print_r($empObject->getErrors());exit;
                }
                $this->redirect('projectList');
            }   
            $this->render('addProject');
        }
        
        public function actionProjectList(){
            $model = new Project;
            $pageSize = 100;
            $dataProvider=new CActiveDataProvider($model, array(
                        'pagination' => array('pageSize' => $pageSize),
            ));
            if(!empty($_POST['search'])) { 
                $dataProvider = CommonHelper::search(isset($_REQUEST['search'])?$_REQUEST['search']:"", $model, array('name','client_name','client_phone'), array(), isset($_REQUEST['selected'])?$_REQUEST['selected']:"");
            }
            $this->render('projectList',array(
                    'dataProvider'=>$dataProvider,
            ));
        }

        public function actionAddEmp(){
            if($_POST){
                $empObject = new User;
                $empObject->password = md5("mav@".$_POST['emp_no']);
                $empObject->attributes=$_POST;
                $empObject->created_at = new CDbExpression('NOW()');
                $empObject->updated_at = new CDbExpression('NOW()');
                if(!$empObject->save()){
                    echo "<pre>"; print_r($empObject->getErrors());exit;
                }
                $this->redirect('list');
            }   
            $this->render('addEmp');
        }
        

        public function actionChangeStatus(){
            if($_REQUEST['id']) {
                $userObject = User::model()->findByPk($_REQUEST['id']);
                if($userObject->status == 1){
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the modael to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{  
            $model = new UserHasTrackRecord();
            $pageSize = 100;
             $todayDate = date('Y-m-22');
            $fromDate = date('Y-m-d');
            if (!empty($_POST)) {
                $todayDate = date("Y-m-d", strtotime($_POST['from']));
                $fromDate = date("Y-m-d", strtotime($_POST['to']));
            }
            $dataProvider = new CActiveDataProvider($model, array(
                'criteria' => array(
                    'condition' => ('created_at >= "' . $todayDate . '" AND created_at <= "' . $fromDate . '"' ), 'order' => 'id DESC',
                ), 'pagination' => array('pageSize' => $pageSize),));
            
            if(!empty($_POST['search'])){
                $searchData = $_POST['search'];
                $criteria = new CDbCriteria;
                $criteria->with = array( 'user');
                $criteria->compare( 'user.email', $searchData, true );
                $criteria->compare( 'user.full_name', $searchData, true );

                $dataProvider = new CActiveDataProvider($model,array(
                        'criteria'=>$criteria,'pagination' => array('pageSize' => $pageSize),));
            }

            $this->render('index',array(
                    'dataProvider'=>$dataProvider,
            ));
	}

        public function actionList() {
            $model = new User();
            $pageSize = 10;
            $dataProvider=new CActiveDataProvider($model, array(
                        'pagination' => array('pageSize' => $pageSize),
            ));
            if(!empty($_POST['search'])) { 
                $dataProvider = CommonHelper::search(isset($_REQUEST['search'])?$_REQUEST['search']:"", $model, array('full_name','email','phone','emp_no'), array(), isset($_REQUEST['selected'])?$_REQUEST['selected']:"");
            }
            $this->render('userList',array(
                    'dataProvider'=>$dataProvider,
            ));
        }
        
        public function actionCreditWallet(){
            if($_POST) { 
                $walletObject = new Wallet;
                $walletObject->user_id = Yii::app()->session['userid'];
                $walletObject->fund = $_POST['fund'];
                $walletObject->type = 3;//fund added by admin
                $walletObject->status = 1;//success
                $walletObject->created_at = new CDbExpression('NOW()');
                $walletObject->updated_at = new CDbExpression('NOW()');
                if(!$walletObject->save()){
                    echo "<pre>"; print_r($walletObject->getErrors());exit;
                }
                $this->redirect('/user/wallet');
            }
            $userId = $_GET['id'];
            $userObject = User::model()->findByPk($userId);
            $this->render('wallet',array('userObject'=>$userObject));
        }

        /**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return User the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param User $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
