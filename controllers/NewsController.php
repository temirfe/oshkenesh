<?php

namespace app\controllers;

use Yii;
use app\models\News;
use app\models\Comment;
use app\models\NewsSearch;
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
use yii\helpers\Html;
/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
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
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->language=='ru')
        {
            $content_lang='1';
        }
        else{
            $content_lang='0';
        }
        $dataProvider = new ActiveDataProvider([
            'query' => News::find()->where(['ru'=>$content_lang])->orderBy('date DESC'),
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
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();

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
     * Updates an existing News model.
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
     * Deletes an existing News model.
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
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

   /* //these functions were used to deal with old images. once.
    public function actionResize(){
        $dir=Yii::getAlias('@webroot/big');
        $imgs=scandir($dir);
        foreach($imgs as $img){
            if($img!='.' && $img!='..'){
                Image::getImagine()->open('big/'.$img)->thumbnail(new Box(120, 100))->save(Yii::getAlias('@webroot').'/small/s_'.$img);
            }
        }
    }

    //these functions were used to deal with old images. once.
    public function actionRename(){
        $row=Yii::$app->db->createCommand("SELECT id, image FROM news WHERE id='215'")->queryOne();
        $image = explode(".",$row['image']);
        $ext=end($image);
        $name=time()."_".rand(1000,100000).'.'.$ext;
        Image::getImagine()->open('big/'.escapeshellarg($row['image']))->thumbnail(new Box(120, 100))->save(Yii::getAlias('@webroot').'/small/s_'.$name);
    }*/

    //import latest news from old site
    public function actionImport(){
        die();
        $db=Yii::$app->db;
        $contents=$db->createCommand("SELECT * FROM content WHERE category_id='1' AND content_id>319")->queryAll();
        $webroot=Yii::getAlias('@webroot');
        foreach($contents as $c){
            if(!$c['image']) $image=''; else {$image=$c['image']; }
            $db->createCommand()->insert('news', [
                'title' => $c['title'],
                'date' => $c['date'],
                'image' => $image,
                'content' => $c['content'],
                'description' => $c['description'],

            ])->execute();
            if($image) {
                copy("http://oshkenesh.kg/images/news_photo/".$image,$webroot.'/uploads/images/small/s_'.$image);
                copy("http://oshkenesh.kg/images/news_photo/big/".$image,$webroot.'/uploads/images/'.$image);
            }

            preg_match_all("/editor\/images\/([^.]+).jpg/s",$c['content'],$matches);
            if(isset($matches[1])){
                foreach($matches[1] as $m){
                    $image=$m.'.jpg';
                    copy("http://oshkenesh.kg/images/editor/images/".$image,$webroot.'/images/editor/images/'.$image);
                }
            }
        }
    }
}
