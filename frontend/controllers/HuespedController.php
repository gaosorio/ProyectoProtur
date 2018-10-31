<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Huesped;
use frontend\models\HuespedSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * HuespedController implements the CRUD actions for huesped model.
 */
class HuespedController extends Controller
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
     * Lists all huesped models.
     * @return mixed
     */
    public function actionIndex()
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
        $searchModel = new HuespedSearch();
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
     * Displays a single huesped model.
     * @param string $fechah
     * @param integer $idhotel
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($fechah, $idhotel)
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
            list($mes, $año) = explode('-', $fechah);
            if (is_numeric($idhotel) && is_numeric($mes) && is_numeric($año)) 
            {
                return $this->render('view', ['model' => $this->findModel($fechah, $idhotel),]);
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
     * Creates a new huesped model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
        $model = new huesped();

        if ($model->load(Yii::$app->request->post()))
        {
            list($mes, $año) = explode('-', $model->fechah);
            $model->mes_huesped = intval($mes);
            $model->año_huesped = intval($año);
            if($model->save())
            {
                return $this->redirect(['view', 'fechah' => $model->fechah, 'idhotel' => $model->idhotel]);
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
     * Updates an existing huesped model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $fechah
     * @param integer $idhotel
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($fechah, $idhotel)
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
            list($mes, $año) = explode('-', $fechah);
            if (is_numeric($idhotel) && is_numeric($mes) && is_numeric($año)) 
            {
                $model = $this->findModel($fechah, $idhotel);

                if ($model->load(Yii::$app->request->post())) {
                    list($mes, $año) = explode('-', $model->fechah);
                    $model->mes_huesped = intval($mes);
                    $model->año_huesped = intval($año);
                    if($model->save())
                    {
                    return $this->redirect(['view', 'fechah' => $model->fechah, 'idhotel' => $model->idhotel]);
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
     * Deletes an existing huesped model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $fechah
     * @param integer $idhotel
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($fechah, $idhotel)
    {
        $this->findModel($fechah, $idhotel)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the huesped model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $fechah
     * @param integer $idhotel
     * @return huesped the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($fechah, $idhotel)
    {
        if (($model = huesped::findOne(['fechah' => $fechah, 'idhotel' => $idhotel])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
