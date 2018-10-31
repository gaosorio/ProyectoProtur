<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Habitacion;
use frontend\models\HabitacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * HabitacionController implements the CRUD actions for habitacion model.
 */
class HabitacionController extends Controller
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
     * Lists all habitacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
        $searchModel = new HabitacionSearch();
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
     * Displays a single habitacion model.
     * @param string $fechahab
     * @param integer $idhotel
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($fechahab, $idhotel)
    {
        if((Yii::$app->user->identity->nivel)==2)
        {

                return $this->render('view', ['model' => $this->findModel($fechahab,$idhotel)]);
           
        }
        else
        {
            return $this->goHome();
        }
    }

    /**
     * Creates a new habitacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
        $model = new habitacion();

        if ($model->load(Yii::$app->request->post())) {
            list($mes, $año) = explode('-', $model->fechahab);
                $model->mes_habitacion = intval($mes);
                $model->año_habitacion = intval($año);
                if($model->save())
                {
            return $this->redirect(['view', 'fechahab' => $model->fechahab, 'idhotel' => $model->idhotel]);}
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
     * Updates an existing habitacion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $fechahab
     * @param integer $idhotel
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($fechahab, $idhotel)
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
            list($mes, $año) = explode('-', $fechahab);
            if (is_numeric($idhotel) && is_numeric($mes) && is_numeric($año)) 
            {
                $model = $this->findModel($fechahab, $idhotel);

                if ($model->load(Yii::$app->request->post())) 
                {
                    list($mes, $año) = explode('-', $model->fechahab);
                    $model->mes_habitacion = intval($mes);
                    $model->año_habitacion = intval($año);
                    if($model->save())
                    {
                        return $this->redirect(['view', 'fechahab' => $model->fechahab, 'idhotel' => $model->idhotel]);
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
     * Deletes an existing habitacion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $fechahab
     * @param integer $idhotel
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($fechahab, $idhotel)
    {
        $this->findModel($fechahab, $idhotel)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the habitacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $fechahab
     * @param integer $idhotel
     * @return habitacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($fechahab, $idhotel)
    {
        if (($model = habitacion::findOne(['fechahab' => $fechahab, 'idhotel' => $idhotel])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
