<?php

namespace app\controllers;

use app\models\IssuedService;
use app\models\PurchasedService;
use app\models\RegForm;
use app\models\ServicesSearch;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Wishes;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $modelW = new Wishes();
        $modelI = new IssuedService();

        if ($modelW->load(Yii::$app->request->post()) && $modelW->validate()) {
            $modelW->saveWishes();
        }

        if (isset($_POST['buyButton'])) {
            return $this->render("issuedorder", [
                'modelI' => $modelI,
            ]);
        }

        $searchModel = new ServicesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $modelW->content = '';
        return $this->render('index', [
            'modelW' => $modelW,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIssuedorder()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $modelI = new IssuedService();

        if ($modelI->load(Yii::$app->request->post())) {
            $modelI->saveIssuedService();
            return $this->redirect('lk');
        }

        $this->layout = 'userMain2';
        return $this->render('issuedorder', [
            'modelI' => $modelI
        ]);
    }

    public function actionLk()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new PurchasedService();

        if (isset($_POST['buy-service-button'])) {
            $model->saveFinalOrder();
            return $this->goBack();
        }

        $this->layout = 'userMain2';
        return $this->render('lk', [
            'model' => $model
        ]);
    }

    public function actionUserprofile() {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'userMain2';
        return $this->render('userprofile');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->login();
            return $this->goBack();
        }

        $model->password = '';
        $this->layout = 'userMain';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionReg()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $model = new RegForm();
            if ($model->load(Yii::$app->request->post()))
                return \yii\widgets\ActiveForm::validate($model);
        }

        $model = new RegForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->registration();
            $model->login();
            return $this->goBack();
        }

        $model->password = '';
        $this->layout = 'userMain';
        return $this->render('reg', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */


    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $this->layout = 'userMain';
        return $this->render('about');
    }
}
