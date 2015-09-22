<?php

namespace app\controllers;

use Yii;
use app\models\Results;
use app\models\ResultsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use vova07\imperavi\actions\GetAction;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use app\models\User;

/**
 * ResultsController implements the CRUD actions for Results model.
 */
class ResultsController extends Controller
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

    public function actions()
    {
        return [
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => Yii::getAlias('@web').'/uploads/images/', // Directory URL address, where files are stored.
                'path' => '@webroot/uploads/images', // Or absolute path to directory where files are stored.
                //'validatorOptions' => ['maxSize' => 40000],    //макс. размер файла
            ],
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetAction',
                'url' => Yii::getAlias('@web').'/uploads/images/', // Directory URL address, where files are stored.
                'path' => '@webroot/uploads/images', // Or absolute path to directory where files are stored.
                'type' => GetAction::TYPE_IMAGES,
            ],
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
     * Lists all Results models.
     * @return mixed
     */

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Results::find()->orderBy('date DESC'),
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
        $searchModel = new ResultsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Results model.
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
     * Creates a new Results model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Results();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if($model->imageFile){
                $imageName=time(). '.' . $model->imageFile->extension;
                $model->imageFile->saveAs('uploads/images/' . $imageName);
                $model->image=$imageName;

                Image::getImagine()->open('uploads/images/'.$imageName)->thumbnail(new Box(1000, 1000))->save(Yii::getAlias('@webroot').'/uploads/images/'.$imageName);
                Image::thumbnail('@webroot/uploads/images/' . $imageName, 110, 100)
                    ->save(Yii::getAlias('@webroot/uploads/images/small/s_' . $imageName), ['quality' => 90]);
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
     * Updates an existing Results model.
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
                Image::getImagine()->open('uploads/images/'.$imageName)->thumbnail(new Box(1000, 1000))->save(Yii::getAlias('@webroot').'/uploads/images/'.$imageName);
                Image::thumbnail('@webroot/uploads/images/' . $imageName, 110, 100)
                    ->save(Yii::getAlias('@webroot/uploads/images/small/s_' . $imageName), ['quality' => 90]);
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
     * Deletes an existing Results model.
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
     * Finds the Results model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Results the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Results::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
