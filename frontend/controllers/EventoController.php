<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Evento;
use frontend\models\EventoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * EventoController implements the CRUD actions for Evento model.
 */
class EventoController extends Controller
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
     * Lists all Evento models.
     * @return mixed
     */
    public function actionIndex()
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
        $searchModel = new EventoSearch();
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
     * Displays a single Evento model.
     * @param string $tipo_evento
     * @param integer $id_centro
     * @param string $fecha_evento
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($tipo_evento, $id_centro, $fecha_evento)
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
            list($mes, $año) = explode('-', $fecha_evento);
            if (is_numeric($id_centro) && is_numeric($mes) && is_numeric($año)) 
            {
                return $this->render('view', [
                    'model' => $this->findModel($tipo_evento, $id_centro, $fecha_evento),
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
     * Creates a new Evento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
            $model = new Evento();

            if ($model->load(Yii::$app->request->post())) 
            {
                if($model->validate())
                {
                    list($mes, $año) = explode('-', $model->fecha_evento);
                    $model->mes_evento = intval($mes);
                    $model->ano_evento = intval($año);
                    if($model->save())
                    {
                        return $this->redirect(['view', 'tipo_evento' => $model->tipo_evento, 'id_centro' => $model->id_centro, 'fecha_evento' => $model->fecha_evento]);
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
     * Updates an existing Evento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $tipo_evento
     * @param integer $id_centro
     * @param string $fecha_evento
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($tipo_evento, $id_centro, $fecha_evento)
    {
        if((Yii::$app->user->identity->nivel)==2)
        {

            list($mes, $año) = explode('-', $fecha_evento);
            if (is_numeric($id_centro) && is_numeric($mes) && is_numeric($año)) 
            {
                $model = $this->findModel($tipo_evento, $id_centro, $fecha_evento);

                if ($model->load(Yii::$app->request->post())) 
                {
                    list($mes, $año) = explode('-', $model->fecha_evento);
                    $model->mes_evento = intval($mes);
                    $model->ano_evento = intval($año);
                    if($model->save())
                    {
                        return $this->redirect(['view', 'tipo_evento' => $model->tipo_evento, 'id_centro' => $model->id_centro, 'fecha_evento' => $model->fecha_evento]);
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
     * Deletes an existing Evento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $tipo_evento
     * @param integer $id_centro
     * @param string $fecha_evento
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($tipo_evento, $id_centro, $fecha_evento)
    {
        $this->findModel($tipo_evento, $id_centro, $fecha_evento)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Evento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $tipo_evento
     * @param integer $id_centro
     * @param string $fecha_evento
     * @return Evento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($tipo_evento, $id_centro, $fecha_evento)
    {
        if (($model = Evento::findOne(['tipo_evento' => $tipo_evento, 'id_centro' => $id_centro, 'fecha_evento' => $fecha_evento])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
