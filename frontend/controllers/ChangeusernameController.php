<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Changeusername;
use frontend\models\ChangeusernameSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use dektrium\user\models\User;
use yii\filters\AccessControl;
/**
 * ChangeusernameController implements the CRUD actions for changeusername model.
 */
class ChangeusernameController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /*
    public function actionIndex()
    {
        $searchModel = new ChangeusernameSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($usuario, $new_username)
    {
        return $this->render('view', [
            'model' => $this->findModel($usuario, $new_username),
        ]);
    }

    /**
     * Creates a new changeusername model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if((Yii::$app->user->identity->nivel)==1)
        {
            $model = new Changeusername();

            if ($model->load(Yii::$app->request->post())) 
            {
                if($model->validate())
                    {
                        $usuario = User::findOne(['username' => $model->usuario]);
                        $usuario->username = $model->new_username;
                        $usuario->update();
                        Yii::$app->session->setFlash('myflash', '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fa fa-check"></i>Éxito al cambiar el username');
                        return $this->refresh();
                    }
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
        else
        {
            return $this->goHome();
        }
    }

    /**

    public function actionUpdate($usuario, $new_username)
    {
        $model = $this->findModel($usuario, $new_username);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'usuario' => $model->usuario, 'new_username' => $model->new_username]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete($usuario, $new_username)
    {
        $this->findModel($usuario, $new_username)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($usuario, $new_username)
    {
        if (($model = changeusername::findOne(['usuario' => $usuario, 'new_username' => $new_username])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }*/
}
