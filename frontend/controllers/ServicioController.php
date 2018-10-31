<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Servicio;
use frontend\models\ServicioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ServicioController implements the CRUD actions for servicio model.
 */
class ServicioController extends Controller
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
                        'actions' => ['index','view','create','update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all servicio models.
     * @return mixed
     */
    public function actionIndex()
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
            $searchModel = new ServicioSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        else
        {
           return $this->goHome();
        }
    }

    /**
     * Displays a single servicio model.
     * @param string $tipo_servicio
     * @param string $fecha_servicio
     * @param integer $id_restaurante
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($tipo_servicio, $fecha_servicio, $id_restaurante)
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
            list($mes, $año) = explode('-', $fecha_servicio);
            if (is_numeric($id_restaurante) && is_numeric($mes) && is_numeric($año)) 
            {
                return $this->render('view', ['model' => $this->findModel($tipo_servicio, $fecha_servicio, $id_restaurante),]);
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
     * Creates a new servicio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
            $model = new servicio();

            if ($model->load(Yii::$app->request->post()) ) 
            {
                if($model->validate())
                {
                    list($mes, $año) = explode('-', $model->fecha_servicio);
                    $model->mes_servicio = intval($mes);
                    $model->año_servicio = intval($año);
                    if($model->save())
                    {
                        return $this->redirect(['view', 'tipo_servicio' => $model->tipo_servicio, 'fecha_servicio' => $model->fecha_servicio, 'id_restaurante' => $model->id_restaurante]);
                    }
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
     * Updates an existing servicio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $tipo_servicio
     * @param string $fecha_servicio
     * @param integer $id_restaurante
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($tipo_servicio, $fecha_servicio, $id_restaurante)
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
            list($mes, $año) = explode('-', $fecha_servicio);
            if (is_numeric($id_restaurante) && is_numeric($mes) && is_numeric($año)) 
            {
                $model = $this->findModel($tipo_servicio, $fecha_servicio, $id_restaurante);

                if ($model->load(Yii::$app->request->post())) 
                {
                    list($mes, $año) = explode('-', $model->fecha_servicio);
                    $model->mes_servicio = intval($mes);
                    $model->año_servicio = intval($año);
                    if($model->save())
                    {
                        return $this->redirect(['view', 'tipo_servicio' => $model->tipo_servicio, 'fecha_servicio' => $model->fecha_servicio, 'id_restaurante' => $model->id_restaurante]);
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
     * Deletes an existing servicio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $tipo_servicio
     * @param string $fecha_servicio
     * @param integer $id_restaurante
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($tipo_servicio, $fecha_servicio, $id_restaurante)
    {
        $this->findModel($tipo_servicio, $fecha_servicio, $id_restaurante)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the servicio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $tipo_servicio
     * @param string $fecha_servicio
     * @param integer $id_restaurante
     * @return servicio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($tipo_servicio, $fecha_servicio, $id_restaurante)
    {
        if (($model = servicio::findOne(['tipo_servicio' => $tipo_servicio, 'fecha_servicio' => $fecha_servicio, 'id_restaurante' => $id_restaurante])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
