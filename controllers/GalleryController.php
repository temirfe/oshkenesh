<?php

namespace app\controllers;

use Yii;
use app\models\Gallery;
use app\models\GallerySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;
use yii\data\ActiveDataProvider;

/**
 * GalleryController implements the CRUD actions for Gallery model.
 */
class GalleryController extends Controller
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
     * Lists all Gallery models.
     * @return mixed
     */
    public function actionIndex(){
        $dataProvider = new ActiveDataProvider([
            'query' => Gallery::find()->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAdmin()
    {
        $searchModel = new GallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gallery model.
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
     * Creates a new Gallery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gallery();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->saveImage($model);
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Gallery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->saveImage($model);
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    protected function saveImage($model){
        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
        $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');


        if($model->directory){
            $directory=$model->directory;
        }
        else{
            $directory=time();
            $model->directory=$directory;
        }

        $tosave=Yii::getAlias('@webroot').'/uploads/gallery/'.$directory;
        if (!file_exists($tosave)) {
            @mkdir($tosave);
            @mkdir($tosave.'/small');
        }

        if($model->imageFile){
            $imageName=time(). '.' . $model->imageFile->extension;
            $model->imageFile->saveAs($tosave.'/' . $imageName);
            $model->main_img=$imageName;
            $imagine=Image::getImagine()->open($tosave.'/'.$imageName);
            $imagine->thumbnail(new Box(1000, 1000))->save($tosave.'/'.$imageName);
            $imagine->thumbnail(new Box(200, 140))->save($tosave.'/small/'.$imageName, ['quality' => 90]);
        }
        if($model->imageFiles){
            foreach($model->imageFiles as $image)
            {
                $imageName=time().'_'.rand(1000, 100000).'.' . $image->extension;
                $image->saveAs($tosave.'/' . $imageName);
                $imagine=Image::getImagine()->open($tosave.'/'.$imageName);
                $imagine->thumbnail(new Box(1000, 1000))->save($tosave.'/' .$imageName);
                $imagine->thumbnail(new Box(200, 140))->save($tosave.'/small/'.$imageName, ['quality' => 90]);
            }
        }
    }
    /**
     * Deletes an existing Gallery model.
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
     * Finds the Gallery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gallery::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
