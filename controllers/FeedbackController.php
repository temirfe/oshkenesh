<?php

namespace app\controllers;

use Yii;
use app\models\Feedback;
use app\models\FeedbackSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\filters\AccessControl;
use app\models\User;
use yii\data\ActiveDataProvider;

/**
 * FeedbackController implements the CRUD actions for Feedback model.
 */
class FeedbackController extends Controller
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
                'only' => ['admin','update','delete'],
                'rules' => [
                    [
                        'actions' => ['admin','update','delete'],
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
     * Lists all Feedback models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Feedback::find()->orderBy('id DESC'),
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
        $searchModel = new FeedbackSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Feedback model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function getSubCatList($cat_id){
        if($cat_id==1) //deputies
        {
            return $rows=Yii::$app->db->createCommand("SELECT id, fullname AS name FROM deputy")->queryAll();

        }
        elseif($cat_id==2) //commission
        {
            $lang=Yii::$app->language;
            if($lang=='kg-KG' || $lang=='kg')$title='title';
            elseif($lang=='ru-Ru' || $lang=='ru')$title='title_ru';
            return $rows=Yii::$app->db->createCommand("SELECT id, {$title} AS name FROM commission")->queryAll();
        }
        else return false;
    }

    public function actionSubcat() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                if($out = self::getSubCatList($cat_id))
                    return Json::encode(['output'=>$out, 'selected'=>'']);
                else return false;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    /**
     * Creates a new Feedback model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Feedback();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->date_create=date('Y-m-d');
            $model->save(false);

            $arr=['Жалпы бөлүмгө','Депутатка','Комиссияга'];
            if($model->to_parent==1) $tochild=$arr[$model->to_parent].": ".$model->deputy->fullname;
            elseif($model->to_parent==2) $tochild=$arr[$model->to_parent].": ".$model->commission->title;
            else $tochild=$arr[$model->to_parent];

            $data=['id'=>$model->id,'towhom'=>$tochild, 'fromname'=>$model->from_name,'fromemail'=>$model->from_email, 'text'=>$model->text];
            Yii::$app->mailer->compose('question', ['data' => $data])
                ->setFrom([Yii::$app->params['supportEmail'] => 'OSHKENESH.KG'])
                ->setTo(Yii::$app->params['adminEmail'])
                ->setSubject('Вам письмо с сайта OSHKENESH.KG')
                ->send();

            Yii::$app->getSession()->setFlash('success', 'Сиздин сурооңуз кабыл алынды. Жоопту электрондук адресиңизге жөнөтөбүз. Суроо берганиңиз үчүн рахмат!');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Feedback model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {


            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionAnswer($id){
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->date_answered=date('Y-m-d');
            $model->save(false);
            $data=['id'=>$model->id,'fromname'=>$model->from_name,'text'=>$model->text,'answer'=>$model->answer];
            Yii::$app->mailer->compose('answer', ['data' => $data])
                ->setFrom([Yii::$app->params['supportEmail'] => 'OSHKENESH.KG'])
                ->setTo($model->from_email)
                ->setSubject('Сурооңуз кабыл алынды')
                ->send();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('answer', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Feedback model.
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
     * Finds the Feedback model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Feedback the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Feedback::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
