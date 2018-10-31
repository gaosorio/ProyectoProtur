<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Consumo;
use frontend\models\ConsumoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * ConsumoController implements the CRUD actions for consumo model.
 */
class ConsumoController extends Controller
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
     * Lists all consumo models.
     * @return mixed
     */
    public function actionIndex()
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
            $searchModel = new ConsumoSearch();
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
     * Displays a single consumo model.
     * @param integer $id_restaurante
     * @param string $fecha_consumo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_restaurante, $fecha_consumo)
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
            list($mes, $año) = explode('-', $fecha_consumo);
            if (is_numeric($id_restaurante) && is_numeric($mes) && is_numeric($año)) 
            {
                return $this->render('view', ['model' => $this->findModel($id_restaurante, $fecha_consumo),]);
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
     * Creates a new consumo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
            $model = new consumo();

            if ($model->load(Yii::$app->request->post())) 
            {
                if($model->validate())
                {
                    list($mes, $año) = explode('-', $model->fecha_consumo);
                    $model->mes_consumo = intval($mes);
                    $model->año_consumo = intval($año);
                    if($model->save())
                    {
                        return $this->redirect(['view', 'id_restaurante' => $model->id_restaurante, 'fecha_consumo' => $model->fecha_consumo]);
                    }
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
     * Updates an existing consumo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_restaurante
     * @param string $fecha_consumo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_restaurante, $fecha_consumo)
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
            list($mes, $año) = explode('-', $fecha_consumo);
            if (is_numeric($id_restaurante) && is_numeric($mes) && is_numeric($año)) 
            {
                $model = $this->findModel($id_restaurante, $fecha_consumo);

                if ($model->load(Yii::$app->request->post())) 
                {
                    list($mes, $año) = explode('-', $model->fecha_consumo);
                    $model->mes_consumo = intval($mes);
                    $model->año_consumo = intval($año);
                    if($model->save())
                    {
                        return $this->redirect(['view', 'id_restaurante' => $model->id_restaurante, 'fecha_consumo' => $model->fecha_consumo]);
                    }
                }

                return $this->render('update', [
                    'model' => $model,
                ]);
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
     * Deletes an existing consumo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_restaurante
     * @param string $fecha_consumo
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_restaurante, $fecha_consumo)
    {
        $this->findModel($id_restaurante, $fecha_consumo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the consumo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_restaurante
     * @param string $fecha_consumo
     * @return consumo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_restaurante, $fecha_consumo)
    {
        if (($model = consumo::findOne(['id_restaurante' => $id_restaurante, 'fecha_consumo' => $fecha_consumo])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
