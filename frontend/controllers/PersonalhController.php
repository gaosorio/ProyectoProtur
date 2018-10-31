<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Personalh;
use frontend\models\PersonalhSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PersonalhController implements the CRUD actions for personalh model.
 */
class PersonalhController extends Controller
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
     * Lists all personalh models.
     * @return mixed
     */
    public function actionIndex()
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
        $searchModel = new PersonalhSearch();
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
     * Displays a single personalh model.
     * @param string $fechap
     * @param integer $idhotel
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($fechap, $idhotel)
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
            list($mes, $año) = explode('-', $fechap);
            if (is_numeric($idhotel) && is_numeric($mes) && is_numeric($año)) 
            {
                return $this->render('view', [
                    'model' => $this->findModel($fechap, $idhotel),
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
     * Creates a new personalh model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
        $model = new personalh();

        if ($model->load(Yii::$app->request->post())) {
            list($mes, $año) = explode('-', $model->fechap);
                $model->mes_personal = intval($mes);
                $model->año_personal = intval($año);
                if($model->save())
                {
            return $this->redirect(['view', 'fechap' => $model->fechap, 'idhotel' => $model->idhotel]);}
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
     * Updates an existing personalh model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $fechap
     * @param integer $idhotel
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($fechap, $idhotel)
    {
        if((Yii::$app->user->identity->nivel)==2)
        {
            list($mes, $año) = explode('-', $fechap);
            if (is_numeric($idhotel) && is_numeric($mes) && is_numeric($año)) 
            {
                $model = $this->findModel($fechap, $idhotel);

                if ($model->load(Yii::$app->request->post()))
                {
                    list($mes, $año) = explode('-', $model->fechap);
                    $model->mes_personal = intval($mes);
                    $model->año_personal = intval($año);
                    if($model->save())
                    {
                        return $this->redirect(['view', 'fechap' => $model->fechap, 'idhotel' => $model->idhotel]);
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
     * Deletes an existing personalh model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $fechap
     * @param integer $idhotel
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($fechap, $idhotel)
    {
        $this->findModel($fechap, $idhotel)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the personalh model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $fechap
     * @param integer $idhotel
     * @return personalh the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($fechap, $idhotel)
    {
        if (($model = personalh::findOne(['fechap' => $fechap, 'idhotel' => $idhotel])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
