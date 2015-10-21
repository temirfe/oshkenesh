<?php

namespace app\controllers;

use Yii;
use app\models\Toraga;
use app\models\ToragaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use yii\filters\AccessControl;
use app\models\User;

/**
 * ToragaController implements the CRUD actions for Toraga model.
 */
class ToragaController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','admin','update','delete'],
                'rules' => [
                    [
                        'actions' => ['create','admin','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isAdmin();
                        }
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Toraga models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ToragaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Toraga model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Toraga model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Toraga();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if($model->imageFile){
                $imageName=time(). '.' . $model->imageFile->extension;
                $model->imageFile->saveAs('uploads/images/' . $imageName);
                $model->image=$imageName;
                //$this->resize($imageName);
            }
            $model->save(false);
            return $this->redirect(['/']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Toraga model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if($model->imageFile){
                $imageName=time(). '.' . $model->imageFile->extension;
                $model->imageFile->saveAs('uploads/images/' . $imageName);
                $model->image=$imageName;
                //$this->resize($imageName);
            }

            $model->save(false);
            return $this->redirect(['/']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    protected function resize($imageName){
        $webroot=Yii::getAlias('@webroot');
        $imagine=Image::getImagine()->open('uploads/images/'.$imageName);
        $imagine->thumbnail(new Box(900, 900))->save($webroot.'/uploads/images/'.$imageName);
    }

    /**
     * Deletes an existing Toraga model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Toraga model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Toraga the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Toraga::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
