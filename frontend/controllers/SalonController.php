<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Salon;
use frontend\models\SalonSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * SalonController implements the CRUD actions for salon model.
 */
class SalonController extends Controller
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
     * Lists all salon models.
     * @return mixed
     */
    public function actionIndex()
    {
        if((Yii::$app->user->identity->nivel)==1)
        {
        $searchModel = new SalonSearch();
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
     * Displays a single salon model.
     * @param integer $id_salon
     * @param string $nombre_salon
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_salon, $nombre_salon)
    {
        if((Yii::$app->user->identity->nivel)==1)
        {
            if (is_numeric($id_salon)) 
            {
            return $this->render('view', [
            'model' => $this->findModel($id_salon, $nombre_salon),]);
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
     * Creates a new salon model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if((Yii::$app->user->identity->nivel)==1)
        {
        $model = new salon();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_salon' => $model->id_salon, 'nombre_salon' => $model->nombre_salon]);
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
     * Updates an existing salon model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_salon
     * @param string $nombre_salon
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_salon, $nombre_salon)
    {
        if((Yii::$app->user->identity->nivel)==1)
        {
            if (is_numeric($id_salon)) 
            {
            $model = $this->findModel($id_salon, $nombre_salon);

            if ($model->load(Yii::$app->request->post()) && $model->save()) 
            {
                return $this->redirect(['view', 'id_salon' => $model->id_salon, 'nombre_salon' => $model->nombre_salon]);
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
     * Deletes an existing salon model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_salon
     * @param string $nombre_salon
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_salon, $nombre_salon)
    {
        $this->findModel($id_salon, $nombre_salon)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the salon model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_salon
     * @param string $nombre_salon
     * @return salon the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_salon, $nombre_salon)
    {
        if (($model = salon::findOne(['id_salon' => $id_salon, 'nombre_salon' => $nombre_salon])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
