<?php

namespace app\controllers;

use Yii;
use app\models\Party;
use app\models\PartySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;
use yii\filters\AccessControl;
use app\models\User;

/**
 * PartyController implements the CRUD actions for Party model.
 */
class PartyController extends Controller
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
     * Lists all Party models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PartySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Party model.
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
     * Creates a new Party model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Party();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if($model->imageFile){
                $imageName=time(). '.' . $model->imageFile->extension;
                $model->imageFile->saveAs('uploads/images/' . $imageName);
                $model->image=$imageName;
                Image::getImagine()->open('uploads/images/'.$imageName)->thumbnail(new Box(500, 500))->save(Yii::getAlias('@webroot').'/uploads/images/'.$imageName);
                Image::getImagine()->open('uploads/images/'.$imageName)->thumbnail(new Box(120, 120))->save(Yii::getAlias('@webroot').'/uploads/images/small/s_'.$imageName);
            }
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Party model.
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
                Image::getImagine()->open('uploads/images/'.$imageName)->thumbnail(new Box(500, 500))->save(Yii::getAlias('@webroot').'/uploads/images/'.$imageName);
                Image::getImagine()->open('uploads/images/'.$imageName)->thumbnail(new Box(120, 120))->save(Yii::getAlias('@webroot').'/uploads/images/small/s_'.$imageName);

            }

            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Party model.
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
     * Finds the Party model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Party the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Party::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
