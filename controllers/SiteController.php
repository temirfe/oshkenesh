<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\ContactForm;
use app\models\EmailConfirmForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUpload()
    {

        if(isset($_POST['upform'])){
            echo $_POST['upform']['field1'];
            $file=UploadedFile::getInstanceByName('upform[xfile]');
            if($file->extension !='xls' && $file->extension !='xlsx')
                return "Error: only Excel files should be uploaded!".$file->extension;
            $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
        }

        else

        return $this->render('upload');
    }

    public function actionExceldb(){
        $file='uploads/Undergrad.xlsx';
        //$objPHPExcel = new \PHPExcel();

        //$file=mb_convert_encoding($file, 'Windows-1251', 'UTF-8');
        $inputFileType = \PHPExcel_IOFactory::identify($file);
        $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel=$objReader->load($file);

        $objWorksheet = $objPHPExcel->getActiveSheet();

        $highestRow = $objWorksheet->getHighestRow(); // e.g. 10
        $highestColumn = $objWorksheet->getHighestColumn(); // e.g 'F'
        //$columnIndex=\PHPExcel_Cell::stringFromColumnIndex($highestColumn);
        $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn); // e.g. 5

        $headRow=false;
        $parsedData=array();
        $name='Institution Name'; $parsedData['name']=array(); $nameCol=false; //CI = ColumnIndex
        $address='Address'; $parsedData['address']=array(); $addressCol=false;
        $city='City'; $parsedData['city']=array(); $cityCol=false;
        //parse each row
        for ($row = 1; $row <= $highestRow; ++$row) {
            if(!$headRow) //set index variables
            {
                //parse each column
                for ($col = 0; $col <= $highestColumnIndex; ++$col) {
                    if ($curval = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue()) //if current cell has text
                    {
                        if(!$nameCol && $curval==$name) { $nameCol=$col; $headRow=$row;}
                        elseif(!$addressCol && $curval==$address) { $addressCol=$col;}
                        elseif(!$cityCol && $curval==$city) { $cityCol=$col;}
                    }
                }
            }
            else //header has been set, now insert data
            {
                //parse each column
                for ($col = 0; $col <= $highestColumnIndex; ++$col) {
                    if ($curval = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue()) //if current cell has text
                    {
                        if($col==$nameCol) {$parsedData['name'][$row]=$curval;}
                        elseif($col==$addressCol) {$parsedData['address'][$row]=$curval;}
                        elseif($col==$cityCol) {$parsedData['city'][$row]=$curval;}
                    }
                }
            }
        }


        /*echo 'nameCol: '.$nameCol."<br />";
        echo 'addressCol: '.$addressCol."<br />";
        echo 'cityCol: '.$cityCol."<br />";*/


        $db=Yii::$app->db;
        for ($i = 1; $i<= $highestRow; ++$i) {
            if($parsedData['name'][$i]){
                $db->createCommand()->insert('university', [
                    'name' => $parsedData['name'][$i],
                    'address' => $parsedData['address'][$i],
                    'city' => $parsedData['city'][$i],
                ])->execute();
            }
        }
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                Yii::$app->getSession()->setFlash('success', 'Your account has been created, activation code has been sent to your email.');
                return $this->goHome();
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionEmailConfirm($token)
    {
        try {
            $model = new EmailConfirmForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($test=$model->confirmEmail()) {
            $signin=Html::a('sign in', Yii::$app->urlManager->createUrl(['site/login']));
            Yii::$app->getSession()->setFlash('success', 'Your Email has been successfully confirmed! You can now '.$signin);
        } else {
            Yii::$app->getSession()->setFlash('error', "Couldn't confirm your Email.");
        }

        return $this->goHome();
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionTnews(){
        $db=Yii::$app->db;
        $contents=$db->createCommand("SELECT * FROM content WHERE category_id='1'")->queryAll();
        foreach($contents as $c){
            if(!$c['image']) $image=''; else $image=$c['image'];
            $db->createCommand()->insert('news', [
                'title' => $c['title'],
                'date' => $c['date'],
                'image' => $image,
                'content' => $c['content'],
                'description' => $c['description'],

            ])->execute();
        }
    }

    public function actionRun(){
        $db=Yii::$app->db;
        $contents=$db->createCommand("SELECT * FROM gallery_o")->queryAll();
        foreach($contents as $c){
            if(!$c['image']) $image=''; else $image=$c['image'];
            $db->createCommand()->insert('gallery', [
                'title' => $c['title'],
                'main_img' => $c['main_img'],
                'directory' => $c['uid'],

            ])->execute();
        }
    }
}
