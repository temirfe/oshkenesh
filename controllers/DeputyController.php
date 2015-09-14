<?php

namespace app\controllers;

use Yii;
use app\models\Deputy;
use app\models\DeputySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * DeputyController implements the CRUD actions for Deputy model.
 */
class DeputyController extends Controller
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
        ];
    }

    /**
     * Lists all Deputy models.
     * @return mixed
     */
    public function actionAdmin()
    {
        $searchModel = new DeputySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Lists all Deputy models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', []);
    }

    /**
     * Displays a single Deputy model.
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
     * Creates a new Deputy model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Deputy();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if($model->imageFile){
                $imageName=time(). '.' . $model->imageFile->extension;
                $model->imageFile->saveAs('uploads/images/' . $imageName);
                $model->image=$imageName;
                Image::getImagine()->open('uploads/images/'.$imageName)->thumbnail(new Box(120, 200))->save(Yii::getAlias('@webroot').'/uploads/images/'.$imageName);
                Image::crop('@webroot/uploads/images/' . $imageName, 120, 160)
                    ->save(Yii::getAlias('@webroot/uploads/images/' . $imageName));
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
     * Updates an existing Deputy model.
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
                Image::getImagine()->open('uploads/images/'.$imageName)->thumbnail(new Box(120, 200))->save(Yii::getAlias('@webroot').'/uploads/images/'.$imageName);
                Image::crop('@webroot/uploads/images/' . $imageName, 120, 160)
                    ->save(Yii::getAlias('@webroot/uploads/images/' . $imageName));
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
     * Deletes an existing Deputy model.
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
     * Finds the Deputy model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Deputy the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Deputy::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
