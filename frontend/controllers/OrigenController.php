<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Origen;
use frontend\models\OrigenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrigenController implements the CRUD actions for Origen model.
 */
class OrigenController extends Controller
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
        ];
    }

    /**
     * Lists all Origen models.
     * @return mixed
     */
    public function actionIndex()
    {
	if((Yii::$app->user->identity->nivel)==2)
        {
        $searchModel = new OrigenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
	}else
        {
            return $this->redirect(['site/index']);
        }
    }

    /**
     * Displays a single Origen model.
     * @param string $fecha
     * @param string $pais
     * @param integer $id_hotel
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($fecha, $pais, $id_hotel)
    {
	if((Yii::$app->user->identity->nivel)==2)
        {
        return $this->render('view', [
            'model' => $this->findModel($fecha, $pais, $id_hotel),
        ]);
	}else
        {
            return $this->redirect(['site/index']);
        }
    }

    /**
     * Creates a new Origen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
	if((Yii::$app->user->identity->nivel)==2)
        {
        $model = new Origen();

        if ($model->load(Yii::$app->request->post())) {
	list($mes, $año) = explode('-', $model->fecha);
                $model->mes_origen = intval($mes);
                $model->año_origen = intval($año);
		if($model->save())
                {
            return $this->redirect(['view', 'fecha' => $model->fecha, 'pais' => $model->pais, 'id_hotel' => $model->id_hotel]);
	}
        }

        return $this->render('create', [
            'model' => $model,
        ]);
	}else
        {
            return $this->redirect(['site/index']);
        }
    }

    /**
     * Updates an existing Origen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $fecha
     * @param string $pais
     * @param integer $id_hotel
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($fecha, $pais, $id_hotel)
    {
	if((Yii::$app->user->identity->nivel)==2)
        {
        $model = $this->findModel($fecha, $pais, $id_hotel);

        if ($model->load(Yii::$app->request->post())) {
         list($mes, $año) = explode('-', $model->fecha);
                $model->mes_origen = intval($mes);
                $model->año_origen = intval($año);
	if($model->save())
                {
            return $this->redirect(['view', 'fecha' => $model->fecha, 'pais' => $model->pais, 'id_hotel' => $model->id_hotel]);
	}
        }

        return $this->render('update', [
            'model' => $model,
        ]);
	}else
        {
            return $this->redirect(['site/index']);
        }
    }

    /**
     * Deletes an existing Origen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $fecha
     * @param string $pais
     * @param integer $id_hotel
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($fecha, $pais, $id_hotel)
    {
        $this->findModel($fecha, $pais, $id_hotel)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Origen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $fecha
     * @param string $pais
     * @param integer $id_hotel
     * @return Origen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($fecha, $pais, $id_hotel)
    {
        if (($model = Origen::findOne(['fecha' => $fecha, 'pais' => $pais, 'id_hotel' => $id_hotel])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}