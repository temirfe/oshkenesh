<?php

namespace app\controllers;

use Yii;
use app\models\Page;
use app\models\PageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;
use yii\data\ActiveDataProvider;
use vova07\imperavi\actions\GetAction;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends Controller
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
     * Lists all Page models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Page::find()->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 15,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionAdmin()
    {
        $searchModel = new PageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Page model.
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
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Page();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Page model.
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
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Page the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionShow(){
        $from=Yii::$app->request->get('from');
        $lang=Yii::$app->language;
        if($from=='deputy_commission'){if($lang='ru') $id=7; else $id=2;}
        if(isset($id)){
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
        else throw new \yii\web\NotFoundHttpException();
    }
}
