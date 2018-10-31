<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Salondeevento;
use frontend\models\SalondeeventoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use frontend\models\Salon;
use yii\filters\AccessControl;

/**
 * SalondeeventoController implements the CRUD actions for salondeevento model.
 */
class SalondeeventoController extends Controller
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
                        'actions' => ['index','view','create','update','get'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all salondeevento models.
     * @return mixed
     */
    public function actionIndex()
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
        	$searchModel = new SalondeeventoSearch();
        	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        	return $this->render('index', ['searchModel' => $searchModel,'dataProvider' => $dataProvider,]);
	}
        else
        {
           return $this->goHome();
        }
    }

    public function actionGet($zipId)
    {
        $location = Salon::find()->where(['nombre_salon' => $zipId])->one();
        echo Json::encode($location);
    }


    /**
     * Displays a single salondeevento model.
     * @param string $tipo_salon
     * @param integer $id_centro
     * @param string $fecha_salon
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($tipo_salon, $id_centro, $fecha_salon)
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
           list($mes, $año) = explode('-', $fecha_salon);
           if (is_numeric($id_centro) && is_numeric($mes) && is_numeric($año)) 
            {
           	return $this->render('view', ['model' => $this->findModel($tipo_salon, $id_centro, $fecha_salon),]);
            }
            else
           {
            return $this->goHome();
           }
	}
        else
        {
           return $this->goHome();
        }
    }

    /**
     * Creates a new salondeevento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
        $model = new salondeevento();

        if ($model->load(Yii::$app->request->post()) ) {
            
            list($mes, $año) = explode('-', $model->fecha_salon);
                $model->mes_salon = intval($mes);
                $model->ano_salon = intval($año);
            if ($model->save()){

            return $this->redirect(['view', 'tipo_salon' => $model->tipo_salon, 'id_centro' => $model->id_centro, 'fecha_salon' => $model->fecha_salon]);
            } 
        }

           return $this->render('create', ['model' => $model,]);
        }
        else
        {
           return $this->goHome();
        }
    }

    /**
     * Updates an existing salondeevento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $tipo_salon
     * @param integer $id_centro
     * @param string $fecha_salon
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($tipo_salon, $id_centro, $fecha_salon)
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
           list($mes, $año) = explode('-', $fecha_salon);
           if (is_numeric($id_centro) && is_numeric($mes) && is_numeric($año)) 
            {

           $model = $this->findModel($tipo_salon, $id_centro, $fecha_salon);

           if ($model->load(Yii::$app->request->post()) ) {
                list($mes, $año) = explode('-', $model->fecha_salon);
                $model->mes_salon = intval($mes);
                $model->ano_salon = intval($año);
                if ($model->save()){

                return $this->redirect(['view', 'tipo_salon' => $model->tipo_salon, 'id_centro' => $model->id_centro, 'fecha_salon' => $model->fecha_salon]);
                } 
          }

          return $this->render('update', ['model' => $model,]);
          }
        else
        {
           return $this->goHome();
        }

	}
        else
        {
           return $this->goHome();
        }
    }

    /**
     * Deletes an existing salondeevento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $tipo_salon
     * @param integer $id_centro
     * @param string $fecha_salon
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($tipo_salon, $id_centro, $fecha_salon)
    {
        $this->findModel($tipo_salon, $id_centro, $fecha_salon)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the salondeevento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $tipo_salon
     * @param integer $id_centro
     * @param string $fecha_salon
     * @return salondeevento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($tipo_salon, $id_centro, $fecha_salon)
    {
        if (($model = salondeevento::findOne(['tipo_salon' => $tipo_salon, 'id_centro' => $id_centro, 'fecha_salon' => $fecha_salon])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
