<?php

namespace app\controllers;

use Yii;
use app\models\Bill;
use app\models\BillSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use vova07\imperavi\actions\GetAction;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

/**
 * BillController implements the CRUD actions for Bill model.
 */
class BillController extends Controller
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

    public function actions()
    {
        return [
            'file-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => Yii::getAlias('@web').'/uploads/files/', // Directory URL address, where files are stored.
                'path' => '@webroot/uploads/files', // Or absolute path to directory where files are stored.
                "uploadOnlyImage"=>false
            ],
            'files-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => Yii::getAlias('@web').'/uploads/files/', // Directory URL address, where files are stored.
                'path' => '@webroot/uploads/files', // Or absolute path to directory where files are stored.
                'type' => GetAction::TYPE_FILES,
            ]
        ];
    }

    /**
     * Lists all Bill models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Bill::find()->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAdmin()
    {
        $searchModel = new BillSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Bill model.
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
     * Creates a new Bill model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Bill();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->wordFile = UploadedFile::getInstance($model, 'wordFile');
            $model->pdfFile = UploadedFile::getInstance($model, 'pdfFile');
            if($model->wordFile){
                $fileName=time(). '.' . $model->wordFile->extension;
                $model->wordFile->saveAs('uploads/files/' . $fileName);
                $model->word=$fileName;
                $model->word_size=round($model->wordFile->size/1024,1); //kb
            }
            if($model->pdfFile){
                $fileName=time(). '.' . $model->pdfFile->extension;
                $model->pdfFile->saveAs('uploads/files/' . $fileName);
                $model->pdf=$fileName;
                $model->pdf_size=round($model->pdfFile->size/1024,1); //kb
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
     * Updates an existing Bill model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->wordFile = UploadedFile::getInstance($model, 'wordFile');
            $model->pdfFile = UploadedFile::getInstance($model, 'pdfFile');
            if($model->wordFile){
                $old ='uploads/files/'.$model->word;
                @unlink($old);
                $fileName=time(). '.' . $model->wordFile->extension;
                $model->wordFile->saveAs('uploads/files/' . $fileName);
                $model->word=$fileName;
                $model->word_size=round($model->wordFile->size/1024,1); //kb
            }
            if($model->pdfFile){
                $old ='uploads/files/'.$model->pdf;
                @unlink($old);
                $fileName=time(). '.' . $model->pdfFile->extension;
                $model->pdfFile->saveAs('uploads/files/' . $fileName);
                $model->pdf=$fileName;
                $model->pdf_size=round($model->pdfFile->size/1024,1); //kb
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
     * Deletes an existing Bill model.
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
     * Finds the Bill model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bill the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bill::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
