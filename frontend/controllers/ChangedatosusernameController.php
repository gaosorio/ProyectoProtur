<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Changedatosusername;
use frontend\models\ChangedatosusernameSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use dektrium\user\models\User;
use yii\filters\AccessControl;
use yii\helpers\Json;

/**
 * ChangedatosusernameController implements the CRUD actions for changedatosusername model.
 */
class ChangedatosusernameController extends Controller
{
    
    
     
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
                        'actions' => ['create','get'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    /**

    public function actionIndex()
    {
        $searchModel = new ChangedatosusernameSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new changedatosusername model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionGet($zipId)
    {
        $location = User::find()->where(['username' => $zipId])->one();
        echo Json::encode($location);
    }

    public function actionCreate()
    {
        if((Yii::$app->user->identity->nivel)==1)
        {
            $model = new Changedatosusername();
            if ($model->load(Yii::$app->request->post())) 
            {
                $usuario = User::findOne(['username' => $model->usuario]);
                $usuario->cargo = $model->cargo;
                $usuario->usuario = $model->nombre;
                $usuario->socio = $model->socio;
                $usuario->update();
                Yii::$app->session->setFlash('myflash', '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fa fa-check"></i>Éxito al cambiar los datos del usuario');
                return $this->refresh();
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

    /*
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->usuario]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    
    protected function findModel($id)
    {
        if (($model = changedatosusername::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }*/
}
