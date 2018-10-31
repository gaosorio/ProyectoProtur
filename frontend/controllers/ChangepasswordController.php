<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Changepassword;
use frontend\models\ChangepasswordSearch;
use yii\web\Controller;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use dektrium\user\models\User;
use yii\filters\AccessControl;

/**
 * ChangepasswordController implements the CRUD actions for changepassword model.
 */
class ChangepasswordController extends Controller
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
                        'actions' => ['changepassword'],
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
        $searchModel = new ChangepasswordSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($usuario, $pass_actual, $pass_nuevo, $confir_pass_nuevo)
    {
        return $this->render('view', [
            'model' => $this->findModel($usuario, $pass_actual, $pass_nuevo, $confir_pass_nuevo),
        ]);
    }

    
    /**
     * Creates a new changepassword model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionChangepassword()
    { 
        if((Yii::$app->user->identity->nivel)==1)
        {
            $model = new Changepassword();
            if ($model->load(Yii::$app->request->post())) 
            {
                if($model->validate())
                {
                    $usuario = User::findOne(['username' => $model->usuario]);
                    $password = Yii::$app->getSecurity()->generatePasswordHash($model->pass_nuevo);
                    $usuario->password_hash = $password;
                    $usuario->update();
                    Yii::$app->session->setFlash('myflash', '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="icon fa fa-check"></i>Éxito al cambiar la contraseña del usuario');
                    return $this->refresh();
                }
            }

            return $this->render('changepassword', [
                'model' => $model,
            ]);
        }
        else
        {
            return $this->goHome();
        }
    }
    

    /**

    public function actionUpdate($usuario, $pass_actual, $pass_nuevo, $confir_pass_nuevo)
    {
        $model = $this->findModel($usuario, $pass_actual, $pass_nuevo, $confir_pass_nuevo);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'usuario' => $model->usuario, 'pass_actual' => $model->pass_actual, 'pass_nuevo' => $model->pass_nuevo, 'confir_pass_nuevo' => $model->confir_pass_nuevo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete($usuario, $pass_actual, $pass_nuevo, $confir_pass_nuevo)
    {
        $this->findModel($usuario, $pass_actual, $pass_nuevo, $confir_pass_nuevo)->delete();

        return $this->redirect(['index']);
    }

 
    protected function findModel($usuario, $pass_actual, $pass_nuevo, $confir_pass_nuevo)
    {
        if (($model = changepassword::findOne(['usuario' => $usuario, 'pass_actual' => $pass_actual, 'pass_nuevo' => $pass_nuevo, 'confir_pass_nuevo' => $confir_pass_nuevo])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }*/
}
