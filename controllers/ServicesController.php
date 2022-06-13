<?php

namespace app\controllers;
use Yii;
use app\models\Services;
use app\models\ServicesSearch;
use app\models\User;
use app\models\UserSearch;
use app\models\Wishes;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ServicesController implements the CRUD actions for Services model.
 */
class ServicesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Services models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest or !User::isAdmin()) {
            return $this->goHome();
        }

        $searchModel = new ServicesSearch();
        $searchModelU = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProviderU = $searchModelU->search($this->request->queryParams);

        $this->layout = 'adminMain';
        return $this->render('index', [
            'searchModel' => $searchModel,
            'searchModelU' => $searchModelU,
            'dataProvider' => $dataProvider,
            'dataProviderU' => $dataProviderU,
        ]);
    }

    public function actionAdminprofile() {
        if (Yii::$app->user->isGuest or !User::isAdmin()) {
            return $this->goHome();
        }

        $this->layout = 'adminMain';
        return $this->render('adminProfile');
    }


    /**
     * Displays a single Services model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest or !User::isAdmin()) {
            return $this->goHome();
        }

        $this->layout = 'adminMain';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Services model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest or !User::isAdmin()) {
            return $this->goHome();
        }

        $model = new Services();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        $this->layout = 'adminMain';
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Services model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest or !User::isAdmin()) {
            return $this->goHome();
        }

        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $this->layout = 'adminMain';
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Services model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest or !User::isAdmin()) {
            return $this->goHome();
        }

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Services model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Services the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Services::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
