<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Hotel;
use frontend\models\HotelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * HotelController implements the CRUD actions for hotel model.
 */
class HotelController extends Controller
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
     * Lists all hotel models.
     * @return mixed
     */
    public function actionIndex()
    {
        if((Yii::$app->user->identity->nivel)==1)
        {
        $searchModel = new HotelSearch();
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
     * Displays a single hotel model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if((Yii::$app->user->identity->nivel)==1)
        {
            if (is_numeric($id))
            {
                return $this->render('view', ['model' => $this->findModel($id),]);
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
     * Creates a new hotel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if((Yii::$app->user->identity->nivel)==1)
        {
            $model = new hotel();

            if ($model->load(Yii::$app->request->post()) && $model->save())
            {
                return $this->redirect(['view', 'id' => $model->idhotel]);
            }

            return $this->render('create', ['model' => $model,]);
        }
        else
        {
            return $this->goHome();
        }
    }

    /**
     * Updates an existing hotel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if((Yii::$app->user->identity->nivel)==1)
        {
            if (is_numeric($id)) 
            {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && $model->save())
                {
                    return $this->redirect(['view', 'id' => $model->idhotel]);
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
     * Deletes an existing hotel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the hotel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return hotel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = hotel::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
